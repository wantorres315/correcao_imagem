<?php

namespace App\Filament\Resources\SchoolsResource\Pages;

use App\Filament\Resources\SchoolsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchools extends ListRecords
{
    protected static string $resource = SchoolsResource::class;
    protected static ?string $title = 'Escolas';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Nova Escola'),
        ];
    }
}
