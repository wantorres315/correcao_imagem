<?php

namespace App\Filament\Resources\TestimonialsResource\Pages;

use App\Filament\Resources\TestimonialsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Testimonials;

class ListTestimonials extends ListRecords
{
    protected static string $resource = TestimonialsResource::class;

    protected static ?string $title = 'Testemunhos';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getTableQuery(): Builder 
    {   
        $query = Testimonials::query();
        $user = auth()->user();
        $query->whereIn('school_id', json_decode($user->school_id));
        return $query;
    } 
}
