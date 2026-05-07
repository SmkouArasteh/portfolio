<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Experiences';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('company')
                    ->label('Company')
                    ->required(),
                TextInput::make('position')
                    ->label('Position')
                    ->required(),
                DatePicker::make('start_date')
                    ->label('Start Date')
                    ->required()
                    ->displayFormat('Y/m/d'),
                DatePicker::make('end_date')
                    ->label('End Date')
                    ->displayFormat('Y/m/d')
                    ->nullable(),
                Textarea::make('description')
                    ->label('Description')
                    ->nullable(),
                TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),
                Toggle::make('is_current')
                    ->label('Currently Working')
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $set('end_date', null);
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company')
                    ->label('Company')
                    ->searchable(),
                TextColumn::make('position')
                    ->label('Position'),
                TextColumn::make('start_date')
                    ->label('Start')
                    ->date('Y/m/d'),
                TextColumn::make('end_date')
                    ->label('End')
                    ->date('Y/m/d'),
                ToggleColumn::make('is_current')
                    ->label('Current'),
                TextColumn::make('sort_order')
                    ->label('Order'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit'   => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}