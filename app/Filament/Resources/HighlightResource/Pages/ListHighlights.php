<?php

namespace App\Filament\Resources\HighlightResource\Pages;

use App\Filament\Resources\HighlightResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Highlight;
use Illuminate\Database\Eloquent\Builder;

class ListHighlights extends ListRecords
{
    protected static string $resource = HighlightResource::class;

    protected static ?string $title = 'Destaques';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getTableQuery(): Builder 
    {   
        $query = Highlight::query();
        $user = auth()->user();
        $query->whereIn('school_id', json_decode($user->school_id));
        return $query;
    } 
}
