<?php

namespace App\Filament\Resources\Events\RelationManagers;

use App\Mail\StaffAssignmentMail;
use App\Models\Staff;
use Filament\Actions\Action;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StaffRelationManager extends RelationManager
{
    protected static string $relationship = 'staff';

    protected static ?string $title = 'Staff Asignado al Evento';

    public function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Empleado')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('role')
                    ->label('Rol')
                    ->badge(),

                TextColumn::make('email')
                    ->label('Correo')
                    ->copyable()
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('Teléfono'),

                TextColumn::make('pivot.notes')
                    ->label('Instrucciones / Rol')
                    ->limit(35)
                    ->placeholder('Sin instrucciones')
                    ->wrap(),

                TextColumn::make('pivot.status')
                    ->label('Asistencia')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'declined'  => 'danger',
                        default     => 'warning',
                    })
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'confirmed' => '✅ Confirmado',
                        'declined'  => '❌ Declinado',
                        default     => '⏳ Pendiente',
                    }),

                TextColumn::make('pivot.confirmed_at')
                    ->label('Fecha Respuesta')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('Sin respuesta aún'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->label('Asignar Empleado & Convocar')
                    ->icon('heroicon-o-paper-airplane')
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        \Filament\Forms\Components\Select::make('status')
                            ->label('Estado Inicial')
                            ->options([
                                'pending'   => '⏳ Pendiente (Esperar respuesta)',
                                'confirmed' => '✅ Confirmado de inmediato',
                                'declined'  => '❌ Declinado',
                            ])
                            ->default('pending')
                            ->required(),
                        \Filament\Forms\Components\Textarea::make('notes')
                            ->label('Rol / Instrucciones de Trabajo')
                            ->placeholder('Ej: Coordinador de montaje de luces, Asistente de mesa principal...'),
                    ])
                    ->before(function (AttachAction $action, array $data, StaffRelationManager $livewire) {
                        $staffId = $data['recordId'] ?? null;
                        if (!$staffId) {
                            return;
                        }

                        $event = $livewire->getOwnerRecord();
                        $staff = Staff::find($staffId);
                        if (!$staff) {
                            return;
                        }

                        // Verificar si el staff ya tiene un evento activo en el mismo rango de fecha y hora
                        $conflict = \App\Models\Event::where('events.id', '!=', $event->id)
                            ->where('events.status', '!=', 'cancelled')
                            ->whereHas('staff', function ($q) use ($staffId) {
                                $q->where('staff.id', $staffId);
                            })
                            ->where('events.start_date', '<', $event->end_date)
                            ->where('events.end_date', '>', $event->start_date)
                            ->first();

                        if ($conflict) {
                            Notification::make()
                                ->title('Conflicto de Horario Detectado')
                                ->body("El empleado {$staff->name} ya está asignado al evento '{$conflict->name}' programado del {$conflict->start_date->format('d/m/Y H:i')} al {$conflict->end_date->format('d/m/Y H:i')}. No se permiten cruces de horario.")
                                ->danger()
                                ->send();

                            $action->halt();
                        }
                    })
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['status'] = $data['status'] ?? 'pending';
                        $data['confirmation_token'] = Str::random(40);
                        if ($data['status'] === 'confirmed') {
                            $data['confirmed_at'] = now();
                        }
                        return $data;
                    })
                    ->after(function (Staff $record, StaffRelationManager $livewire) {
                        $event = $livewire->getOwnerRecord();
                        $pivot = DB::table('event_staff')
                            ->where('event_id', $event->id)
                            ->where('staff_id', $record->id)
                            ->first();

                        if ($pivot && $record->email && $pivot->status === 'pending') {
                            try {
                                Mail::to($record->email)->send(
                                    new StaffAssignmentMail($event, $record, $pivot->confirmation_token)
                                );

                                Notification::make()
                                    ->title('Convocatoria Despachada')
                                    ->body("Se ha enviado correo formal de confirmación a {$record->name} ({$record->email}).")
                                    ->success()
                                    ->send();
                            } catch (\Throwable $e) {
                                Notification::make()
                                    ->title('Empleado Asignado')
                                    ->body("Se guardó la asignación. Nota sobre correo: {$e->getMessage()}")
                                    ->warning()
                                    ->send();
                            }
                        }
                    }),
            ])
            ->recordActions([
                \Filament\Actions\EditAction::make()
                    ->label('Editar Asignación / Estado')
                    ->form([
                        \Filament\Forms\Components\Select::make('status')
                            ->label('Estado de Asistencia')
                            ->options([
                                'pending'   => '⏳ Pendiente (Esperando confirmación)',
                                'confirmed' => '✅ Confirmado (Asistencia garantizada)',
                                'declined'  => '❌ Declinado (No asistirá)',
                            ])
                            ->required(),
                        \Filament\Forms\Components\Textarea::make('notes')
                            ->label('Instrucciones / Rol en el Evento')
                            ->placeholder('Ej: Líder de logística y coordinación de mesas...'),
                    ])
                    ->after(function (Staff $record, array $data) {
                        if (($data['status'] ?? null) === 'confirmed') {
                            DB::table('event_staff')
                                ->where('staff_id', $record->id)
                                ->update(['confirmed_at' => now()]);
                        }
                    }),

                Action::make('confirmQuick')
                    ->label('Confirmar Manual')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Staff $record): bool => ($record->pivot->status ?? '') !== 'confirmed')
                    ->action(function (Staff $record, StaffRelationManager $livewire) {
                        $event = $livewire->getOwnerRecord();
                        DB::table('event_staff')
                            ->where('event_id', $event->id)
                            ->where('staff_id', $record->id)
                            ->update([
                                'status'       => 'confirmed',
                                'confirmed_at' => now(),
                            ]);

                        Notification::make()
                            ->title('Asistencia Confirmada')
                            ->body("El empleado {$record->name} ha sido marcado como Confirmado manualmente por el administrador.")
                            ->success()
                            ->send();
                    }),
                Action::make('resend')
                    ->label('Reenviar Correo')
                    ->icon('heroicon-o-arrow-path')
                    ->color('gray')
                    ->requiresConfirmation()
                    ->action(function (Staff $record, StaffRelationManager $livewire) {
                        $event = $livewire->getOwnerRecord();
                        $pivot = DB::table('event_staff')
                            ->where('event_id', $event->id)
                            ->where('staff_id', $record->id)
                            ->first();

                        if (!$pivot) return;

                        $token = $pivot->confirmation_token;
                        if (!$token) {
                            $token = Str::random(40);
                            DB::table('event_staff')
                                ->where('event_id', $event->id)
                                ->where('staff_id', $record->id)
                                ->update(['confirmation_token' => $token]);
                        }

                        if ($record->email) {
                            Mail::to($record->email)->send(
                                new StaffAssignmentMail($event, $record, $token)
                            );

                            Notification::make()
                                ->title('Correo Reenviado')
                                ->body("Se reenvió la invitación de asistencia a {$record->email}.")
                                ->success()
                                ->send();
                        }
                    }),

                DetachAction::make()
                    ->label('Desvincular'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
