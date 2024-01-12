<?php

namespace App\Filament\Resources\HighlightResource\Pages;

use App\Filament\Resources\HighlightResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Seo;

class CreateHighlight extends CreateRecord
{
    protected static string $resource = HighlightResource::class;

    protected static ?string $title = 'Criar Destaque';

    use CreateRecord\Concerns\Translatable;
    protected function afterCreate(): void
    {
        $data = $this->data;
        $record = $this->record;
        $seo = new Seo();
        $seo->model_type = 'App\Models\Highlight';
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
