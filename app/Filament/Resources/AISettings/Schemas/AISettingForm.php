<?php

namespace App\Filament\Resources\AISettings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AISettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('openai_model')
                    ->label('OpenAI Model')
                    ->options([
                        'gpt-4.1-mini' => 'GPT 4.1 Mini',
                        'gpt-4.1' => 'GPT 4.1',
                    ])
                    ->searchable()
                    ->required(),

                TextInput::make('temperature')
                    ->numeric()
                    ->default(0.7)
                    ->required(),

                TextInput::make('max_tokens')
                    ->numeric()
                    ->default(600)
                    ->required(),
            ]);
    }
}