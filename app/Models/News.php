<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Schools;
use App\Contracts\ContentEntity;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class News extends Model implements HasMedia, ContentEntity
{
    use HasFactory, HasSlug, InteractsWithMedia, HasTranslations;

    protected $fillable = [
        'order_column',
        'slug',
        'date',
        'dateUnpublish',
        'status',
        'school_id',
        'highlight',
        'title',
        'subtitle',
        'intro',
        'content',
        'tags',
    ];
    public $translatable = [
        'title', 
        'subtitle',
        'intro',
        'content',
       
    ];
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
            
    }
    protected $casts = [
        'tags' => 'array',
    ];

    public function school()
    {
        return $this->hasOne(Schools::class, 'id', 'school_id');
    }
    public function schools(): BelongsTo
    {
        return $this->belongsTo(Schools::class, 'school_id');
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
        return $this->updater->name;
    }
    public function getUpdatedAt(): ?string
    {
        return $this->updated_at->diffForHumans();
    }

    public function images()
    {
        return $this->getMedia('gallery');
    }

    public function gallery()
    {
        return $this->belongsToMany(Media::class);
    }
}


