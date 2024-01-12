<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;
    protected static ?string $title = 'Utilizadores';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Novo Utilizador'),
        ];
    }

    protected function getTableQuery(): Builder 
    {   
        $query = User::query();
        $user = auth()->user();
        if(!$user->hasRole('Super Admin')){
            $query->join('model_has_roles', 'id','model_id')
            ->join('roles','roles.id', 'model_has_roles.role_id')
            ->where('roles.name','!=','Super Admin' );
        }
        return $query;
    } 
}
