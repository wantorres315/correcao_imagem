<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoursesResource\Pages;
use App\Filament\Resources\CoursesResource\RelationManagers;
use App\Models\Courses;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Services\FormSchemaService;
use Filament\Resources\Concerns\Translatable;
use App\Services\TableSchemaService;

class CoursesResource extends Resource
{
    use Translatable;
    protected static ?string $model = Courses::class;
    protected static ?string $title = 'Cursos';
    protected static ?string $navigationLabel = 'Cursos';
    protected static ?string $navigationGroup = 'Editorial';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('blockMain', 'courses'))
                        ->columns(2),
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('quote', 'courses')),
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('presentation', 'courses')),
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('table_curricular', 'courses'))
                        ])
                ->columnSpan(['lg' => 2]),
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make(__('messages.details'))
                        ->schema(FormSchemaService::getFormSchema('details', 'courses'))
                        ->columnSpan(['lg' => 1]),
                    Forms\Components\Section::make(__('messages.seo'))
                        ->schema(FormSchemaService::getFormSchema('seo'))
                        ->columnSpan(['lg' => 1]),
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('whoEdits'))
                        ->columnSpan(['lg' => 1])
                        ->hidden(fn (?Courses $record) => $record === null),
                ])
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns(TableSchemaService::getTableSchema('courses'))
        ->filters(TableSchemaService::getFilterSchema('courses'))
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourses::route('/create'),
            'edit' => Pages\EditCourses::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::$model::where('status', 'published')->count();
    }
}
