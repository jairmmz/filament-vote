<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('roles.name')
                    ->label('Roles')
                    ->badge()
                    ->separator(',')
                    ->placeholder('Sin asignar')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Correo Electrónico')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Activo' : 'Inactivo')
                    ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                    ->sortable(),

                TextColumn::make('email_verified_at')
                    ->label('Correo Verificado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('Sin verificar'),

                TextColumn::make('created_at')
                    ->label('Creado El')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Actualizado El')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
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
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
