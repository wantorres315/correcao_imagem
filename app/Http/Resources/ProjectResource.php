<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Seo;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $seo = Seo::where('model_type', 'App\Models\Highlight')->where('model_id', $this->id)->first();
        return [
            'id' => $this->id,
            'order' => $this->order_column,
            'title' => $this->title,
            'slug' => $this->slug,
            'school' => $this->school->slug,
            'image' => '',
            'imageSmall' => '',
            'intro' => $this->intro,
            'seo' => [
                'title' => (!empty($seo->title)) ? $seo->title : '',
                'author' => (!empty($seo->author)) ? $seo->author : '', 
                'keywords' =>(!empty($seo->keywords)) ? $seo->keywords : '',
            ],
            'images' => [
                [
                    'src' => '',
                    'alt' => '',
                    'title' => '',
                ]
            ],
            'content' => $this->content,
           
        ];
    }
}
