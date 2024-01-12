<?php

namespace App\Filament\Resources\CoursesCategoryResource\Pages;

use App\Filament\Resources\CoursesCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCoursesCategories extends ListRecords
{
    
    protected static string $resource = CoursesCategoryResource::class;

    protected static ?string $title = 'Categoria de Cursos';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
