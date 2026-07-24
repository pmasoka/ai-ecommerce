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
                'message' => 'Product added to cart successfully.',
                'cart_count' => $this->cartService
                    ->getCartCount(),
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    /*
|------------------------------------------------------------
| Cart Page
|------------------------------------------------------------
*/

    public function index()
    {
        $cartItems = $this->cartService
            ->getCartItems();

        $cartTotal = $this->cartService
            ->getCartTotal();

        $cartCount = $this->cartService
            ->getCartCount();

        return view(
            'frontend.cart.index',
            compact(
                'cartItems',
                'cartTotal',
                'cartCount'
            )
        );
    }
}
