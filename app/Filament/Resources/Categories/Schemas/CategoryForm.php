<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use App\Models\Category;
use Filament\Actions\Action;
use App\Services\Frontend\AIService;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('name')
                ->label('Category Name')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(
                    fn($state, callable $set) =>
                    $set('slug', Str::slug($state))
                ),

            TextInput::make('slug')
                ->required(),

            Select::make('parent_id')
                ->label('Parent Category')
                ->options(self::getCategoryOptions())
                ->searchable()
                ->nullable(),

            Textarea::make('description')
                ->rows(3)
                ->hintActions([
                    Action::make(
                        'generateDescription'
                    )
                        ->label(
                            'Generate Using AI'
                        )
                        ->icon(
                            'heroicon-o-sparkles'
                        )
                        ->action(
                            function (
                                $get,
                                $set
                            ) {
                                $categoryName =
                                    $get('name');
                                if (
                                    empty($categoryName)
                                ) {
                                    return;
                                }
                                $parentCategory = '';
                                if (
                                    $get(
                                        'parent_id'
                                    )
                                ) {
                                    $parentCategory =
                                        Category::find(
                                            $get(
                                                'parent_id'
                                            )
                                        )?->name;
                                }
                                $content =
                                    app(
                                        AIService::class
                                    )
                                    ->generateCategoryContent(
                                        $categoryName,
                                        $parentCategory
                                    );
                                if (
                                    ! isset(
                                        $content['error']
                                    )
                                ) {
                                    $set(
                                        'description',
                                        $content['description'] ?? ''
                                    );
                                    $set(
                                        'meta_title',
                                        $content['meta_title'] ?? ''
                                    );
                                    $set(
                                        'meta_description',
                                        $content['meta_description'] ?? ''
                                    );
                                    $set(
                                        'meta_keywords',
                                        $content['meta_keywords'] ?? ''
                                    );
                                }
                            }
                        ),
                ]),

            FileUpload::make('image')
                ->image()
                ->directory('categories'),

            TextInput::make('position')
                ->numeric()
                ->default(0),

            Toggle::make('status')
                ->default(true),

            TextInput::make('meta_title'),

            Textarea::make('meta_description')
                ->rows(2),

            TextInput::make('meta_keywords'),

        ]);
    }

    // ✅ Hierarchical Category Dropdown
    public static function getCategoryOptions($parentId = null, $prefix = "")
    {
        $categories = Category::where('parent_id', $parentId)
            ->orderBy('position')
            ->get();

        $options = [];

        foreach ($categories as $category) {
            $options[$category->id] = $prefix . $category->name;

            $options += self::getCategoryOptions($category->id, $prefix . '— ');
        }

        return $options;
    }
}
