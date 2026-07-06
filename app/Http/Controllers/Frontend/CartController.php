<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Services\Frontend\CartService;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(
        CartService $cartService
    ) {
        $this->cartService = $cartService;
    }

    /*
    |--------------------------------------------------------------------------
    | Add To Cart
    |--------------------------------------------------------------------------
    */

    public function add(AddToCartRequest $request)
    {
        try {
            $this->cartService->add(
                $request->validated()
            );

            return response()->json([
                'status' => true,
                'message' => 'Product added to cart successfully.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
}