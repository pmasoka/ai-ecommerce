<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ProductVariant;
use App\Services\Frontend\CategoryService;
use App\Services\Frontend\ProductService;
use App\Models\Attribute;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;
    protected $productService;

    public function __construct(
        CategoryService $categoryService,
        ProductService $productService
    ) {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    public function listing(Request $request, $slug)
    {
        $category = $this->categoryService
            ->getCategoryBySlug($slug);

        /*
        | NEW: Filters
        */

        $filters = [
            'price' => $request->price,
            'categories' => $request->categories,
            'brands' => $request->brands,
            'sizes' => $request->sizes,
            'attribute_values' => $request->attribute_values,
        ];

        /*
        | NEW: Filter Categories
        */

        $filterCategories = $this->categoryService
            ->getFilterCategories($category);

        /*
         Get Category Products
        */

        $products = $this->productService
            ->getCategoryProducts($category, $filters);

        /*
        | Get Brands
        */

        $brands = Brand::where('status', 1)
            ->orderBy('name')
            ->get();

        /*
NEW: Sizes
*/

        $sizes = ProductVariant::where('status', 1)
            ->select('size')
            ->distinct()
            ->orderBy('size')
            ->get();

        /*
NEW: Dynamic Attributes

Show only attributes and values
assigned to products
*/

        $attributes = Attribute::where('status', 1)
            ->whereHas('values.products')
            ->with([
                'values' => function ($query) {
                    $query->whereHas('products')
                        ->orderBy('value');
                }
            ])
            ->orderBy('name')
            ->get();

        /*
        | AJAX Request
        */

        if ($request->ajax()) {
            return view(
                'frontend.category.partials.products',
                compact(
                    'products',
                    'category'
                )
            )->render();
        }

        return view('frontend.category.listing', compact(
            'category',
            'products',
            'brands',
            'sizes',
            'filterCategories',
            'attributes',
        ));
    }
}
