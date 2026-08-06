<?php

namespace App\Filament\Resources\AISettings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AISettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('openai_model')
                    ->label('OpenAI Model'),
                TextColumn::make('temperature'),
                TextColumn::make('max_tokens')
                    ->label('Max Tokens'),
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y h:i A'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ])
            ->checkIfRecordIsSelectableUsing(
                fn () => false
            )
            ->paginated(false);
    }
}