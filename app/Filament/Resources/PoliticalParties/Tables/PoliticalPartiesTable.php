<?php

namespace App\Filament\Resources\PoliticalParties\Tables;

use App\Filament\Exports\PoliticalPartyExporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PoliticalPartiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),

                TextColumn::make('acronym')
                    ->label('Acrónimo')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('logo')
                    ->disk('logos')
                    ->circular(),

                TextColumn::make('created_at')
                    ->label('Creado El')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Actualizado El')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('')
                    ->icon(Heroicon::Eye)
                    ->color('warning')
                    ->tooltip('Ver')
                    ->size(Size::Medium),
                EditAction::make()
                    ->label('')
                    ->icon(Heroicon::PencilSquare)
                    ->color('info')
                    ->tooltip('Editar')
                    ->size(Size::Medium),
                DeleteAction::make()
                    ->label('')
                    ->icon(Heroicon::Trash)
                    ->color('danger')
                    ->tooltip('Eliminar')
                    ->size(Size::Medium)
            ])
            ->headerActions([
                ExportAction::make()->exporter(PoliticalPartyExporter::class),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
