<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HighlightResource\Pages;
use App\Models\Highlight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Services\FormSchemaService;
use App\Services\TableSchemaService;
use Filament\Resources\Concerns\Translatable;

class HighlightResource extends Resource
{
    use Translatable;
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $title = 'Destaques';
    protected static ?string $navigationLabel = 'Destaques';
    protected static ?string $navigationGroup = 'Editorial';
    protected static ?string $model = Highlight::class;

    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('blockMain', 'highlight'))
                        ->columns(2),
                ])
                ->columnSpan(['lg' => 2]),
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('details', 'highlight'))
                        ->columnSpan(['lg' => 1]),
                    Forms\Components\Section::make(__('messages.seo'))
                        ->schema(FormSchemaService::getFormSchema('seo'))
                        ->columnSpan(['lg' => 1]),
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('whoEdits'))
                        ->columnSpan(['lg' => 1])
                        ->hidden(fn (?Highlight $record) => $record === null),
                ])
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(TableSchemaService::getTableSchema('highlight'))
            ->filters(TableSchemaService::getFilterSchema('highlight'))
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
            'index' => Pages\ListHighlights::route('/'),
            'create' => Pages\CreateHighlight::route('/create'),
            'edit' => Pages\EditHighlight::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        $user = auth()->user();
        return static::$model::where('status', 'published')->whereIn('school_id',json_decode($user->school_id))->count();
    }
   
    
}
