<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoursesCategoryResource\Pages;
use App\Filament\Resources\CoursesCategoryResource\RelationManagers;
use App\Models\CoursesCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Services\FormSchemaService;
use Filament\Resources\Concerns\Translatable;
use App\Services\TableSchemaService;

class CoursesCategoryResource extends Resource
{
    use Translatable;
    protected static ?string $model = CoursesCategory::class;

    protected static ?string $title = 'Categoria de Curso';
    protected static ?string $navigationLabel = 'Categoria de Curso';
    protected static ?string $navigationGroup = 'Cadastros Gerais';
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('blockMain', 'courses_category'))
                        ->columns(2),
                ])
                ->columnSpan(['lg' => 2]),
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make(__('messages.details'))
                        ->schema(FormSchemaService::getFormSchema('details', 'courses_category'))
                        ->columnSpan(['lg' => 1]),
                  
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('whoEdits'))
                        ->columnSpan(['lg' => 1])
                        ->hidden(fn (?CoursesCategory $record) => $record === null),
                ])
            ])
            ->columns(3);
           
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns(TableSchemaService::getTableSchema('courses_category'))
        ->filters(TableSchemaService::getFilterSchema('courses_category'))
        ->actions([
            Tables\Actions\EditAction::make()->iconButton(),
            Tables\Actions\DeleteAction::make()->iconButton()
           
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
            'index' => Pages\ListCoursesCategories::route('/'),
            'create' => Pages\CreateCoursesCategory::route('/create'),
            'edit' => Pages\EditCoursesCategory::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::$model::where('status', 'published')->count();
    }
}
