<?php

namespace App\Filament\Resources\Coupons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CouponsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Coupon Code
                TextColumn::make('code')
                    ->searchable()
                    ->sortable(),

                // Mode (Manual / Auto)
                TextColumn::make('code_type')
                    ->label('Mode')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'manual' => 'info',
                        'auto' => 'success',
                    }),

                // Type (Fixed / Percentage)
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'fixed' => 'success',
                        'percentage' => 'info',
                    }),

                // Discount Value
                TextColumn::make('value')
                    ->label('Discount')
                    ->formatStateUsing(fn ($record) => 
                        $record->type === 'fixed' 
                            ? '₹ ' . $record->value 
                            : $record->value . '%'
                    ),

                // Minimum Cart Value
                TextColumn::make('min_cart_value')
                    ->label('Min Cart')
                    ->formatStateUsing(fn ($state) => 
                        $state ? '₹ ' . $state : '-'
                    ),

                // Categories (Multi)
                TextColumn::make('categories.name')
                    ->label('Categories')
                    ->badge()
                    ->separator(', ')
                    ->toggleable(isToggledHiddenByDefault: true),

                // Brands (Multi)
                TextColumn::make('brands.name')
                    ->label('Brands')
                    ->badge()
                    ->separator(', ')
                    ->toggleable(isToggledHiddenByDefault: true),

                // Usage Limit
                TextColumn::make('usage_limit')
                    ->label('Limit'),

                // Used Count
                TextColumn::make('used_count')
                    ->label('Used'),

                // Expiry Date
                TextColumn::make('expires_at')
                    ->date()
                    ->sortable(),

                // Status
                IconColumn::make('status')
                    ->boolean(),

                // Created At
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // Updated At
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}