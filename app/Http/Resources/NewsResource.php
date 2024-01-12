<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use DateTime;
use App\Models\Schools;
use App\Models\Seo;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $seo = Seo::where('model_type', 'App\Models\News')->where('model_id', $this->id)->first();
        $date = new DateTime($this->date);
        $dateFormat = strtoupper($date->format('d M Y'));
        $urlGallery=[];
        foreach($this->getMedia('gallery') as $k => $gallery){
            $urlGallery[$k]['src']=$gallery->getUrl();
            $urlGallery[$k]['alt']='alterar aqui';
            $urlGallery[$k]['title']='alterar aqui';
        }
   
        return [
            'order'=> $this->order_column,
            'slug' => $this->slug,
            'date' => $this->date,
            'dateFormatted' => $dateFormat,
            'school'=> Schools::find($this->school_id)->slug,
            'highlight' => ($this->highlight ==1) ?'true':'false',
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'intro' => $this->intro,
            'seo' => [
                'title' => (!empty($seo->title)) ? $seo->title : '',
                'author' => (!empty($seo->author)) ? $seo->author : '', 
                'keywords' =>(!empty($seo->keywords)) ? $seo->keywords : '',
            ],
            'image'=>  '',
            'imageHighlight' => '',
            'images' => [
                [
                    'src' => '',
                    'alt' => '',
                    'title' => ''
                ],
                [
                    'src' => '',
                    'alt' => '',
                    'title' => ''
                ],
            ],
            'content' => $this->content,

         
        ];
    }
}
