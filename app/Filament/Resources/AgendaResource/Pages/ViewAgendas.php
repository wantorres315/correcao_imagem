<?php

namespace App\Filament\Resources\AgendaResource\Pages;

use App\Filament\Resources\AgendaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAgendas extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;
    protected static string $resource = AgendaResource::class;
    protected static ?string $title = 'Visualizar Agenda';
    protected static string $view = 'infolists.components.box';

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
