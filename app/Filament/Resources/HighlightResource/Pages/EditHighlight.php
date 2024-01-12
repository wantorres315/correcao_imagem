<?php

namespace App\Filament\Resources\HighlightResource\Pages;

use App\Filament\Resources\HighlightResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Seo;

class EditHighlight extends EditRecord
{
    protected static string $resource = HighlightResource::class;

    protected static ?string $title = 'Editar Destaque';

    use EditRecord\Concerns\Translatable;
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $record = $this->record;
        $seo = Seo::where('model_id', $record->id)->where('model_type','App\Models\Highlight')->first();
        $data['title_seo'] = (!empty($seo->title) ? $seo->title :'');
        $data['keywords'] = (!empty($seo->keywords) ? $seo->keywords : '');
        $data['author'] = (!empty($seo->author) ? $seo->author : '');
       // dd($this->record);
       return $data;
    }
    protected function beforeSave(): void
    {
        $data = $this->data;
        $seo = Seo::where('model_id', $data['id'])->where('model_type','App\Models\Highlight')->first();
        if(empty($seo)){
            $seo = new Seo;
            $seo->model_type = 'App\Models\Highlight';
            $seo->model_id = $data['id'];
        }
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
