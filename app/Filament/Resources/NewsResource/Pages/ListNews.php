<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Models\News;

class ListNews extends ListRecords
{
    protected static string $resource = NewsResource::class;
    protected static ?string $title = 'Notícias';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('messages.new_new')),
        ];
    }

    protected function getTableQuery(): Builder 
    {   
        $query = News::query();
        $user = auth()->user();
        $query->whereIn('school_id', json_decode($user->school_id));
        return $query;
    } 
}
