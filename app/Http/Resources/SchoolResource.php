<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Socials;
use App\Models\Partners;

class SchoolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $socials = Socials::where('school_id',$this->id)->get();
       
        $socialArray = [];
        foreach($socials as $social){
           
            switch ($social->type) {
                case 'facebook':
                    $icon='mdi:facebook';
                    break;
                case 'instagram':
                    $icon='mdi:instagram';
                    break;
                case 'linkedin':
                    $icon='mdi:linkedin';
                    break;
                case 'youtube':
                    $icon='mdi:youtube';
                    break;
                case 'Hosco':
                    $icon='mdi:external-link';
                    break;
                case 'tiktok':
                    $icon='ic:baseline-tiktok';
                    break;
                case 'pinterest':
                    $icon='mdi:pinterest';
                    break;
                case 'twitter':
                    $icon='x';
                    break;
            }
            $socialArray[] = [
                'name' => ucfirst($social->type),
                'icon' => $icon,
                'url' => $social->url,
            ];
        }

        $partners = Partners::where('school_id',$this->id)->orderBy('order_column','asc')->get();
        $partnersArray = [];
        foreach($partners as $partner){
            $partnersArray[] = [
                'name' => $partner->name,
                'order' => $partner->order_column,
                'url' => $partner->url,
                'image' => '',
            ];
        }
        return [
            'name'=> $this->name,
            'fullname' => $this->fullname,
            'nameFilter' => $this->nameFilter,
            'nameMap' => $this->nameMap,
            'slug' => $this->slug,
            'order' => $this->order_column,
            'filterOrder' => $this->filter_order,
            'school_gtraining_id' => $this->school_gtraining_id,
            'map' => [
                'region' => $this->region,
                'regionName' => $this->region_name,
            ],
            'backgroundImage' => '',
            'logo' => '',
            'googleMapsLink' => $this->google_maps_link,
            'presentationBrochure' => env('APP_URL')."/files/".$this->presentation_brochure,
             "contactsBlock" => [
                "address" => [
                    $this->address1,$this->address2
                ]
            ],
            "StrategicPartnershipsBlock" => [
                'title' => $this->title_partners,
                'subtitle' => $this->subtitle_partners,
                'itens' => $partnersArray,
            ],
            "director" => [
                "name" => $this->name_director,
                "role" => $this->role_director,
            ],
            "phone" => $this->phone,
            "email" => $this->email,
            "social" => $socialArray,

            
        ];
    }
}
