<?php

namespace App\Filament\Resources\Votes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class VotesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('code')
                    ->label('Código')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Usuario')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('poll.title')
                    ->label('Encuesta')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('vote_type')
                    ->label('Tipo de Voto')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'válido' => 'success',
                        'blanco' => 'warning',
                        'nulo' => 'danger',
                        default => 'success',
                    }),

                TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('vote_type')
                    ->label('Tipo de Voto')
                    ->options([
                        'válido' => 'Válido',
                        'blanco' => 'Blanco',
                        'nulo' => 'Nulo',
                    ]),

                SelectFilter::make('user')
                    ->label('Usuario')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('poll')
                    ->label('Encuesta')
                    ->relationship('poll', 'title')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
