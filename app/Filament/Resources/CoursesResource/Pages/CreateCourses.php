<?php

namespace App\Filament\Resources\CoursesResource\Pages;

use App\Filament\Resources\CoursesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Seo;

class CreateCourses extends CreateRecord
{
    protected static string $resource = CoursesResource::class;

    protected static ?string $title = 'Criar Curso';

    use CreateRecord\Concerns\Translatable;
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }

    protected function afterCreate(): void
    {
        $data = $this->data;
        $record = $this->record;
        $seo = new Seo();
        $seo->model_type = 'App\Models\Courses';
        $seo->model_id = $record->id;
        $seo->title = $data['title_seo'];
        $seo->author = $data['author'];
        $seo->keywords = $data['keywords'];
        $seo->save();
    }
}
