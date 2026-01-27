<?php

namespace App\Filament\Resources\Votes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class VoteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([

                Section::make('Información del voto')
                    ->columns(12)
                    ->columnSpan(8)
                    ->schema([
                        TextEntry::make('code')
                            ->label('Código de voto')
                            ->weight(FontWeight::Bold)
                            ->copyable()
                            ->columnSpan(6),

                        TextEntry::make('vote_type')
                            ->label('Tipo de voto')
                            ->badge()
                            ->color(fn($state) => match ($state) {
                                'candidato' => 'success',
                                'blanco' => 'info',
                                'nulo' => 'danger',
                            })
                            ->formatStateUsing(fn($state) => match ($state) {
                                'candidato' => 'Válido',
                                'blanco' => 'Blanco',
                                'nulo' => 'Nulo',
                            })
                            ->columnSpan(6),

                        TextEntry::make('poll.title')
                            ->label('Encuesta')
                            ->columnSpanFull(),

                        TextEntry::make('candidate.name')
                            ->label('Candidato')
                            ->placeholder('—')
                            ->columnSpanFull()
                            ->visible(fn($record) => $record->vote_type === 'candidato'),
                    ]),

                Section::make('Información del votante')
                    ->columns(12)
                    ->columnSpan(4)
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Usuario')
                            ->weight(FontWeight::Medium)
                            ->columnSpanFull(),

                        TextEntry::make('user.email')
                            ->label('Correo')
                            ->columnSpanFull(),

                        TextEntry::make('created_at')
                            ->label('Fecha del voto')
                            ->dateTime('d/m/Y H:i')
                            ->columnSpanFull(),
                    ]),

                Section::make('Datos técnicos')
                    ->columns(12)
                    ->columnSpanFull()
                    ->collapsible()
                    ->schema([
                        TextEntry::make('ip_address')
                            ->label('Dirección IP')
                            ->placeholder('No registrada')
                            ->columnSpan(6),

                        TextEntry::make('user_agent')
                            ->label('Navegador / Dispositivo')
                            ->placeholder('No registrado')
                            ->columnSpan(6),
                    ]),
            ]);
    }
}
