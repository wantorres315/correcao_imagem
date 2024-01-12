<?php

namespace App\Filament\Resources\SchoolsResource\Pages;

use App\Filament\Resources\SchoolsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Seo;

class CreateSchools extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = SchoolsResource::class;

    protected static ?string $title = 'Nova Escola';

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
        $seo->model_type = 'App\Models\Schools';
        $seo->model_id = $record->id;
        $seo->title = $data['title_seo'];
        $seo->author = $data['author'];
        $seo->keywords = $data['keywords'];
        $seo->save();
    }
}
