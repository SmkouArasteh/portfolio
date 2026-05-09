<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.settings';

    protected static ?int $navigationSort = 100;

    public ?array $data = [];

    public function mount()
    {

        $user = Auth::user();
        $setting = Setting::first();

        $this->form->fill([
            // Profile
            'name'     => $user->name,
            'email'    => $user->email,
            'avatar'   => $user->avatar ?? null,
            'password' => null,
            'password_confirmation' => null,

            // Site
            'site_name'        => $setting->site_name ?? null,
            'site_description' => $setting->site_description ?? null,
            'logo'             => $setting->logo ?? null,
            'favicon'          => $setting->favicon ?? null,

            // Social Links
            'github'           => $setting->github ?? null,
            'linkedin'         => $setting->linkedin ?? null,
            'twitter'          => $setting->twitter ?? null,
            'instagram'        => $setting->instagram ?? null,
            'telegram'         => $setting->telegram ?? null,

            // SEO
            'meta_title'       => $setting->meta_title ?? null,
            'meta_description' => $setting->meta_description ?? null,
            'meta_keywords'    => $setting->meta_keywords ?? null,
            'og_image'         => $setting->og_image ?? null,
            'is_indexed'       => $setting->is_indexed ?? true,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Tabs::make('Settings')
                ->tabs([
                    Tabs\Tab::make('Profile')
                        ->icon('heroicon-o-user')
                        ->schema([
                            FileUpload::make('avatar')
                                ->label('Avatar')
                                ->image()
                                ->directory('avatars')
                                ->disk('public')
                                ->avatar()
                                ->columnSpanFull(),

                            TextInput::make('name')
                                ->label('Name')
                                ->required(),

                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->required(),

                            TextInput::make('password')
                                ->label('New Password')
                                ->password()
                                ->confirmed()
                                ->helperText('Leave empty if you do not want to change it.'),

                            TextInput::make('password_confirmation')
                                ->label('Confirm Password')
                                ->password(),
                        ]),

                    Tabs\Tab::make('Site')
                        ->icon('heroicon-o-globe-alt')
                        ->schema([
                            TextInput::make('site_name')
                                ->label('Site Name'),

                            Textarea::make('site_description')
                                ->label('Description')
                                ->maxLength(300),

                            FileUpload::make('logo')
                                ->label('Main Logo')
                                ->image()
                                ->directory('settings')
                                ->disk('public'),

                            FileUpload::make('favicon')
                                ->label('Favicon')
                                ->image()
                                ->directory('settings')
                                ->disk('public')
                                ->acceptedFileTypes(['image/x-icon', 'image/png', 'image/svg+xml']),
                        ]),
                    Tabs\Tab::make('Social Links')
                        ->icon('heroicon-o-link')
                        ->columnSpan(2)
                        ->schema([
                            TextInput::make('github')
                                ->label('Github')
                                ->inputMode('url')
                                ->placeholder('https://...'),
                            TextInput::make('linkedin')
                                ->label('Linkedin')
                                ->inputMode('url')
                                ->placeholder('https://...'),
                            TextInput::make('twitter')
                                ->label('Twitter(x.com)')
                                ->inputMode('url')
                                ->placeholder('https://...'),
                            TextInput::make('instagram')
                                ->label('Instagram')
                                ->inputMode('url')
                                ->placeholder('https://...'),
                            TextInput::make('telegram')
                                ->label('Telegram')
                                ->inputMode('url')
                                ->placeholder('https://...'),
                        ]),
                    Tabs\Tab::make('SEO')
                        ->icon('heroicon-o-magnifying-glass')
                        ->schema([
                            TextInput::make('meta_title')
                                ->label('Meta Title')
                                ->maxLength(60),

                            Textarea::make('meta_description')
                                ->label('Meta Description')
                                ->maxLength(160),

                            TagsInput::make('meta_keywords')
                                ->label('Meta Keywords')
                                ->separator(','),

                            FileUpload::make('og_image')
                                ->label('OG Image')
                                ->image()
                                ->directory('settings')
                                ->disk('public'),

                            Toggle::make('is_indexed')
                                ->label('Indexed on Google')
                                ->default(true),
                        ]),
                ])
                ->columnSpanFull(),
        ];
    }

    protected function getFormStatePath(): ?string
    {
        return 'data';
    }

    public function save(): void
    {
        $data = $this->form->getState();

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->name  = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        if (array_key_exists('avatar', $data)) {
            $user->avatar = $data['avatar'];
        }

        $user->save();

        // Save or update site settings
        $setting = Setting::firstOrNew();
        $setting->fill([
            'site_name'        => $data['site_name'] ?? null,
            'site_description' => $data['site_description'] ?? null,
            'logo'             => $data['logo'] ?? null,
            'favicon'          => $data['favicon'] ?? null,
            'github'           => $data['github'] ?? null,
            'linkedin'         => $data['linkedin'] ?? null,
            'twitter'          => $data['twitter'] ?? null,
            'instagram'        => $data['instagram'] ?? null,
            'telegram'         => $data['telegram'] ?? null,
            'meta_title'       => $data['meta_title'] ?? null,
            'meta_description' => $data['meta_description'] ?? null,
            'meta_keywords'    => $data['meta_keywords'] ?? null,
            'og_image'         => $data['og_image'] ?? null,
            'is_indexed'       => $data['is_indexed'] ?? true,
        ]);
        $setting->save();

        Notification::make()
            ->title('All settings have been saved successfully')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Settings')
                ->submit('save'),
        ];
    }
}
