<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength('255')
                    ->autofocus()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(callable $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength('255')
                    ->unique(ignoreRecord: true)
                    ->dehydrated()
                    ->regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/')
                    ->validationMessages([
                        'regex' => 'El formato del slug debe ser minúsculas, números y guiones (ej: mi-categoria-1).',
                    ]),

                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(4)
                    ->maxLength('65535')
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('¿Está activo?')
                    ->default(true)
                    ->belowContent('Si esta habilitado, la categoría podrá ser visible'),
            ]);
    }
}
