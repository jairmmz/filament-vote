<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use App\Support\SiteSettings as CacheSiteSettings;
use Filament\Forms\Components\FileUpload;

class SiteSettings extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;
    protected static string|\UnitEnum|null $navigationGroup = 'Sistema';
    protected static ?string $title = 'Configuración General';
    protected static ?int $navigationSort = 90;

    protected string $view = 'filament.pages.site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->data = SiteSetting::first()?->data ?? [];

        if (isset($this->data['image']) && is_string($this->data['image'])) {
            $this->data['image'] = [$this->data['image']];
        }
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del sitio')
                    ->columns(2)
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Nombre del sitio')
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Descripción del sitio')
                            ->maxLength(255)
                            ->nullable()
                            ->columnSpanFull(),

                        FileUpload::make('image')
                            ->label('Imagen principal')
                            ->disk('website_settings')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatioOptions([
                                null,
                                '1:1',
                                '4:3',
                                '16:9',
                            ])
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                            ->maxSize(2048)
                            ->columnSpanFull()
                            ->multiple(false)
                            ->nullable()
                            ->belowContent('Seleccione una imagen representativa para la página.'),

                        TextInput::make('email')
                            ->label('Correo electrónico')
                            ->required()
                            ->email(),

                        TextInput::make('phone')
                            ->label('Teléfono')
                            ->maxLength(20)
                            ->nullable(),

                        Textarea::make('address')
                            ->label('Dirección')
                            ->maxLength(255)
                            ->nullable()
                            ->columnSpanFull(),
                    ]),

                Section::make('Redes sociales')
                    ->columns(3)
                    ->schema([
                        TextInput::make('facebook')
                            ->url()
                            ->nullable(),
                        TextInput::make('twitter')
                            ->url()
                            ->nullable(),
                        TextInput::make('instagram')
                            ->url()
                            ->nullable(),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Guardar cambios')
                ->icon('heroicon-o-check')
                ->action('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        if (isset($data['image']) && is_array($data['image'])) {
            $data['image'] = $data['image'][0] ?? null;
        }

        SiteSetting::updateOrCreate(
            ['id' => 1],
            ['data' => $data]
        );

        CacheSiteSettings::clear();

        Notification::make()
            ->title('Configuración guardada exitosamente.')
            ->success()
            ->send();
    }
}
