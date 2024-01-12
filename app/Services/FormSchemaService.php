<?php

namespace App\Services;

use App\Models\Highlight; // Certifique-se de importar o modelo correto
use Filament\Forms\Components;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Schools;
use App\Models\News;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Contracts\ContentEntity;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class FormSchemaService
{
    public static function getFormSchema(string $section = 'blockMain', string $model = null): array
    {
        $block = [];
        $service = new self();
        
        if ($section === 'details') {

            $block[] = $service->blocks('order_column');
            
            if($model === 'courses'){
                $block[] = $service->blocks('course_category_id');
                $block[] = $service->blocks('schools');
            }
            if (in_array($model, ['news', 'highlight', 'agenda', 'project', 'testimonial'])) {
                $block[] = $service->blocks('school_id');
            }
        
            if ($model === 'school') {
                $block[] = $service->blocks('gtraining_id');
                $block[] = $service->blocks('visible');
                $block[] = $service->blocks('filter_order');
            }
        
            if (in_array($model, ['news', 'highlight', 'agenda'])) {
                $block[] = $service->blocks('date');
            }
        
            if ($model === 'news') {
                $block[] = $service->blocks('dateUnpublish');
            } elseif ($model === 'agenda') {
                $block[] = $service->blocks('dateEnd');
            }
            if (in_array($model, ['news', 'highlight', 'agenda', 'project', 'testimonial', 'courses_category', 'courses'])) {
                $block = array_merge($block, [
                     $service->blocks('status'),
                ]);
            }
            if (in_array($model, ['news', 'highlight', 'agenda', 'project', 'testimonial'])) {
                $block = array_merge($block, [
                    $service->blocks('highlight'),
                ]);
            }
        }
        
        if ($section === 'images' && $model === 'news') {
            $block[] = $service->blocks('gallery');
        }
        
        if ($section === 'blockMain') {
            $block = array_merge($block, [
                !in_array($model, ['testimonial', 'school', 'courses_category']) ? $service->blocks('title') : null,
                in_array($model, ['testimonial', 'school', 'courses_category']) ? $service->blocks('name') : null,
                $service->blocks('slug'),
                ($model === 'testimonial') ? $service->blocks('role') : null,
                ($model === 'school') ? $service->blocks('fullname') : null,
                ($model === 'school') ? $service->blocks('nameFilter') : null,
               
                in_array($model, ['news', 'highlight','courses']) ? $service->blocks('subtitle') : null,
                in_array($model, ['news', 'agenda', 'testimonial', 'project']) ? $service->blocks('intro') : null,
                ($model != 'school' && $model != 'courses_category' && $model != 'courses') ? $service->blocks('content') : null,
                
            ]);
            if($model === 'courses_category'){
                $block[] =  $service->blocks('access');
            }
        
            if($model === 'school') 
            {
                $block = array_merge($block, [
                    $service->blocks('name_director'),
                    $service->blocks('role_director'),
                    $service->blocks('phone'),
                    $service->blocks('email'),
                    $service->blocks('address1'),
                    $service->blocks('address2'),
                    $service->blocks('title_partners'),
                    $service->blocks('subtitle_partners'),
                    $service->blocks('google_maps_link'),
                    $service->blocks('region'),
                    $service->blocks('region_name'),
                    $service->blocks('nameMap'),
                    
                   
                ]);
            }
            if(in_array($model, ['school', 'courses'])){
                $block[] = $service->blocks('presentation_brochure');
            }
            if($model === 'courses'){
                $block = array_merge($block, [
                $service->blocks('applyNow'),
                    $service->blocks('moreInformation'),
                    $service->blocks('description'),
                    $service->blocks('requirements'),
                    $service->blocks('structureAndFees'),
                    $service->blocks('mainActivities'),
                    $service->blocks('furtherStudies'),
                    $service->blocks('certification'),
                    $service->blocks('professionalOutgoings'),
                ]);
            }
        
            if ($model === 'news') {
                $block = array_merge($block, [
                    $service->blocks('highlight_img'),
                    $service->blocks('list_img'),
                ]);
            }
        
            if ($model === 'highlight') {
                $block = array_merge($block, [
                    $service->blocks('link'),
                    $service->blocks('target'),
                ]);
            }
        
            if ($model === 'agenda') {
                $block = array_merge($block, [
                    $service->blocks('location'),
                    $service->blocks('location_link'),
                ]);
            }
        }
        if($section === 'social'){
            $block[] = $service->blocks('social');
        }
        if ($section === 'seo') {
            $block = array_merge($block, [
                $service->blocks('title_seo'),
                $service->blocks('keywords'),
                $service->blocks('author'),
            ]);
        }
        
        if ($section === 'whoEdits') {
            $block = array_merge($block, [
                $service->blocks('creater'),
                $service->blocks('updater'),
            ]);
        }

        if($section === 'quote'){
            $block[] = $service->blocks('quote_author');
            $block[] = $service->blocks('quote_title');
            $block[] = $service->blocks('quote_text');
            
        }

        if($section === 'presentation'){
            $block[] = $service->blocks('presentation_text');
            $block[] = $service->blocks('presentation_list');
        }
        if($section === 'table_curricular'){
            $block[] = $service->blocks('table_curricular');
        }
        return array_filter($block);
        
    }
    private function blocks(string $name, string $type='null', )
    {
        switch ($name) {
            case 'schools':
                $user = auth()->user();
                $block = Forms\Components\Select::make('schools')
                ->relationship()
                ->multiple()
                ->label(__('messages.school_name'))
                ->options(Schools::where('id', json_decode($user->school_id))->pluck('name', 'id'))
                ->searchable();
            break;
            case 'school_id':
                $user = auth()->user();
                $block = Forms\Components\Select::make('school_id')
                ->label(__('messages.school_name'))
                ->options(Schools::where('id', json_decode($user->school_id))->pluck('name', 'id'))
                ->searchable();
                break;
            case 'course_category_id':
                $block = Forms\Components\Select::make('course_category_id')
                ->label(__('messages.course_category'))
                ->options(\App\Models\CoursesCategory::all()->pluck('name', 'id'))
                ->searchable();
                break;
            case 'order_column':
                $block = Forms\Components\TextInput::make('order_column')
                ->label(__('messages.order'))
                ->required()
                ->numeric();
                break;
            case 'date':
                $block = Forms\Components\DateTimePicker::make('date')
                ->label(__('messages.date_publish'))
                ->required();
                break;
            case 'dateUnpublish':
                $block = Forms\Components\DateTimePicker::make('dateUnpublish')
                ->label(__('messages.date_unpublish'));
                break;
            case 'status':
                $block = Forms\Components\Select::make('status')
                ->label(__('messages.status'))->options([
                    'draft' => __('messages.draft'),
                    'reviewing' => __('messages.reviewing'),
                    'published' => __('messages.published'),
                ]);
                break;
            case 'highlight':
                $block =  Forms\Components\Toggle::make('highlight')
                ->label(__('messages.highlight'));
                break;
           
            case 'creater':
                $block =  Forms\Components\Placeholder::make('created_at')
                ->label(__('messages.created_at'))
                ->content(function (ContentEntity $record): ?string {
                    return $record->getCreatedAt() ? $record->getCreatedAt() . " " . __("messages.by") . " " . $record->getCreaterName() : null;
                });
                break;
            case 'updater':
                $block = Forms\Components\Placeholder::make('updated_at')
                    ->label(__('messages.updated_at'))
                    ->content(function (ContentEntity $record): ?string {
                        return $record->getUpdatedAt() ? $record->getUpdatedAt() . " " . __("messages.by") . " " . $record->getUpdaterName() : null;
                    });
                break;
            case 'title':
                $block = Forms\Components\TextInput::make('title')
                ->label(__('messages.title'))
                ->required()
                ->maxLength(255);
                break;
            case 'slug':
                $block = Forms\Components\TextInput::make('slug')
                ->disabled();
                break;
            case 'subtitle':
                $block = Forms\Components\Textarea::make('subtitle')
                ->label(__('messages.subtitle'))
                ->maxLength(65535)
                ->columnSpanFull();
                break;
            case 'content':
                $block =  TinyEditor::make('content')
                ->label(__('messages.content'))
                   ->columnSpanFull();
                break;
                case 'intro':
                    $block = Forms\Components\Textarea::make('intro')
                    ->label(__('messages.intro'))
                    ->maxLength(65535)
                    ->columnSpanFull();
                    break;
                case 'list_img':
                    $block = SpatieMediaLibraryFileUpload::make('list_img')
                    ->label(__('messages.list_img'))
                    ->collection('list')
                    ->hint('325x205')
                    ->image()
                    ->optimize('webp')
                    ->imageEditor()
                    ->preserveFilenames()
                    ->imageEditorMode(2);
                    break;
                case 'highlight_img':
                    $block = SpatieMediaLibraryFileUpload::make('highlight_img')
                    ->label(__('messages.highlight_img'))
                    ->collection('highlight')
                    ->hint('260x160')
                    ->image()
                    ->optimize('webp')
                    ->imageEditor()
                    ->preserveFilenames()
                    ->imageEditorMode(2);
                    break;
                case 'link':
                    $block =  Forms\Components\TextInput::make('link')
                    ->label(__('messages.external_link'))
                    ->maxLength(255);
                    break;
                case 'target':
                    $block =  Forms\Components\Select::make('target')
                    ->label(__('messages.target'))
                    ->options(["_self" => "Mesma página", "_blank" => "Nova página"] );
                    break;
                case 'gallery':
                    $block = Forms\Components\Repeater::make('gallery')
                    ->label(__('messages.gallery'))
                    ->schema([
                        Forms\Components\TextInput::make('alt')
                        ->maxLength(255),
                        Forms\Components\TextInput::make('title')
                        ->maxLength(255),
                        SpatieMediaLibraryFileUpload::make('media')
                     
                        ->label(__('messages.list_img'))
                        ->collection('gallery')
                        ->hint('1200x800')
                        ->loadStateFromRelationshipsUsing(function (SpatieMediaLibraryFileUpload $component, HasMedia $record) {
                            /** @var Model&HasMedia $record */
                            $files = $record->load('media')->getMedia('gallery')
                                ->where('id', $component->getState())
                                ->take(1)
                                ->mapWithKeys(function (Media $file): array {
                                    $uuid = $file->getAttributeValue('uuid');
            
                                    return [$uuid => $uuid];
                                })
                                ->toArray();
            
                            $component->state($files);
                        })
                        ->image()
                        ->optimize('webp')
                        ->imageEditor()
                        ->imageEditorMode(2)
                        ->preserveFilenames()
                        ])->maxItems(config('app.gallery_max_files'));
                    break;
                case 'dateEnd':
                    $block = Forms\Components\DateTimePicker::make('dateEnd')
                    ->label(__('messages.date_end'));
                    break;
                case 'location':
                    $block = Forms\Components\TextInput::make('location')->label(__('messages.location'));
                    break;
                case 'location_link':
                    $block = Forms\Components\TextInput::make('location_link')->label(__('messages.location_link'));
                    break;
                case 'name':
                    $block = Forms\Components\TextInput::make('name')->label(__('messages.name'));
                    break;
                case 'role':
                    $block = Forms\Components\TextInput::make('role')->label(__('messages.role'));
                    break;
                case 'title_seo':
                    $block = Forms\Components\TextInput::make('title_seo')->label(__('messages.title'));
                    break;
                case 'keywords':
                    $block = Forms\Components\TextInput::make('keywords')->label(__('messages.keywords'));
                    break;
                case 'author':
                    $block = Forms\Components\TextInput::make('author')->label(__('messages.author'));
                    break;
                case 'images_seo':
                    $block = Forms\Components\TextInput::make('images_seo')->label(__('messages.images'));
                    break;
                case 'gtraining_id':
                    $block = Forms\Components\TextInput::make('school_gtraining_id')
                    ->label(__('messages.graining_number'))
                    ->numeric();
                    break;
                case 'fullname':
                    $block = Forms\Components\TextInput::make('fullname')
                        ->label(__('messages.fullname'))
                        ->required()
                        ->maxLength(500);
                    break;
                case 'nameFilter':
                    $block = Forms\Components\TextInput::make('nameFilter')
                        ->label(__('messages.nameFilter'))
                        ->required()
                        ->maxLength(150);
                    break;
                case 'visible':
                    $block = Forms\Components\Toggle::make('visible')
                    ->label(__('messages.visible'));
                    break;
                case 'name_director':
                    $block = Forms\Components\TextInput::make('name_director')
                    ->label(__('messages.name_director'));
                    break;
                case 'role_director':
                    $block = Forms\Components\TextInput::make('role_director')
                    ->label(__('messages.role_director'));
                    break;
                case 'phone':
                    $block = Forms\Components\TextInput::make('phone')
                    ->label(__('messages.phone'));
                    break;
                case 'email':
                    $block = Forms\Components\TextInput::make('email')
                    ->label(__('messages.email'));
                    break;
                case 'address1':
                    $block = Forms\Components\TextInput::make('address1')
                    ->label(__('messages.address1'));
                    break;
                case 'address2':
                    $block = Forms\Components\TextInput::make('address2')
                    ->label(__('messages.address2'));
                    break;
                case 'social':
                    $arraySocial = [
                        'facebook' => 'Facebook',
                        'instagram' => 'Instagram',
                        'linkedin' => 'Linkedin',
                        'youtube' => 'Youtube',
                        'tiktok' => 'TikTok',
                        'twitter' => 'X(Twitter)',
                        'pinterest' => 'Pinterest',
                        'hosco' => 'Hosco',
                    ];
                    $block = Forms\Components\Repeater::make('socials')
                    ->relationship()
                    ->schema([
                        Forms\Components\Select::make('type')
                        ->options($arraySocial),
                        Forms\Components\TextInput::make('url'),
                        
                       
                    ])->label(__('messages.social'));
                 
                    break;
                case 'table_curricular':
                    $block = Forms\Components\Repeater::make('table_curricular')
                    ->relationship()
                    ->schema([
                        Forms\Components\TextInput::make('title')->label(__('messages.title')),
                        TinyEditor::make('content')
                        ->label(__('messages.content'))
                        ->columnSpanFull()
                    ])->label(__('messages.content'));
                    break;
                case 'title_partners':
                    $block = Forms\Components\TextInput::make('title_partners')
                    ->label(__('messages.title_partners'));
                    break;
                case 'subtitle_partners':
                    $block = Forms\Components\TextInput::make('subtitle_partners')
                    ->label(__('messages.subtitle_partners'));
                    break;
                case 'google_maps_link':
                    $block = Forms\Components\TextInput::make('google_maps_link')
                    ->label(__('messages.google_maps_link'));
                    break;
                case 'presentation_brochure':
                    $block = Forms\Components\FileUpload::make('presentation_brochure')
                    ->label(__('messages.presentation_brochure'))
                    ->preserveFilenames()
                    ->acceptedFileTypes(['application/pdf']);
                    break;
                case 'applyNow':
                    $block = Forms\Components\TextInput::make('applyNow')
                    ->label(__('messages.applyNow'));
                    break;
                case 'moreInformation':
                    $block = Forms\Components\TextInput::make('moreInformation')
                    ->label(__('messages.moreInformation'))
                    ->columnSpanFull();
                    break;
                case 'region':
                    $block = Forms\Components\TextInput::make('region')
                    ->label(__('messages.region'));
                    break;
                case 'region_name':
                    $block = Forms\Components\TextInput::make('region_name')
                    ->label(__('messages.region_name'));
                    break;
                case 'filter_order':
                    $block = Forms\Components\TextInput::make('filter_order')
                    ->label(__('messages.filter_order'))
                    ->numeric();
                    break;
                case 'nameMap':
                    $block = Forms\Components\TextInput::make('nameMap')
                    ->label(__('messages.nameMap'));
                    break;
                case 'access':
                    $block = Forms\Components\TextInput::make('access')
                    ->label(__('messages.access'));
                    break;
                case 'quote_author':
                    $block = Forms\Components\TextInput::make('quote_author')
                    ->label(__('messages.quote_author'));
                    break;
                case 'quote_title':
                    $block = Forms\Components\TextInput::make('quote_title')
                    ->label(__('messages.quote_title'));
                    break;
                case 'quote_text':
                    $block =  TinyEditor::make('quote_text')
                    ->label(__('messages.quote_text'))
                    ->columnSpanFull();
                    break;
                case 'description':

                    $block =  TinyEditor::make('description')
                    ->label(__('messages.description'))
                    ->columnSpanFull();
                    break;
                case 'presentation_text':
                    $block =  TinyEditor::make('presentation_text')
                    ->label(__('messages.presentation_text'))
                    ->columnSpanFull();
                    break;
                case 'presentation_list':
                    $block =  TinyEditor::make('presentation_list')
                    ->label(__('messages.presentation_list'))
                    ->columnSpanFull();
                    break;
                case 'requirements':
                    $block =  TinyEditor::make('requirements')
                    ->label(__('messages.requirements'))
                    ->columnSpanFull();
                    break;
                case 'structureAndFees':
                    $block =  TinyEditor::make('structureAndFees')
                    ->label(__('messages.structureAndFees'))
                    ->columnSpanFull();
                    break;
                case 'mainActivities':
                    $block =  TinyEditor::make('mainActivities')
                    ->label(__('messages.mainActivities'))
                    ->columnSpanFull();
                    break;
                case 'furtherStudies':
                    $block =  TinyEditor::make('furtherStudies')
                    ->label(__('messages.furtherStudies'))
                    ->columnSpanFull();
                    break;
                case 'certification':
                    $block =  TinyEditor::make('certification')
                    ->label(__('messages.certification'))
                    ->columnSpanFull();
                    break;
                case 'professionalOutgoings':
                    $block =  TinyEditor::make('professionalOutgoings')
                    ->label(__('messages.professionalOutgoings'))
                    ->columnSpanFull();
                    break;
            }
        return $block;
    }
}