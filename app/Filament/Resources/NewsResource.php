<?php
namespace App\Filament\Resources;


use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use App\Models\Schools;

use Illuminate\Support\Carbon;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\ViewEntry;
use App\Services\FormSchemaService;
use App\Services\TableSchemaService;
use Filament\Resources\Concerns\Translatable;

class NewsResource extends Resource
{
    use Translatable;
    protected static ?string $model = News::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $title = 'Notícias';
    protected static ?string $navigationLabel = 'Notícias';
    protected static ?string $navigationGroup = 'Editorial';

  

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('blockMain', 'news'))
                        ->columns(2),
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('images','news'))
                        ->columns(1),
                ])
                ->columnSpan(['lg' => 2]),
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('details', 'news'))
                        ->columnSpan(['lg' => 1]),
                    Forms\Components\Section::make(__('messages.seo'))
                        ->schema(FormSchemaService::getFormSchema('seo'))
                        ->columnSpan(['lg' => 1]),   
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('whoEdits'))
                        ->columnSpan(['lg' => 1])
                        ->hidden(fn (?News $record) => $record === null),
                ])
            ])
            ->columns(3);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns(TableSchemaService::getTableSchema('news'))
            ->filters(TableSchemaService::getFilterSchema('news'))
            ->actions([
                Tables\Actions\ViewAction::make()->iconButton(),
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
                
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label(__('messages.delete')),
                ])->label(__('messages.bulk_actions')),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
        ->schema([
            Infolists\Components\Section::make()->schema([
                ViewEntry::make('list')
                ->view('infolists.components.news.list')
            ]),
            Infolists\Components\Section::make()->schema([
                ViewEntry::make('highlight')
                ->view('infolists.components.news.highlight')
            ]),
            Infolists\Components\Section::make()->schema([
                ViewEntry::make('content')
                ->view('infolists.components.news.content')
            ])
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
            
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $user = auth()->user();
        return static::$model::where('status', 'published')->whereIn('school_id',json_decode($user->school_id))->count();
    }
}
    
