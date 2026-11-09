<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffConfirmationController extends Controller
{
    /**
     * Confirma la asistencia del staff mediante token de correo.
     */
    public function confirm(string $token)
    {
        $pivot = DB::table('event_staff')->where('confirmation_token', $token)->first();

        if (!$pivot) {
            return view('pages.staff-response', [
                'success' => false,
                'title'   => 'Enlace Inválido o Expirado',
                'message' => 'No se encontró una convocatoria activa con este enlace de seguridad.',
                'status'  => 'invalid',
            ]);
        }

        DB::table('event_staff')->where('confirmation_token', $token)->update([
            'status'       => 'confirmed',
            'confirmed_at' => now(),
        ]);

        $event = Event::find($pivot->event_id);
        $staff = Staff::find($pivot->staff_id);

        return view('pages.staff-response', [
            'success' => true,
            'title'   => '¡Asistencia Confirmada!',
            'message' => "Gracias {$staff->name}. Tu participación en '{$event->name}' ha quedado registrada oficialmente.",
            'status'  => 'confirmed',
            'event'   => $event,
            'staff'   => $staff,
        ]);
    }

    /**
     * Declina la asistencia del staff mediante token de correo.
     */
    public function decline(string $token)
    {
        $pivot = DB::table('event_staff')->where('confirmation_token', $token)->first();

        if (!$pivot) {
            return view('pages.staff-response', [
                'success' => false,
                'title'   => 'Enlace Inválido o Expirado',
                'message' => 'No se encontró una convocatoria activa con este enlace de seguridad.',
                'status'  => 'invalid',
            ]);
        }

        DB::table('event_staff')->where('confirmation_token', $token)->update([
            'status'       => 'declined',
            'confirmed_at' => now(),
        ]);

        $event = Event::find($pivot->event_id);
        $staff = Staff::find($pivot->staff_id);

        return view('pages.staff-response', [
            'success' => true,
            'title'   => 'Convocatoria Declinada',
            'message' => "Entendido {$staff->name}. Hemos informado a la coordinación que no podrás asistir a '{$event->name}' para reasignar la posición.",
            'status'  => 'declined',
            'event'   => $event,
            'staff'   => $staff,
        ]);
    }
}

