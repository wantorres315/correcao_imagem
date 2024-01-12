<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Seo;
use App\Models\News;

class EditNews extends EditRecord
{
    use EditRecord\Concerns\Translatable;
 
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
    protected static string $resource = NewsResource::class;
    protected static ?string $title = 'Editar Notícia';
    
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $record = $this->record;
        $seo = Seo::where('model_id', $record->id)->where('model_type','App\Models\News')->first();
        $data['title_seo'] = (!empty($seo->title) ? $seo->title :'');
        $data['keywords'] = (!empty($seo->keywords) ? $seo->keywords : '');
        $data['author'] = (!empty($seo->author) ? $seo->author : '');
        $medias = $record->images();
        
        foreach($medias as $media){
            $custom = $media['custom_properties'];
            if(!empty($custom->title)){
                $data['gallery'][$media['uuid']]['title'] = ($custom->title) ? $custom->title : '';
            }
            if(!empty($custom->alt)){
                $data['gallery'][$media['uuid']]['alt'] = ($custom->alt) ? $custom->alt : '';
            }
           
            $data['gallery'][$media['uuid']]['media'] = [ $media['uuid'] => $media['uuid']];
        }

       return $data;
    }

    protected function beforeSave(): void
    {
        $news = News::find($this->data['id']);
        $medias = $news->images();

        $data = $this->data;
        
        foreach($medias as $i=>$media){
            $gallerys = array_values($data['gallery']);
            foreach($gallerys as $j=>$gallery){
                if($j === $i){
                    $media->custom_properties = [
                        'alt' => $gallery['alt'],
                        'title' => $gallery['title']
                    ];
                    $media->save();
                }
            }
        }
        
        $seo = Seo::where('model_id', $data['id'])->where('model_type','App\Models\News')->first();
        if(empty($seo)){
            $seo = new Seo;
            $seo->model_type = 'App\Models\News';
            $seo->model_id = $data['id'];
        }
        $seo->title = $data['title_seo'];
        $seo->author = $data['author'];
        $seo->keywords = $data['keywords'];
        $seo->save();
    }
    
}
