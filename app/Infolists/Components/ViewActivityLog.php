<?php

namespace App\Infolists\Components;

use Filament\Infolists\Components\Component;

class ViewActivityLog extends Component
{
    protected string $view = 'filament.infolists.components.view-activity-log';
    public static function make(): static
    {
        return app(static::class);
    }
}
