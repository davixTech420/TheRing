<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Events\EventResource;
use App\Models\Event;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Schemas\Schema;
use Saade\FilamentFullCalendar\Data\FetchInfo;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    /**
     * Título del Widget
     */
    protected ?string $heading = 'Calendario de Eventos & Ocupación';

    /**
     * El modelo asociado al calendario.
     */
    public string|null|\Illuminate\Database\Eloquent\Model $model = Event::class;

    /**
     * Ocupar el 100% del ancho del panel.
     */
    protected int | string | array $columnSpan = 'full';

    /**
     * Atributos de fecha para drag & drop automático.
     */
    protected ?string $startAttribute = 'start_date';

    protected ?string $endAttribute = 'end_date';

    /**
     * Confirmar cambios al arrastrar/redimensionar eventos.
     */
    protected bool $shouldConfirmEventChanges = true;

    /**
     * Configuración del calendario FullCalendar.
     */
    public function config(): array
    {
        return [
            'headerToolbar' => [
                'left'   => 'prev,today,next',
                'center' => 'title',
                'right'  => 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
            ],
            'buttonText' => [
                'today' => 'Hoy',
                'month' => 'Mes',
                'week'  => 'Semana',
                'day'   => 'Día',
                'list'  => 'Agenda',
            ],
            'initialView'      => 'dayGridMonth',
            'editable'         => true,
            'selectable'       => true,
            'dayMaxEvents'     => 3,
            'nowIndicator'     => true,
            'eventDisplay'     => 'block',
            'navLinks'         => true,
            'firstDay'         => 1, // Lunes primer día
            'locale'           => 'es',
            'height'           => 'auto',
            'aspectRatio'      => 1.65,
            'businessHours'    => [
                'daysOfWeek' => [1, 2, 3, 4, 5, 6], // Lunes a Sábado
                'startTime'  => '08:00',
                'endTime'    => '22:00',
            ],
        ];
    }

    /**
     * Obtiene los eventos del rango visible del calendario.
     * Retorna una query de Eloquent que el paquete procesa automáticamente
     * gracias a que Event implementa Eventable.
     */
    public function fetchEvents(FetchInfo $info): iterable
    {
        return Event::query()
            ->where(function ($query) use ($info) {
                $query->whereBetween('start_date', [$info->start, $info->end])
                    ->orWhere(function ($q) use ($info) {
                        $q->where('start_date', '<', $info->end)
                            ->whereNotNull('end_date')
                            ->where('end_date', '>=', $info->start);
                    });
            })
            ->get();
    }

    /**
     * Formulario para crear/editar eventos desde el calendario.
     * Reutiliza el formulario del recurso EventResource.
     */
    public function form(Schema $schema): Schema
    {
        return EventResource::form($schema);
    }

    /**
     * Acción para crear un evento al hacer clic en una fecha.
     */
    protected function createAction(): \Filament\Actions\Action
    {
        return CreateAction::make()
            ->mutateFormDataUsing(function (array $data): array {
                // Validar que no se creen eventos con fecha pasada
                if (isset($data['start_date']) && $data['start_date'] < now()->format('Y-m-d\TH:i')) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'start_date' => 'No se puede crear un evento con una fecha anterior a la actual.',
                    ]);
                }

                return $data;
            });
    }

    /**
     * Acciones del modal de evento (editar, eliminar).
     */
    protected function modalActions(): array
    {
        return [
            EditAction::make()
                ->cancelParentActions()
                ->mutateFormDataUsing(function (array $data): array {
                    if (isset($data['start_date']) && $data['start_date'] < now()->format('Y-m-d\TH:i')) {
                        throw \Illuminate\Validation\ValidationException::withMessages([
                            'start_date' => 'No se puede mover un evento a una fecha anterior a la actual.',
                        ]);
                    }

                    return $data;
                }),

            DeleteAction::make()
                ->cancelParentActions(),
        ];
    }

    /**
     * Acción para ver evento.
     */
    protected function viewAction(): \Filament\Actions\Action
    {
        return ViewAction::make()
            ->modalFooterActions(fn(ViewAction $action): array => [
                ...$this->getCachedFormActions(),
                $action->getModalCancelAction(),
            ]);
    }
}
