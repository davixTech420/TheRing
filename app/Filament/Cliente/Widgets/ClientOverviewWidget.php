<?php

namespace App\Filament\Cliente\Widgets;

use App\Models\Event;
use Carbon\Carbon;
use Filament\Widgets\Widget;

class ClientOverviewWidget extends Widget
{
    protected string $view = 'filament.cliente.widgets.client-overview';

    protected int | string | array $columnSpan = 'full';

    public function getActiveEventProperty(): ?Event
    {
        return Event::where('user_id', auth()->id())
            ->where('status', '!=', 'cancelled')
            ->orderByRaw("CASE WHEN start_date >= NOW() THEN 0 ELSE 1 END")
            ->orderBy('start_date', 'asc')
            ->first();
    }

    public function getTotalEventsProperty(): int
    {
        return Event::where('user_id', auth()->id())->count();
    }
}

