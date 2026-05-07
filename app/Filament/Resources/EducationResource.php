<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationResource\Pages;
use App\Models\Education;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EducationResource extends Resource
{
    protected static ?string $model = Education::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Education';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('institution')
                    ->label('University / Institution')
                    ->required(),
                TextInput::make('degree')
                    ->label('Degree')
                    ->required(),
                TextInput::make('field_of_study')
                    ->label('Field of Study')
                    ->required(),
                DatePicker::make('start_date')
                    ->label('Start Date')
                    ->required(),
                Textarea::make('description')
                    ->label('Description')
                    ->nullable(),
                DatePicker::make('end_date')
                    ->label('End Date')
                    ->nullable(),
                TextInput::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('institution')
                    ->label('Institution'),
                TextColumn::make('degree')
                    ->label('Degree'),
                TextColumn::make('field_of_study')
                    ->label('Field of Study'),
                TextColumn::make('start_date')
                    ->label('Start')
                    ->date('Y/m/d'),
                TextColumn::make('end_date')
                    ->label('End')
                    ->date('Y/m/d'),
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
            'index'  => Pages\ListEducation::route('/'),
            'create' => Pages\CreateEducation::route('/create'),
            'edit'   => Pages\EditEducation::route('/{record}/edit'),
        ];
    }
}
