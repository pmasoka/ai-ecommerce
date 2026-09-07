<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\ProductService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $ProductService;
    public function __construct(
        ProductService $productService
    ) {
        $this->ProductService =
            $productService;
    }
    /*
|--------------------------------------------------------
| Product Search
|--------------------------------------------------------
*/
    public function index(Request $request)
    {
        $keyword = trim($request->q);
        $products = collect();
        if (!empty($keyword)) {
            $products =
                $this->ProductService
                ->searchProducts($keyword);
        }
        return view(
            'frontend.search.index',
            compact(
                'keyword',
                'products'
            )
        );
    }
}
