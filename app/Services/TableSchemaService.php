<?php

namespace App\Services;

use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class TableSchemaService
{
    public static function getTableSchema(string $model = null): array
    {
        $block = [];
        $service = new self();
        
        if(in_array($model, ['news', 'highlight', 'agenda', 'project'])){
            $block[] = $service->fields('school_name');
            $block[] = $service->fields('title');
            $block[] = $service->fields('order_column');
            $block[] = $service->fields('slug');
            $block[] = $service->fields('status');
        }
        if(in_array($model, ['news', 'highlight', 'agenda'])){
            $block[] = $service->fields('date');
        }
        if($model === 'testimonial'){
            $block[] = $service->fields('school_name');
            $block[] = $service->fields('name');
            $block[] = $service->fields('order_column');
            $block[] = $service->fields('slug');
            $block[] = $service->fields('status');
        }
        if($model === 'courses_category'){
            $block[] = $service->fields('name');
            $block[] = $service->fields('slug');
        }
        if($model === 'courses'){
            $block[] = $service->fields('title');
            $block[] = $service->fields('slug');
        }
        return $block;
    }

    public static function getFilterSchema(string $model = null): array
    {
        $block = [];
        $service = new self();
        if($model != "courses_category"){
            $block[] = $service->filter('school_id');
        }
        $block[] = $service->filter('status');
        if($model === "news"){
            $block[] = $service->filter('published');
        }
        if($model === "highlight"  || $model === "agenda"){
            $block[] = $service->filter('published_simple');
        }
        return $block;
    }

   
    public static function getStatusLabel($record): ?string {
        switch ($record['status']) {
            case "draft": 
                return __("messages.draft");
            case "reviewing":
                return __("messages.reviewing");
            case "published":
                return __("messages.published");
           
        }
    }
    private function fields($name){
        switch ($name) {
            case 'school_name':
                $block = Tables\Columns\TextColumn::make('school.name')
                ->label(__('messages.school_name'))
                ->sortable();
                break;
            case 'title':
                $block =Tables\Columns\TextColumn::make('title')
                ->label(__('messages.title'))
                ->searchable();
                break;
            case 'name':
                    $block =Tables\Columns\TextColumn::make('name')
                    ->label(__('messages.name'))
                    ->searchable();
                    break;
            case 'order_column':
                $block = Tables\Columns\TextColumn::make('order_column')
                ->label(__('messages.order'))
                ->toggleable(isToggledHiddenByDefault: false)
                ->numeric()
                ->sortable();
                break;
            case 'slug':
                $block = Tables\Columns\TextColumn::make('slug')
                ->toggleable(isToggledHiddenByDefault: false)->searchable();
                break;
            case 'date':
                $block = Tables\Columns\TextColumn::make('date')
                ->label(__('messages.date_publish'))
                ->dateTime()
                ->toggleable(isToggledHiddenByDefault: true)
                ->sortable();
                break;
            case 'status':
                $block =  Tables\Columns\TextColumn::make('status')
                ->label(__('messages.status'))
                ->getStateUsing(fn ($record) => static::getStatusLabel($record))
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true);
                break;
           
            }
        return $block;
    }
    
    private function filter($name){
        switch ($name) {
            case 'school_id':
                $block = Tables\Filters\SelectFilter::make('school_id')
                ->label(__('messages.school_name'))
                ->relationship('schools', 'name')
                ->preload()
                ->multiple()
                ->searchable();
                break;
            case 'published':
                $block =Tables\Filters\Filter::make('published_at')
                ->form([
                    Forms\Components\DatePicker::make('published_from')
                        ->label(__('messages.published_from'))
                        ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),
                    Forms\Components\DatePicker::make('published_until')
                        ->label(__('messages.published_until'))
                        ->placeholder(fn ($state): string => now()->format('M d, Y')),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['published_from'] ?? null,
                            fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                        )
                        ->when(
                            $data['published_until'] ?? null,
                            fn (Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                        );
                })
                ->indicateUsing(function (array $data): array {
                    $indicators = [];
                    if ($data['published_from'] ?? null) {
                        $indicators['published_from'] = __('messages.published_from')." ". Carbon::parse($data['published_from'])->toFormattedDateString();
                    }
                    if ($data['published_until'] ?? null) {
                        $indicators['published_until'] = __('messages.published_until')." ". Carbon::parse($data['published_until'])->toFormattedDateString();
                    }
    
                    return $indicators;
                });
                break;
            case 'status':
                $block = Tables\Filters\SelectFilter::make('status')
                ->options([
                    'draft' => __('messages.draft'),
                    'reviewing' => __('messages.reviewing'),
                    'published' => __('messages.published'),
                ]);
                break;
            case 'published_simple':
                $block =Tables\Filters\Filter::make('published_at')
                ->form([
                    Forms\Components\DatePicker::make('published_from')
                        ->label(__('messages.published_from'))
                        ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['published_from'] ?? null,
                            fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                        );
                       
                })
                ->indicateUsing(function (array $data): array {
                    $indicators = [];
                    if ($data['published_from'] ?? null) {
                        $indicators['published_from'] = __('messages.published_from')." ". Carbon::parse($data['published_from'])->toFormattedDateString();
                    }
                    return $indicators;
                });
                break;
            }
        return $block;
    }
}