<?php

namespace App\Filament\Resources\SchoolsResource\Pages;

use App\Filament\Resources\SchoolsResource;
use Filament\Resources\Pages\Page;

class SortSchools extends Page
{
    protected static string $resource = SchoolsResource::class;

    protected static string $view = 'filament.resources.school-resource.pages.sort-schools';

    public function mount(): void
    {
        static::authorizeResourceAccess();
    }
}
