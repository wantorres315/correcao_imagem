<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use App\Models\Schools;


class UserResource extends Resource
{

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $title = 'Utilizadores';
    protected static ?string $navigationGroup = 'Cadastros Gerais';
    protected static ?string $navigationLabel = 'Utilizadores';


    public static function form(Form $form): Form
    {
       
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('roles')->multiple()->relationship('roles', 'name'),
                Forms\Components\Select::make('schools')
                ->relationship()
                ->multiple()
                ->label(__('messages.school_name'))
                ->options(Schools::all()->pluck('name', 'id'))
                ->searchable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make('name')
                      
                        ->alignLeft(),

                    Tables\Columns\TextColumn::make('email')
                    ->searchable()
                        ->alignLeft(),
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label(__('messages.delete')),
                ])->label(__('messages.bulk_actions')),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        $user = auth()->user();
        $modelInstance = new static::$model(); // Create an instance of the model

        $query = $modelInstance->newQuery(); // Start building the query

        if (!$user->hasRole('Super Admin')) {
            $query->join('model_has_roles', 'id', '=', 'model_id')
                ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->where('roles.name', '!=', 'Super Admin');
        }

        return $query->count();
    }
}
