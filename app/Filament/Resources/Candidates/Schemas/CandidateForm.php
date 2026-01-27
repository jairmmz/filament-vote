<?php

namespace App\Filament\Resources\Candidates\Schemas;

use App\Models\PoliticalParty;
use App\Models\Poll;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CandidateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([
                Section::make('Información del candidato')
                    ->columns(12)
                    ->columnSpan(8)
                    ->schema([
                        Select::make('poll_id')
                            ->label('Encuesta')
                            ->options(Poll::query()->pluck('title', 'id'))
                            ->searchable()
                            ->required()
                            ->columnSpan(6),

                        Select::make('political_party_id')
                            ->label('Partido Político')
                            ->options(PoliticalParty::query()->where('is_active', true)->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->columnSpan(6),

                        TextInput::make('name')
                            ->label('Nombres y Apellidos')
                            ->required()
                            ->columnSpan(8),

                        TextInput::make('number')
                            ->label('Número de candidato')
                            ->numeric()
                            ->columnSpan(4),

                        RichEditor::make('biography')
                            ->label('Biografía')
                            ->fileAttachmentsDisk('candidates_photos')
                            ->columnSpanFull()
                            ->belowContent('Descripción del candidato, trayectoria, experiencia, etc.'),
                    ]),

                Section::make('Foto')
                    ->columnSpan(4)
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Foto del candidato')
                            ->disk('candidates_photos')
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
                            ->columnSpanFull(),
                    ]),

                Section::make('Propuestas')
                    ->columnSpanFull()
                    ->schema([
                        Repeater::make('proposals')
                            ->label('Listado de propuestas')
                            ->schema([
                                Textarea::make('proposal')
                                    ->label('Propuesta')
                                    ->required()
                                    ->rows(2)
                                    ->columnSpanFull(),
                            ])
                            ->addActionLabel('Añadir propuesta')
                            ->columnSpanFull(),
                    ]),

                Section::make('Estado')
                    ->columns(12)
                    ->columnSpan(4)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('¿Está activo?')
                            ->default(true)
                            ->inline(false)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
