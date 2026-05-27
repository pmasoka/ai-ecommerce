<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\CategoryService;
use App\Services\Frontend\ProductService;
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
        ];

        /*
        | NEW: Filter Categories
        */

        $filterCategories = $this->categoryService
            ->getFilterCategories($category);

        /*
        | UPDATED: Get Category Products
        */

        $products = $this->productService
            ->getCategoryProducts($category, $filters);

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
            'filterCategories'
        ));
    }
}