<?php

namespace App\Filament\Resources\ProjectsResource\Pages;

use App\Filament\Resources\ProjectsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Seo;

class CreateProjects extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = ProjectsResource::class;

    protected static ?string $title = "Criar Projeto";

    protected function afterCreate(): void
    {
        $data = $this->data;
        $record = $this->record;
        $seo = new Seo();
        $seo->model_type = 'App\Models\Projects';
        $seo->model_id = $record->id;
        $seo->title = $data['title_seo'];
        $seo->author = $data['author'];
        $seo->keywords = $data['keywords'];
        $seo->save();
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
