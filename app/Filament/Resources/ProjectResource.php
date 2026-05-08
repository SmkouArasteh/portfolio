<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use RalphJSmit\Laravel\SEO\Models\SEO;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-code-bracket';
    protected static ?string $navigationLabel = 'Projects';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    TextInput::make('title')
                        ->label('Project Title')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn(callable $set, $state) => $set('slug', Str::slug($state))),
                    TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->unique(ignoreRecord: true),
                    Textarea::make('description')
                        ->label('Short Description')
                        ->required(),
                    TextInput::make('url')
                        ->label('Project URL')
                        ->url()
                        ->nullable(),
                    RichEditor::make('content')
                        ->label('Full Content')
                        ->nullable()
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('projects'),
                    FileUpload::make('image')
                        ->label('Image')
                        ->image()
                        ->directory('project')
                        ->nullable(),
                    TextInput::make('github_url')
                        ->label('GitHub URL')
                        ->url()
                        ->nullable(),
                    SpatieTagsInput::make('tags')
                        ->label('Tags'),
                    TextInput::make('sort_order')
                        ->label('Order')
                        ->numeric()
                        ->default(0),
                    Toggle::make('is_published')
                        ->label('Published')
                        ->default(true),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable(),
                TextColumn::make('tags.name')
                    ->label('Tags')
                    ->badge()
                    ->searchable(),
                ToggleColumn::make('is_published')
                    ->label('Published'),
                TextColumn::make('sort_order')
                    ->label('Order'),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->date('Y/m/d'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->actionsColumnLabel('Actions')
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit'   => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}