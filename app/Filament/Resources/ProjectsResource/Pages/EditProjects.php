<?php

namespace App\Filament\Resources\ProjectsResource\Pages;

use App\Filament\Resources\ProjectsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Seo;

class EditProjects extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = ProjectsResource::class;

    protected static ?string $title = "Editar Projeto";

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $record = $this->record;
        $seo = Seo::where('model_id', $record->id)->where('model_type','App\Models\Projects')->first();
        $data['title_seo'] = (!empty($seo->title) ? $seo->title :'');
        $data['keywords'] = (!empty($seo->keywords) ? $seo->keywords : '');
        $data['author'] = (!empty($seo->author) ? $seo->author : '');
        return $data;
    }


    protected function beforeSave(): void
    {
        $data = $this->data;
        $seo = Seo::where('model_id', $data['id'])->where('model_type','App\Models\Projects')->first();
        if(empty($seo)){
            $seo = new Seo;
            $seo->model_type = 'App\Models\Projects';
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
