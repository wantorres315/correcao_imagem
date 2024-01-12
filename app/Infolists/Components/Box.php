<?php

namespace App\Infolists\Components;

use Filament\Infolists\Components\Component;

class Box extends Component
{
    protected string $view = 'filament.infolists.components.box';

    public static function make(): static
    {
        return app(static::class);
    }
}
