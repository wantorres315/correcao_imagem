<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Seo;

class TestimonialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $seo = Seo::where('model_type', 'App\Models\Testimonials')->where('model_id', $this->id)->first();
        return [
            'id' => $this->id,
            'order' => $this->order_column,
            'slug' => $this->slug,
            'school' => $this->school->slug,
            'name' => $this->name,
            'role' => $this->role,
            'intro' => $this->intro,
            'seo' => [
                'title' => (!empty($seo->title)) ? $seo->title : '',
                'author' => (!empty($seo->author)) ? $seo->author : '', 
                'keywords' =>(!empty($seo->keywords)) ? $seo->keywords : '',
            ],
            'image' => '',
            'imageSidebar' => '',
            'images' => [
                [
                    'src' => '',
                    'alt' => '',
                    'title' => ''
                ]
            ],
            'content' => $this->content,
           
        ];
    }
}
