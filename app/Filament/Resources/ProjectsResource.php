<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectsResource\Pages;
use App\Filament\Resources\ProjectsResource\RelationManagers;
use App\Models\Projects;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Services\FormSchemaService;
use App\Services\TableSchemaService;
use Filament\Resources\Concerns\Translatable;


class ProjectsResource extends Resource
{
    use Translatable;
    protected static ?string $model = Projects::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $title = 'Projetos';

    protected static ?string $navigationLabel = 'Projetos';

    protected static ?string $navigationGroup = 'Editorial';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Group::make()->schema([
                Forms\Components\Section::make()
                    ->schema(FormSchemaService::getFormSchema('blockMain', 'project'))
                    ->columns(2),
                Forms\Components\Section::make()
                    ->schema(FormSchemaService::getFormSchema('images','project'))
                    ->columns(1),
            ])
            ->columnSpan(['lg' => 2]),
            Forms\Components\Group::make()->schema([
                Forms\Components\Section::make()
                    ->schema(FormSchemaService::getFormSchema('details', 'project'))
                    ->columnSpan(['lg' => 1]),
                Forms\Components\Section::make(__('messages.seo'))
                    ->schema(FormSchemaService::getFormSchema('seo'))
                    ->columnSpan(['lg' => 1]),
                Forms\Components\Section::make()
                    ->schema(FormSchemaService::getFormSchema('whoEdits'))
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Projects $record) => $record === null),
            ])
        ])
        ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(TableSchemaService::getTableSchema('project'))
            ->filters(TableSchemaService::getFilterSchema('project'))
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProjects::route('/create'),
            'edit' => Pages\EditProjects::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $user = auth()->user();
        return static::$model::where('status', 'published')->whereIn('school_id',json_decode($user->school_id))->count();
    }
}
