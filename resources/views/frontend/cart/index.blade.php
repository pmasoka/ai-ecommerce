@extends('frontend.layouts.app')

@section('title', 'Shopping Cart')
@section('content')

    <div id="mainBody">
        <div class="container">
            <div class="row">
                <div class="span9 offset1">
                    <ul class="breadcrumb">
                        <li>
                            <a href="{{ url('/') }}">Home</a>
                            <span class="divider">/</span>
                        </li>
                        <li class="active">
                            Shopping Cart
                        </li>
                    </ul>

                    <h3>
                        SHOPPING CART
                        <small>
                            [
                            <span id="cartPageCount">
                                {{ $cartCount }}
                            </span>
                            Item(s)
                            ]
                        </small>
                    </h3>

                    @if ($cartItems->count())
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Sub Total</th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    @php
                                        if (Auth::check()) {
                                            $product = $item->product;
                                            $price = $product->sale_price ?? $product->price;
                                            $quantity = $item->quantity;
                                        } else {
                                            $product = \App\Models\Product::find($item['product_id']);

                                            $price = $product->sale_price ?? $product->price;

                                            $quantity = $item['quantity'];
                                        }

                                        $subtotal = $price * $quantity;
                                    @endphp

                                    <tr>
                                        <td width="80">
                                            <img width="60" src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}">
                                        </td>
                                        <td>
                                            <strong>
                                                {{ $product->name }}
                                            </strong>
                                        </td>
                                        <td>

                                            <input type="number" min="1" value="{{ $quantity }}" class="cartQty"
                                                data-id="{{ auth()->check() ? $item->id : '' }}"
                                                data-key="{{ auth()->check() ? '' : $cartKey }}">
                                        </td>
                                        <td>
                                            $ {{ number_format($price, 2) }}
                                        </td>

                                        <td class="subTotal" id="subTotal{{ auth()->check() ? $item->id : $cartKey }}">
                                            $. {{ number_format($subtotal, 2) }}
                                        </td>
                                        <td>
                                            <button class="btn btn-danger removeCartItem"
                                                data-id="{{ auth()->check() ? $item->id : '' }}"
                                                data-key="{{ auth()->check() ? '' : $cartKey }}">
                                                Remove
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="4" style="text-align:right;">
                                        <strong>
                                            Grand Total
                                        </strong>
                                    </td>
                                    <td>
                                        <strong>
                                            <span id="grandTotal">
                                                {{ number_format($cartTotal, 2) }}
                                            </span>
                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            Your cart is empty.
                        </div>
                    @endif

                    <a href="{{ url('/') }}" class="btn btn-large pull-left">
                        <i class="icon-arrow-left"></i>
                        Continue Shopping
                    </a>

                    <a href="#" class="btn btn-large btn-success pull-right">
                        Checkout
                        <i class="icon-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
