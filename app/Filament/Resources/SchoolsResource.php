<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolsResource\Pages;
use App\Filament\Resources\SchoolsResource\RelationManagers;
use App\Models\Schools;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Services\FormSchemaService;
use App\Services\TableSchemaService;
use Filament\Resources\Concerns\Translatable;

class SchoolsResource extends Resource
{
    use Translatable;
    protected static ?string $model = Schools::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $title = 'Escolas';

    protected static ?string $navigationLabel = 'Escolas';

    protected static ?string $navigationGroup = 'Cadastros Gerais';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('blockMain', 'school'))
                        ->columns(2),
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('social'))
                        ->columns(1),
                ])
                ->columnSpan(['lg' => 2]),
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('details', 'school'))
                        ->columnSpan(['lg' => 1]),
                    Forms\Components\Section::make(__('messages.seo'))
                        ->schema(FormSchemaService::getFormSchema('seo'))
                        ->columnSpan(['lg' => 1]),
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('whoEdits'))
                        ->columnSpan(['lg' => 1])
                        ->hidden(fn (?Schools $record) => $record === null),
                ])
            ])
            ->columns(3);
        
      
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('messages.school_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('fullname')
                    ->label(__('messages.fullname'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->label(__('messages.order'))
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
                
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Deletar'),
                ])->label("Ações em Massa"),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\RelationTeams::class,
            RelationManagers\RelationPartners::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchools::route('/'),
            'create' => Pages\CreateSchools::route('/create'),
            'edit' => Pages\EditSchools::route('/{record}/edit'),
            
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
}
