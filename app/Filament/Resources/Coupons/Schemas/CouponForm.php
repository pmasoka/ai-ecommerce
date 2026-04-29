<?php

namespace App\Filament\Resources\Coupons\Schemas;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CouponForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Coupon Mode
                Select::make('code_type')
                    ->label('Coupon Mode')
                    ->options([
                        'manual' => 'Manual',
                        'auto' => 'Automatic',
                    ])
                    ->default('manual')
                    ->live(),

                // Manual Code
                TextInput::make('code')
                    ->label('Coupon Code')
                    ->required(fn (Get $get) => $get('code_type') === 'manual')
                    ->unique(ignoreRecord: true)
                    ->visible(fn (Get $get) => $get('code_type') === 'manual'),

                // Auto Generated Code (same field reused)
                TextInput::make('code')
                    ->label('Generated Code')
                    ->disabled()
                    ->dehydrated()
                    ->visible(fn (Get $get) => $get('code_type') === 'auto')
                    ->default(function (Get $get) {
                        // Do not regenerate on edit
                        return $get('code') ?? strtoupper(Str::random(8));
                    }),

                // Categories (Multi Select)
                Select::make('categories')
                    ->label('Categories (Optional)')
                    ->multiple()
                    ->relationship('categories', 'name')
                    ->preload()
                    ->searchable(),

                // Brands (Multi Select)
                Select::make('brands')
                    ->label('Brands (Optional)')
                    ->multiple()
                    ->relationship('brands', 'name')
                    ->preload()
                    ->searchable(),

                // Coupon Type
                Select::make('coupon_type')
                    ->label('Coupon Type')
                    ->options([
                        'fixed' => 'Fixed Amount',
                        'percentage' => 'Percentage',
                    ])
                    ->required(),

                // Discount Value
                TextInput::make('value')
                    ->label('Discount Value')
                    ->numeric()
                    ->required(),

                // Minimum Cart Value
                TextInput::make('min_cart_value')
                    ->label('Minimum Cart Value')
                    ->numeric()
                    ->nullable(),

                // Usage Limit
                TextInput::make('usage_limit')
                    ->label('Usage Limit')
                    ->numeric()
                    ->nullable(),

                // Expiry Date
                DatePicker::make('expires_at')
                    ->label('Expiry Date')
                    ->nullable(),

                // Status
                Toggle::make('status')
                    ->label('Active')
                    ->default(true),
            ]);
    }
}