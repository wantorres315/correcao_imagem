<?php

namespace App\Filament\Resources\CoursesCategoryResource\Pages;

use App\Filament\Resources\CoursesCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Seo;

class EditCoursesCategory extends EditRecord
{
    protected static string $resource = CoursesCategoryResource::class;

    protected static ?string $title = 'Editar Categoria de Curso';

    use EditRecord\Concerns\Translatable;
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
