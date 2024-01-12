<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Schools;
use App\Contracts\ContentEntity;
use Spatie\Translatable\HasTranslations;

class Courses extends Model implements ContentEntity
{
    use HasFactory, HasSlug, HasTranslations;
    protected $fillable = [
        'course_category_id',
        'slug',
        'order_column',
        'title',
        'subtitle',
        'quote_title',
        'quote_author',
        'quote_text',
        'presentation_brochure',
        'applyNow',
        'moreInformation',
        'description',
        'presentation_text',
        'presentation_list',
        'requirements',
        'structureAndFees',
        'mainActivities',
        'furtherStudies',
        'certification',
        'professionalOutgoings',
        'status',
    ];
    
    public $translatable = [
        'title', 
        'intro',
        'content',
       
    ];
    protected $casts = [
        'schools' => 'array',
    ];
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
        static::saving(function ($model) {
            $slugOptions = $model->getSlugOptions();
            $model->generateSlug($slugOptions);
        });
        
    }

    public function getSlugOptions() : SlugOptions
    {
      
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
            
    }

    public function table_curricular(){
        return $this->hasMany(ContentCourse::class, 'course_id');
    }
}
