<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Models\Skill;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;
    protected static ?string $navigationIcon = 'heroicon-o-wrench';
    protected static ?string $navigationLabel = 'Skills';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Skill Name')
                    ->required(),
                TextInput::make('percentage')
                    ->label('Proficiency Percentage')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->required(),
                Select::make('category')
                    ->label('Category')
                    ->options([
                        'Frontend' => 'Frontend',
                        'Backend'  => 'Backend',
                        'DevOps'   => 'DevOps',
                        'Tools'    => 'Tools',
                    ]),
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
                TextColumn::make('name')
                    ->label('Name'),
                TextColumn::make('percentage')
                    ->label('Percentage'),
                TextColumn::make('category')
                    ->label('Category'),
                TextColumn::make('sort_order')
                    ->label('Order'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit'   => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}