<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNews extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;
    protected static string $resource = NewsResource::class;
    protected static ?string $title = 'Visualizar Notícias';
    protected static string $view = 'infolists.components.box';

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
