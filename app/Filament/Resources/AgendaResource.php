<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgendaResource\Pages;
use App\Models\Agenda;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Services\FormSchemaService;
use Filament\Resources\Concerns\Translatable;
use App\Services\TableSchemaService;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\ViewEntry;


class AgendaResource extends Resource
{
    use Translatable;
    protected static ?string $model = Agenda::class;

    protected static ?string $title = 'Agenda';
    protected static ?string $navigationLabel = 'Agenda';
    protected static ?string $navigationGroup = 'Editorial';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('blockMain', 'agenda'))
                        ->columns(2),
                ])
                ->columnSpan(['lg' => 2]),
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make(__('messages.details'))
                        ->schema(FormSchemaService::getFormSchema('details', 'agenda'))
                        ->columnSpan(['lg' => 1]),
                    Forms\Components\Section::make(__('messages.seo'))
                        ->schema(FormSchemaService::getFormSchema('seo'))
                        ->columnSpan(['lg' => 1]),
                    Forms\Components\Section::make()
                        ->schema(FormSchemaService::getFormSchema('whoEdits'))
                        ->columnSpan(['lg' => 1])
                        ->hidden(fn (?Agenda $record) => $record === null),
                ])
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns(TableSchemaService::getTableSchema('agenda'))
        ->filters(TableSchemaService::getFilterSchema('agenda'))
        ->actions([
            Tables\Actions\ViewAction::make()->iconButton(),
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
            'index' => Pages\ListAgendas::route('/'),
            'create' => Pages\CreateAgenda::route('/create'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),
           
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $user = auth()->user();
        return static::$model::where('status', 'published')->whereIn('school_id',json_decode($user->school_id))->count();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
        ->schema([
            Infolists\Components\Section::make()->schema([
                ViewEntry::make('list')
                ->view('infolists.components.agenda.list')
            ]),
            Infolists\Components\Section::make()->schema([
                ViewEntry::make('highlight')
                ->view('infolists.components.agenda.highlight')
            ]),
            Infolists\Components\Section::make()->schema([
                ViewEntry::make('content')
                ->view('infolists.components.agenda.content')
            ])

        ]);

    }
}
