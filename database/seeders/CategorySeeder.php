<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $electronics = Category::create([
            'name'     => 'Electronics',
            'slug'     => Str::slug('Electronics'),
            'position' => 1,
            'level'    => 1,
        ]);

        $mobiles = $electronics->children()->create([
            'name'     => 'Mobile Phones',
            'slug'     => Str::slug('Mobile Phones'),
            'position' => 1,
            'level'    => 2,
        ]);

        $mobiles->children()->create([
            'name'     => 'Android Phones',
            'slug'     => Str::slug('Android Phones'),
            'position' => 1,
            'level'    => 3,
        ]);

        Category::create([
            'name'     => 'Fashion',
            'slug'     => Str::slug('Fashion'),
            'position' => 2,
            'level'    => 1,
        ]);

        Category::create([
            'name'     => 'Books',
            'slug'     => Str::slug('Books'),
            'position' => 3,
            'level'    => 1,
        ]);
    }
}