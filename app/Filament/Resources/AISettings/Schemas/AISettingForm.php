<?php

namespace App\Filament\Resources\AISettings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AISettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                /*
                |--------------------------------------------------------------------------
                | OpenAI Configuration
                |--------------------------------------------------------------------------
                */
                Section::make('OpenAI Configuration')
                    ->schema([
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
                    ])
                    ->columns(3),

                /*
                |--------------------------------------------------------------------------
                | Content Generation Settings
                |--------------------------------------------------------------------------
                */
                Section::make('Content Generation Settings')
                    ->schema([
                        Select::make('writing_tone')
                            ->options([
                                'Professional' => 'Professional',
                                'Friendly' => 'Friendly',
                                'Luxury' => 'Luxury',
                                'Technical' => 'Technical',
                                'Persuasive' => 'Persuasive',
                                'Formal' => 'Formal',
                                'Casual' => 'Casual',
                            ])
                            ->default('Professional')
                            ->required(),
                        TextInput::make('description_length')
                            ->numeric()
                            ->default(120)
                            ->required(),
                        TextInput::make('short_description_length')
                            ->numeric()
                            ->default(40)
                            ->required(),
                        TextInput::make('keyword_count')
                            ->numeric()
                            ->default(10)
                            ->required(),
                    ])
                    ->columns(4),

                /*
                |--------------------------------------------------------------------------
                | Advanced Prompt
                |--------------------------------------------------------------------------
                */
                Section::make('Advanced Prompt')
                    ->description(
                        'This prompt defines the overall behaviour of the AI model.'
                    )
                    ->schema([
                        Textarea::make('system_prompt')
                            ->rows(8)
                            ->default(
                                'You are an expert e-commerce SEO content writer.
Generate unique, engaging and SEO-friendly product content.
Focus on customer benefits instead of technical specifications.
Return only valid JSON without markdown.'
                            )
                            ->required(),
                    ]),
            ]);
    }
}
