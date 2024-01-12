<?php

namespace App\Filament\Resources\TestimonialsResource\Pages;

use App\Filament\Resources\TestimonialsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Seo;

class CreateTestimonials extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = TestimonialsResource::class;

    
    protected static ?string $title = 'Criar Testemunho';

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
    protected function afterCreate(): void
    {
        $data = $this->data;
        $record = $this->record;
        $seo = new Seo();
        $seo->model_type = 'App\Models\Testimonials';
        $seo->model_id = $record->id;
        $seo->title = $data['title_seo'];
        $seo->author = $data['author'];
        $seo->keywords = $data['keywords'];
        $seo->save();
    }
}
