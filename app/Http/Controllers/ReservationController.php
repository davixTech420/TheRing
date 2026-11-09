<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Salons;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    /**
     * Muestra la vista de reservas.
     */
    public function index()
    {
        $salones = Salons::all();
        $servicios = Service::all();
        $dresses = \App\Models\Dress::where('is_active', true)->get();

        return view('pages.reservas', compact('salones', 'servicios', 'dresses'));
    }

    /**
     * Guarda una nueva reserva/evento desde el formulario VIP del frontend.
     */
    public function store(Request $request): JsonResponse
    {
        // 1. Validación estricta: NO se permiten fechas anteriores a hoy
        $validated = $request->validate([
            'clientName'     => 'required|string|max:255',
            'phone'          => 'required|string|max:50',
            'email'          => 'nullable|email|max:255',
            'date'           => 'required|date|after_or_equal:today',
            'type'           => 'required|string|max:100',
            'guests'         => 'required|integer|min:1|max:5000',
            'salon_id'       => 'nullable',
            'dress_id'       => 'nullable|exists:dresses,id',
            'location_type'  => 'nullable|string',
            'custom_details' => 'nullable|array',
            'services'       => 'nullable|array',
        ], [
            'date.after_or_equal' => 'No se puede crear un evento con una fecha anterior a la actual.',
            'date.required'       => 'La fecha del evento es obligatoria.',
            'clientName.required' => 'El nombre completo es obligatorio.',
            'phone.required'      => 'El número de contacto es obligatorio.',
        ]);

        $timeSlot = $request->input('custom_details.time_slot', 'Noche');
        if (str_contains(strtolower($timeSlot), 'atardecer')) {
            $startDate = Carbon::parse($validated['date'])->startOfDay()->addHours(15);
            $endDate   = Carbon::parse($validated['date'])->startOfDay()->addHours(23);
        } elseif (str_contains(strtolower($timeSlot), 'día') || str_contains(strtolower($timeSlot), 'dia')) {
            $startDate = Carbon::parse($validated['date'])->startOfDay()->addHours(10);
            $endDate   = Carbon::parse($validated['date'])->startOfDay()->addHours(18);
        } else {
            // Noche de Gala (18:00 a 04:00)
            $startDate = Carbon::parse($validated['date'])->startOfDay()->addHours(18);
            $endDate   = Carbon::parse($validated['date'])->addDay()->startOfDay()->addHours(4);
        }

        // 2. Verificar disponibilidad del salón (evitar duplicados en la misma fecha)
        if (!empty($validated['salon_id'])) {
            $salonId = $validated['salon_id'];
            $occupied = Event::whereHas('salons', function ($query) use ($salonId) {
                    $query->where('salons.id', $salonId);
                })
                ->where('status', '!=', 'cancelled')
                ->whereDate('start_date', Carbon::parse($validated['date'])->toDateString())
                ->exists();

            if ($occupied) {
                return response()->json([
                    'success' => false,
                    'message' => 'El salón seleccionado ya tiene un evento agendado para esa fecha. Por favor selecciona otra fecha o salón.',
                ], 422);
            }
        }

        // 3. Obtener o crear el cliente
        $user = Auth::user();
        if (!$user) {
            $user = User::where('phone', $validated['phone'])
                ->orWhere(function ($q) use ($validated) {
                    if (!empty($validated['email'])) {
                        $q->where('email', $validated['email']);
                    }
                })
                ->first();

            if (!$user) {
                $email = !empty($validated['email'])
                    ? $validated['email']
                    : 'cliente_' . preg_replace('/[^0-9]/', '', $validated['phone']) . '_' . Str::random(4) . '@thering.com';

                $user = User::create([
                    'name'     => $validated['clientName'],
                    'phone'    => $validated['phone'],
                    'email'    => $email,
                    'password' => Hash::make(Str::random(16)),
                    'role'     => 'client',
                ]);
            }
        }

        // 4. Crear el evento en base de datos
        $dressId = $validated['dress_id'] ?? $request->input('custom_details.vestuario.dress_id');
        $locationType = $validated['location_type'] ?? ($request->input('custom_details.location_type') ?? 'the_ring');

        $event = Event::create([
            'user_id'        => $user->id,
            'name'           => $validated['type'] . ' - ' . $validated['clientName'],
            'event_type'     => $validated['type'],
            'guest_count'    => $validated['guests'],
            'dress_id'       => $dressId,
            'location_type'  => $locationType,
            'start_date'     => $startDate,
            'end_date'       => $endDate,
            'status'         => 'pending',
            'custom_details' => $request->input('custom_details', []),
        ]);

        // 5. Vincular el salón si fue seleccionado
        if (!empty($validated['salon_id'])) {
            $salonModel = Salons::find($validated['salon_id']);
            if ($salonModel) {
                $event->salons()->attach($salonModel->id);
            }
        }

        // 6. Vincular los servicios de la base de datos seleccionados con cantidades y precios
        $servicesInput = $request->input('services', []);
        if (!empty($servicesInput) && is_array($servicesInput)) {
            foreach ($servicesInput as $svcItem) {
                $serviceId = $svcItem['id'] ?? null;
                if ($serviceId) {
                    $serviceModel = Service::find($serviceId);
                    if ($serviceModel) {
                        $qty = max(1, (int)($svcItem['quantity'] ?? 1));
                        $unitPrice = isset($svcItem['price']) ? (float)$svcItem['price'] : (float)$serviceModel->base_price;
                        $notes = $svcItem['notes'] ?? null;

                        $event->services()->attach($serviceModel->id, [
                            'quantity'   => $qty,
                            'unit_price' => $unitPrice,
                            'notes'      => $notes,
                        ]);
                    }
                }
            }
        }

        return response()->json([
            'success'         => true,
            'message'         => '¡Tu cotización y reserva han sido registradas con éxito!',
            'event_id'        => $event->id,
            'event_name'      => $event->name,
            'date'            => $startDate->format('d/m/Y'),
            'services_count'  => $event->services()->count(),
            'services_total'  => $event->services_total,
        ]);
    }
}

