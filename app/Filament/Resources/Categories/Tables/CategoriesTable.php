<?php

namespace App\Filament\Resources\Categories\Tables;

use App\Models\Category;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CategoriesTable
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

                TextColumn::make('created_at')
                    ->label('Creado el')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([

            ])
            ->recordActions([
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
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
