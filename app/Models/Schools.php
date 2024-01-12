<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasSlug;
use App\Models\News;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Contracts\ContentEntity;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Schools extends Model implements ContentEntity
{
    use HasFactory, HasSlug, HasTranslations;

    protected $fillable = [
        'name',
        'fullname',
        'nameFilter',
        'slug',
        'order_column',
        'school_gtraining_id',
        'name_director',
        'created_by',
        'updated_by',
        'phone',
        'updated_at',
        'created_at',
        'role_director',
        'address1',
        'address2',
        'email',
        'visible',
        'title_partners',
        'subtitle_partners',
        'google_maps_link',
        'presentation_brochure',
        'region',
        'region_name',
        'filter_order',
        'nameMap',
    ];

    public $translatable = [
        'name', 
        'fullname',
        'nameFilter',
        'role_director',
        'address1',
        'address2',
        'title_partners',
        'subtitle_partners',
        'region',
        'region_name',
        'nameMap',
    ];
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function new(){
        return $this->belongsTo(News::class);
    }

    public function creater(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    public function updater(){
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    
    public static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->created_by = auth()->user()->id;
            $model->updated_by = auth()->user()->id;
        });
        self::updating(function($model){
            $model->updated_by = auth()->user()->id;
            
        });
    }
    public function teams()
    {
        return $this->hasMany(Teams::class, 'school_id', 'id');
    }
    public function partners()
    {
        return $this->hasMany(Partners::class, 'school_id', 'id');
    }
    public function getCreatedAt(): ?string
    {
        return $this->created_at->diffForHumans();
    }

    
    public function getCreaterName(): string
    {
        return $this->creater->name;
    }

    public function getUpdaterName(): string
    {
        return (!empty($this->updater->name)) ? $this->updater->name : '';
    }
    public function getUpdatedAt(): ?string
    {
        return $this->updated_at->diffForHumans();
    }

    public function socials(): HasMany
    {
        return $this->hasMany(Socials::class, 'school_id');
    }

}
