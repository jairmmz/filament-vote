<?php

namespace App\Filament\Resources\Polls\Schemas;

use App\Models\Poll;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PollInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('category.name')
                    ->label('Categoría'),

                TextEntry::make('title')
                    ->label('Título'),

                TextEntry::make('slug'),

                TextEntry::make('description')
                    ->label('Descripción')
                    ->formatStateUsing(fn(?string $state): string => $state ? nl2br(e($state)) : '-')
                    ->html()
                    ->columnSpanFull(),

                ImageEntry::make('image')
                    ->disk('polls')
                    ->label('Imágen')
                    ->placeholder('-'),

                TextEntry::make('location')
                    ->label('Ubicación')
                    ->placeholder('-'),

                TextEntry::make('status')
                    ->label('Estado')
                    ->badge(),

                IconEntry::make('allow_know_vote')
                    ->label('Permitir voto no sabe / no opina')
                    ->boolean(),

                IconEntry::make('allow_none_vote')
                    ->label('Permitir voto ninguno / no votaría')
                    ->boolean(),

                TextEntry::make('starts_at')
                    ->label('Fecha de inicio')
                    ->dateTime()
                    ->placeholder('-'),

                TextEntry::make('ends_at')
                    ->label('Fecha de finalización')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-'),

                TextEntry::make('created_at')
                    ->label('Creado el')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->label('Actualizado el')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-'),

                TextEntry::make('deleted_at')
                    ->label('Eliminado el')
                    ->dateTime('d/m/Y H:i')
                    ->visible(fn(Poll $record): bool => $record->trashed()),
            ]);
    }
}
