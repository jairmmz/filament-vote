<?php

namespace App\Filament\Resources\Polls\Schemas;

use App\Models\Category;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PollForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([
                Hidden::make('user_id')
                    ->default(auth()->id())
                    ->dehydrated()
                    ->disabled(),

                Section::make('Contenido')
                    ->columns(12)
                    ->columnSpan(8)
                    ->schema([
                        Select::make('category_id')
                            ->label('Categoría')
                            ->options(Category::query()->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->columnSpan(6),

                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->string()
                            ->minLength(2)
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(callable $set, ?string $state) => $set('slug', Str::slug($state ?? '')))
                            ->columnSpan(6),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->minLength(2)
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->dehydrated()
                            ->regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/')
                            ->validationMessages([
                                'regex' => 'El formato del slug debe ser minúsculas, números y guiones (ej: mi-categoria-1).',
                            ])
                            ->disabled(fn($record) => $record !== null)
                            ->columnSpan(6),

                        TextInput::make('location')
                            ->label('Ubicación')
                            ->maxLength(255)
                            ->nullable()
                            ->columnSpan(6),

                        Textarea::make('description')
                            ->label('Descripción')
                            ->rows(7)
                            ->columnSpanFull()
                            ->belowContent('Proporcione una descripción detallada de la encuesta.'),
                    ]),

                Section::make('Imagen')
                    ->columnSpan(4)
                    ->schema([
                        FileUpload::make('image')
                            ->label('Imagen principal')
                            ->disk('polls')
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
                            ->belowContent('Seleccione una imagen representativa para la encuesta. Tamaño sugerido 800x600 píxeles.'),
                    ]),

                Section::make('Configuración')
                    ->columns(12)
                    ->columnSpan(6)
                    ->schema([
                        Select::make('status')
                            ->label('Estado')
                            ->options([
                                'borrador' => 'Borrador',
                                'activo' => 'Activo',
                                'cerrado' => 'Cerrado',
                                'archivado' => 'Archivado',
                            ])
                            ->default('borrador')
                            ->required()
                            ->columnSpan(6)
                            ->belowContent('Seleccione el estado actual de la encuesta.'),
                    ]),

                Section::make('Programación')
                    ->columnSpan(6)
                    ->schema([
                        DateTimePicker::make('starts_at')
                            ->label('Fecha de inicio')
                            ->required()
                            ->seconds(false)
                            ->columnSpanFull(),

                        DateTimePicker::make('ends_at')
                            ->label('Fecha de finalización')
                            ->required()
                            ->seconds(false)
                            ->columnSpanFull(),
                    ])->belowContent('Establezca las fechas de inicio y finalización de la encuesta.'),
            ]);
    }
}
