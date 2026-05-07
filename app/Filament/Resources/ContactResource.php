<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Messages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Name')->disabled(),
                TextInput::make('email')->label('Email')->disabled(),
                TextInput::make('subject')->label('Subject')->disabled(),
                Textarea::make('message')->label('Message')->disabled(),
                Toggle::make('is_read')->label('Read'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Name'),
                TextColumn::make('subject')->label('Subject'),
                ToggleColumn::make('is_read')->label('Read'),
                TextColumn::make('created_at')->label('Date')->date('Y/m/d H:i'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'edit'  => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}