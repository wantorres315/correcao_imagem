<?php

namespace App\Filament\Resources\SchoolsResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Filament\Forms;
use App\Models\Schools;
use App\Models\Teams;

class RelationTeams extends RelationManager
{
    protected static string $relationship = 'teams';

    protected static ?string $title = 'Equipa';

    
    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('name')->label(__('messages.name'))
                ->required(),
                Forms\Components\TextInput::make('linkedin')->label(__('messages.linkedin')),
                Forms\Components\Hidden::make('id'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label(__('messages.name'))
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('linkedin')
                ->label(__('messages.linkedin'))
            
        ])
        ->filters([
            //
        ])
        ->headerActions([
            Tables\Actions\CreateAction::make()
               
        ])
        ->actions([
            Tables\Actions\ViewAction::make()->iconButton(),
            Tables\Actions\EditAction::make()->iconButton(),
            Tables\Actions\DeleteAction::make()->iconButton(),
        ])
        ->groupedBulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }
}
