<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Seo;
use App\Models\News;

class CreateNews extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = NewsResource::class;

    protected static ?string $title = 'Criar Notícia';

    protected function afterCreate(): void
    {
        $data = $this->data;
        $record = $this->record;
        $seo = new Seo();
        $seo->model_type = 'App\Models\News';
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

    protected function beforeSave(): void
    {
        $news = News::find($this->data['id']);
        $medias = $news->images();

        $data = $this->data;
        
        foreach($medias as $i=>$media){
            $gallerys = array_values($data['gallery']);
            foreach($gallerys as $j=>$gallery){
                dd($gallery);
                if($j === $i){
                    $media->custom_properties = [
                        'alt' => $gallery['alt'],
                        'title' => $gallery['title']
                    ];
                    $media->save();
                }
            }
        }
    }
}
