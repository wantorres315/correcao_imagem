<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $record = $this->record;
        $data['schools'] = json_decode($record->school_id);
       
        return $data;
    }
    
}
