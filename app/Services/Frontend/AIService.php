<?php

namespace App\Services\Frontend;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIService
{
    /*
    |--------------------------------------------------------------------------
    | Generate Product Description
    |--------------------------------------------------------------------------
    */

    public function generateProductContent(
        string $productName,
        string $categoryName = ""
    ): array {
        try {
            $response = Http::withToken(
                config('services.openai.key')
            )->post(
                'https://api.openai.com/v1/chat/completions',
                [
                    'model' => env(
                        'OPENAI_MODEL',
                        'gpt-4.1-mini'
                    ),
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' =>
                            'You are an expert e-commerce SEO content writer. Return only valid JSON without markdown.',
                        ],
                        [
                            'role' => 'user',
                            'content' =>
                            "Generate the following for product '{$productName}' in category '{$categoryName}'.

1. Product Description (Maximum 120 words)
2. Short Product Description (Maximum 40 words)
3. SEO Meta Title (Maximum 60 characters)
4. SEO Meta Description (Maximum 160 characters)
5. SEO Meta Keywords (Comma separated)

Return ONLY valid JSON in the following format:

{
\"description\": \"\",
\"short_description\": \"\",
\"meta_title\": \"\",
\"meta_description\": \"\",
\"meta_keywords\": \"\"
}"
                        ]
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 600,
                ]
            );

            /*
        |--------------------------------------------------------------------------
        | API Error Handling
        |--------------------------------------------------------------------------
        */
            if ($response->failed()) {
                Log::error(
                    'OpenAI API Error',
                    $response->json()
                );
                return [
                    'error' =>
                    'Unable to generate AI content.'
                ];
            }

            /*
        |--------------------------------------------------------------------------
        | Decode JSON Response
        |--------------------------------------------------------------------------
        */
            return json_decode(
                $response->json(
                    'choices.0.message.content'
                ),
                true
            );
        } catch (\Exception $e) {
            Log::error(
                'OpenAI Exception: ' .
                    $e->getMessage()
            );
            return [
                'error' =>
                $e->getMessage()
            ];
        }
    }
}
