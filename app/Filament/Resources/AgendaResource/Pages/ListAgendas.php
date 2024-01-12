<?php

namespace App\Filament\Resources\AgendaResource\Pages;

use App\Filament\Resources\AgendaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Agenda;

class ListAgendas extends ListRecords
{
   
    protected static string $resource = AgendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
           
        ];
    }

    protected function getTableQuery(): Builder 
    {   
        $query = Agenda::query();
        $user = auth()->user();
        $query->whereIn('school_id', json_decode($user->school_id));
        return $query;
    } 
}
