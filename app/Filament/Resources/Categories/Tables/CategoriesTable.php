<?php

namespace App\Filament\Resources\Categories\Tables;

use App\Models\Category;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Nombre')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('slug')
                    ->label('Slug'),

                TextColumn::make('is_active')
                    ->label('Estado')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Activo' : 'Inactivo')
                    ->color(fn (bool $state): string => $state ? 'success' : 'danger'),

            ])
            ->filters([
                SelectFilter::make('is_active')
                    ->label('Activos')
                    ->options([
                        1 => 'Activo',
                        0 => 'Inactivo',
                    ])
            ])
            ->recordActions([
                // Action::make('enable')
                //     ->label('Habilitar')
                //     ->action(fn (Category $category) => $category->update(['is_active' => true]))
                //     ->hidden(fn (Category $category): bool => $category->is_active),

                // Action::make('disabled')
                //     ->label('Deshabilitar')
                //     ->action(fn (Category $category) => $category->update(['is_active' => false]))
                //     ->visible(fn (Category $category): bool => $category->is_active),

                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
