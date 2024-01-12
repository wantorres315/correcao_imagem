<?php

namespace App\Filament\Resources\CoursesCategoryResource\Pages;

use App\Filament\Resources\CoursesCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Seo;

class CreateCoursesCategory extends CreateRecord
{
    protected static string $resource = CoursesCategoryResource::class;

    protected static ?string $title = 'Criar Categoria de Curso';

    use CreateRecord\Concerns\Translatable;
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
