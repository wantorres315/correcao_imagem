<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasSlug;
use App\Models\Schools;
use App\Contracts\ContentEntity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Testimonials extends Model  implements ContentEntity
{
    use HasFactory, HasSlug, HasTranslations;
    protected $fillable = [
        'name',
        'order_column',
        'slug',
        'status',
        'school_id',
        'title',
        'intro',
        'content',
    ];
    public $translatable = [
        'name', 
        'intro',
        'content',
    ];
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function creater(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    public function updater(){
        return $this->hasOne(User::class, 'id', 'updated_by');
    }
    public function school()
    {
        return $this->hasOne(Schools::class, 'id', 'school_id');
    }
    public function schools(): BelongsTo
    {
        return $this->belongsTo(Schools::class, 'school_id');
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
}
