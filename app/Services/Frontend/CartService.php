<?php

namespace App\Services\Frontend;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function add($data)
    {
        /*
     * Product
     */
        $product = Product::findOrFail(
            $data['product_id']
        );

        /*
     * Variant Validation
     */
        $variant = null;

        if (!empty($data['variant_id'])) {
            $variant = ProductVariant::findOrFail(
                $data['variant_id']
            );
        }

        if (
            $variant->stock < $data['quantity']
        ) {
            throw new \Exception(
                'Requested quantity is not available.'
            );
        }

        /*
     * Logged In User
     */
        if (Auth::check()) {
            $cartItem = CartItem::where(
                'user_id',
                Auth::id()
            )
                ->where(
                    'product_id',
                    $product->id
                )
                ->where(
                    'product_variant_id',
                    $data['variant_id'] ?? null
                )
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $data['quantity'];
                $cartItem->save();
            } else {
                CartItem::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'product_variant_id' => $data['variant_id'] ?? null,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => $variant
                        ? $variant->price
                        : (
                            $product->sale_price
                            ?? $product->price
                        ),
                    'quantity' => $data['quantity'],
                ]);
            }

            return true;
        }

        /*
     * Guest User
     */
        $cart = session()->get(
            'cart',
            []
        );

        $key = $product->id . '_' . ($data['variant_id'] ?? 0);

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $data['quantity'];
        } else {
            $cart[$key] = [
                'product_id' => $product->id,
                'product_variant_id' => $data['variant_id'] ?? null,
                'name' => $product->name,
                'image' => $product->image,
                'price' => $variant
                    ? $variant->price
                    : (
                        $product->sale_price
                        ?? $product->price
                    ),
                'quantity' => $data['quantity'],
            ];
        }

        session()->put(
            'cart',
            $cart
        );

        return true;
    }

    /*
|-------------------------
| Move Session Cart To Database
|-------------------------
*/

    public function moveSessionCartToDatabase()
    {
        /*
    |-------------------------
    | User Authentication
    |-------------------------
    */
        if (!Auth::check()) {
            return;
        }

        /*
    |-------------------------
    | Get Session Cart
    |-------------------------
    */
        $cart = session('cart', []);

        /*
    |-------------------------
    | Empty Cart
    |-------------------------
    */
        if (empty($cart)) {
            return;
        }

        /*
    |-------------------------
    | Save Cart Items
    |-------------------------
    */
        foreach ($cart as $item) {
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_variant_id', $item['product_variant_id'])
                ->first();

            /*
        |-------------------------
        | Existing Product
        |-------------------------
        */
            if ($cartItem) {
                $cartItem->increment(
                    'quantity',
                    $item['quantity']
                );
            }
            /*
        |-------------------------
        | New Product
        |-------------------------
        */ else {
                CartItem::create([
                    'user_id' => Auth::id(),
                    'product_id' => $item['product_id'],
                    'product_variant_id' => $item['product_variant_id'],
                    'quantity' => $item['quantity'],
                ]);
            }
        }

        /*
    |-------------------------
    | Clear Session Cart
    |-------------------------
    */
        session()->forget('cart');
    }

    /*
|------------------------------------------------------------
| Get Cart Items
|------------------------------------------------------------
*/

    public function getCartItems()
    {
        if (Auth::check()) {

            return CartItem::with([
                'product',
                'variant'
            ])
                ->where(
                    'user_id',
                    Auth::id()
                )
                ->get();
        }

        return collect(
            session(
                'cart',
                []
            )
        );
    }

    /*
|------------------------------------------------------------
| Cart Total
|------------------------------------------------------------
*/

    public function getCartTotal()
    {
        $total = 0;

        if (Auth::check()) {
            $items = CartItem::with(
                'product'
            )
                ->where(
                    'user_id',
                    Auth::id()
                )
                ->get();

            foreach ($items as $item) {
                $price = $item->product->sale_price
                    ?? $item->product->price;

                $total += $price * $item->quantity;
            }

            return $total;
        }

        foreach (
            session(
                'cart',
                []
            ) as $item
        ) {
            $product = Product::find(
                $item['product_id']
            );

            if (!$product) {
                continue;
            }

            $price = $product->sale_price
                ?? $product->price;

            $total += $price * $item['quantity'];
        }

        return $total;
    }

    public function getCartCount()
    {
        if (Auth::check()) {
            return CartItem::where(
                'user_id',
                Auth::id()
            )->sum('quantity');
        }

        $count = 0;

        foreach (
            session(
                'cart',
                []
            ) as $item
        ) {
            $count += $item['quantity'];
        }

        return $count;
    }
    /*
|------------------------------------------------------------
| Update Cart Item
|------------------------------------------------------------
*/

    public function updateCartItem(
        array $data
    ) {
        if (Auth::check()) {
            $cartItem = CartItem::findOrFail(
                $data['cart_item_id']
            );

            $cartItem->update([
                'quantity' =>
                $data['quantity']
            ]);

            return [
                'status' => true,
                'cart_count' =>
                $this->getCartCount(),
                'cart_total' =>
                number_format(
                    $this->getCartTotal(),
                    2
                ),
                'cart_item_id' =>
                $cartItem->id,
                'quantity' =>
                $cartItem->quantity,
            ];
        }

        // Guest Cart Logic
    }

    /*
|------------------------------------------------------------
| Delete Cart Item
|------------------------------------------------------------
*/

    public function deleteCartItem(
        array $data
    ) {
        /*
    |------------------------------------------------------------
    | Logged In User
    |------------------------------------------------------------
    */
        if (Auth::check()) {
            CartItem::findOrFail(
                $data['cart_item_id']
            )->delete();
        }

        /*
    |------------------------------------------------------------
    | Guest User
    |------------------------------------------------------------
    */ else {
            $cart =
                session(
                    'cart',
                    []
                );

            unset(
                $cart[$data['key']]
            );

            session()->put(
                'cart',
                $cart
            );
        }

        /*
    |------------------------------------------------------------
    | Return Updated Cart Data
    |------------------------------------------------------------
    */
        return [
            'status' => true,
            'cart_count' =>
            $this->getCartCount(),
            'cart_total' =>
            number_format(
                $this->getCartTotal(),
                2
            ),
            'is_empty' =>
            $this->getCartCount() == 0,
        ];
    }
}
