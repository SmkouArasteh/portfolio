<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use App\Models\About as AboutModel;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;

class About extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'About Me';
    protected static ?string $title = 'Edit About Me';
    protected static string $view = 'filament.pages.about';

    public ?array $data = [];

    public function mount(): void
    {
        $about = AboutModel::firstOrCreate([], [
            'title' => 'About Me',
            'bio'  => '',
        ]);

        $this->form->fill($about->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Main Information')
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->required(),
                        TextInput::make('full_name')
                            ->label('Full Name')
                            ->nullable(),
                        TextInput::make('position')
                            ->label('Job Position')
                            ->nullable(),
                        DatePicker::make('birth_date')
                            ->label('Date of Birth')
                            ->displayFormat('Y/m/d')
                            ->nullable(),
                        RichEditor::make('bio')
                            ->label('Biography')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Contact Information')
                    ->schema([
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->nullable(),
                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->nullable(),
                    ])
                    ->columns(2),
                Section::make('Files')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Image')
                            ->image()
                            ->disk('public')
                            ->directory('about'),
                        FileUpload::make('resume')
                            ->label('Resume File')
                            ->disk('public')
                            ->directory('resumes')
                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                            ->nullable(),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    protected function getFormStatePath(): ?string
    {
        return 'data';
    }

    public function save(): void
    {
        $about = AboutModel::first();
        $state = $this->form->getState();
        $about->update($state);

        Notification::make()
            ->title('Information saved successfully')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Information')
                ->submit('save'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
