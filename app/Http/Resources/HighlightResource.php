<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use DateTime;
use App\Models\Seo;

class HighlightResource extends JsonResource
{
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $seo = Seo::where('model_type', 'App\Models\Highlight')->where('model_id', $this->id)->first();
        $date = new DateTime($this->date);
        $dateFormat = strtoupper($date->format('d M Y'));
        return [
            'id' => $this->id,
            'order' => $this->order_column,
            'slug' => $this->slug,
            'date' => $this->date,
            'dateFormatted' => $dateFormat,
            'school' => $this->school->slug,
            'highlight' => ($this->highlight ==1) ?'true':'false',
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'link' => $this->link,
            'target' => $this->target,
            'seo' => [
                'title' => (!empty($seo->title)) ? $seo->title : '',
                'author' => (!empty($seo->author)) ? $seo->author : '', 
                'keywords' =>(!empty($seo->keywords)) ? $seo->keywords : '',
            ],
            'image' => '',
            'imageHighlight' => '',
            'images' => [
                [
                    'src' => '',
                    'alt' => '',
                    'title' => '',
                ],
                [
                    'src' => '',
                    'alt' => '',
                    'title' => '',
                ],
            ],
            'content' => $this->content,
           
        ];
    }
}
