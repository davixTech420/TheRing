<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignación de Evento — The Ring</title>
</head>
<body style="margin: 0; padding: 0; background-color: #09090b; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #ffffff;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #09090b; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" border="0" cellspacing="0" cellpadding="0" style="background-color: #18181b; border: 1px solid #27272a; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.5);">
                    
                    {{-- HEADER --}}
                    <tr>
                        <td align="center" style="padding: 40px 30px 20px 30px; border-bottom: 1px solid #27272a;">
                            <h1 style="margin: 0; font-size: 28px; font-weight: 900; letter-spacing: 4px; text-transform: uppercase; color: #ffffff;">
                                THE <span style="color: #f59e0b;">RING</span>
                            </h1>
                            <p style="margin: 5px 0 0 0; font-size: 11px; letter-spacing: 3px; text-transform: uppercase; color: #71717a; font-family: monospace;">
                                Staff Logistics & Protocol
                            </p>
                        </td>
                    </tr>

                    {{-- BODY --}}
                    <tr>
                        <td style="padding: 40px 35px;">
                            <p style="margin: 0 0 15px 0; font-size: 18px; color: #ffffff;">
                                Hola, <strong style="color: #f59e0b;">{{ $staff->name }}</strong>
                            </p>
                            <p style="margin: 0 0 30px 0; font-size: 14px; line-height: 1.6; color: #a1a1aa;">
                                Has sido convocado y asignado formalmente para el despliegue del siguiente evento exclusivo. Por favor confirma tu disponibilidad a la mayor brevedad.
                            </p>

                            {{-- EVENT CARD --}}
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #27272a; border: 1px solid #3f3f46; border-radius: 16px; margin-bottom: 35px;">
                                <tr>
                                    <td style="padding: 25px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="padding-bottom: 12px; font-size: 11px; font-weight: bold; letter-spacing: 2px; text-transform: uppercase; color: #f59e0b;">
                                                    Detalles de la Convocatoria
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 20px; font-weight: 900; color: #ffffff; padding-bottom: 15px;">
                                                    {{ $event->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 13px; color: #d4d4d8; padding-bottom: 8px;">
                                                    <strong>Tipo de Evento:</strong> {{ $event->event_type }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 13px; color: #d4d4d8; padding-bottom: 8px;">
                                                    <strong>Tu Rol Asignado:</strong> <span style="background-color: #f59e0b; color: #000000; padding: 2px 8px; border-radius: 6px; font-weight: bold;">{{ $staff->role }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 13px; color: #d4d4d8; padding-bottom: 8px;">
                                                    <strong>Fecha y Hora de Inicio:</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y - h:i A') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 13px; color: #d4d4d8; padding-bottom: 8px;">
                                                    <strong>Hora estimada de Fin:</strong> {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y - h:i A') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 13px; color: #d4d4d8;">
                                                    <strong>Locación:</strong> 
                                                    {{ $event->salons->pluck('name')->join(', ') ?: 'Sede Principal The Ring' }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            {{-- ACTION BUTTONS --}}
                            <p style="margin: 0 0 20px 0; font-size: 13px; font-weight: bold; text-align: center; text-transform: uppercase; letter-spacing: 1px; color: #71717a;">
                                Selecciona una opción para actualizar el sistema:
                            </p>

                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" style="padding-bottom: 15px;">
                                        <a href="{{ $confirmUrl }}" style="display: block; width: 85%; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #ffffff; text-decoration: none; padding: 16px 20px; font-size: 14px; font-weight: 900; letter-spacing: 1px; text-transform: uppercase; border-radius: 12px; box-shadow: 0 8px 20px rgba(16,185,129,0.3); text-align: center;">
                                            ✅ Confirmar mi Asistencia
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <a href="{{ $declineUrl }}" style="display: block; width: 85%; background-color: #3f3f46; color: #d4d4d8; text-decoration: none; padding: 12px 20px; font-size: 12px; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; border-radius: 12px; text-align: center;">
                                            ❌ No Podré Asistir
                                        </a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    {{-- FOOTER --}}
                    <tr>
                        <td align="center" style="padding: 25px 30px; background-color: #121215; border-top: 1px solid #27272a; font-size: 11px; color: #71717a;">
                            Este enlace es de uso único y personal para {{ $staff->email }}.<br>
                            &copy; {{ date('Y') }} Eventos The Ring. Todos los derechos reservados.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>

