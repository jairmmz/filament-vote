<?php

namespace App\Filament\Resources\Candidates\Tables;

use App\Filament\Exports\CandidateExporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CandidatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Nombres y Apellidos')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('photo')
                    ->label('Foto')
                    ->disk('candidates_photos')
                    ->circular(),

                TextColumn::make('politicalParty.name')
                    ->label('Partido Político')
                    ->sortable(),

                TextColumn::make('poll.title')
                    ->label('Encuesta')
                    ->sortable(),

                TextColumn::make('number')
                    ->label('Número')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Creado El')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Actualizado El')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->headerActions([
                ExportAction::make()->exporter(CandidateExporter::class),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
