@extends('frontend.layouts.app')

@section('title', $product->meta_title ?? $product->name)
@section('content')
    <div id="mainBody">
        <div class="container">
            {{-- Breadcrumb --}}
            <ul class="breadcrumb">
                <li>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li>
                    <a href="{{ url($product->category->slug) }}">{{ $product->category->name }}</a>
                </li>
                <li class="active">
                    {{ $product->name }}
                </li>
            </ul>

            <div class="row">
                {{-- Product Images --}}
                <div class="span5">
                    {{-- Main Image --}}
                    <div class="thumbnail">
                        <img id="mainProductImage" src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}">
                    </div>

                    {{-- Gallery Images --}}
                    @if ($product->images->count())
                        <ul class="thumbnails" style="margin-top:10px;">
                            {{-- Main Image Thumbnail --}}
                            <li class="span1">
                                <div class="thumbnail product-thumb active-thumb">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="changeImage"
                                        data-image="{{ asset('storage/' . $product->image) }}" alt="">
                                </div>
                            </li>

                            {{-- Alternate Images --}}
                            @foreach ($product->images as $image)
                                <li class="span1">
                                    <div class="thumbnail product-thumb">
                                        <img src="{{ asset('storage/' . $image->image) }}" class="changeImage"
                                            data-image="{{ asset('storage/' . $image->image) }}" alt="">
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                {{-- Product Details --}}
                <div class="span7">
                    <h3>{{ $product->name }}</h3>
                    <hr class="soft" />

                    {{-- Brand --}}
                    @if ($product->brand)
                        <h4>
                            Brand:
                            {{ $product->brand->name }}
                        </h4>
                    @endif

                    {{-- Product Colors --}}
                    @if ($colorVariations->count())
                        <hr class="soft" />
                        <h4>Colors</h4>

                        <ul class="thumbnails">

                            {{-- Current Product --}}
                            <li class="span1">
                                <div class="thumbnail active-thumb">
                                    <a href="{{ url('product/' . $product->slug) }}">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt=""
                                            style="height:60px; object-fit:contain;">
                                    </a>

                                    <small style="display:block; text-align:center;">
                                        {{ $product->color }}
                                    </small>
                                </div>
                            </li>

                            {{-- Other Color Products --}}
                            @foreach ($colorVariations as $variation)
                                <li class="span1">
                                    <div class="thumbnail">
                                        <a href="{{ url('product/' . $variation->slug) }}">
                                            <img src="{{ asset('storage/' . $variation->image) }}" alt=""
                                                style="height:60px; object-fit:contain;">
                                        </a>

                                        <small style="display:block; text-align:center;">
                                            {{ $variation->color }}
                                        </small>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    @endif

                    {{-- Color --}}
                    <h4>
                        Color:
                        {{ $product->color }}
                    </h4>

                    {{-- SKU --}}
                    <h5>
                        SKU:
                        {{ $product->sku }}
                    </h5>

                    {{-- Stock --}}
                    <h5>
                        Stock:
                        @if ($product->stock > 0)
                            <span style="color:green;">In Stock</span>
                        @else
                            <span style="color:red;">Out of Stock</span>
                        @endif
                    </h5>

                    {{-- Price --}}
                    <div style="margin:20px 0;">
                        @if ($product->sale_price)
                            <span style="text-decoration: line-through; color: gray; font-size: 24px; margin-right: 10px;">
                                $ {{ number_format($product->price, 2) }}
                            </span>
                            <span style="color: #e74c3c; font-size: 34px; font-weight: bold;">
                                $ {{ number_format($product->sale_price, 2) }}
                            </span>
                        @else
                            <span style="color: #2c3e50; font-size: 34px; font-weight: bold;">
                                $ {{ number_format($product->price, 2) }}
                            </span>
                        @endif
                    </div>

                    {{-- Short Description --}}
                    <p>
                        {{ $product->short_description }}
                    </p>

                    {{-- Variants --}}
                    @if ($product->variants->count())
                        <hr class="soft" />
                        <h4>Sizes</h4>
                        <select class="span3">
                            @foreach ($product->variants as $variant)
                                <option>
                                    {{ $variant->size }} - Rs.{{ number_format($variant->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                    @endif

                    {{-- Add To Cart --}}
                    <hr class="soft" />
                    <button class="btn btn-large btn-primary">
                        <i class="icon-shopping-cart"></i>
                        Add To Cart
                    </button>

                    {{-- Attributes --}}
                    @if ($product->attributeValues->count())
                        <hr class="soft" />
                        <h4>Specifications</h4>
                        <table class="table table-bordered">
                            @foreach ($product->attributeValues as $attribute)
                                <tr>
                                    <th width="30%">
                                        {{ $attribute->attribute->name }}
                                    </th>
                                    <td>
                                        {{ $attribute->value }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif

                    {{-- Description --}}
                    <hr class="soft" />
                    <h4>Product Description</h4>
                    <p>
                        {{ $product->description }}
                    </p>

                    {{-- Related Products --}}
                    @if ($relatedProducts->count())
                        <hr class="soft" />
                        <h4>Related Products</h4>
                        <ul class="thumbnails">
                            @foreach ($relatedProducts as $relatedProduct)
                                <li class="span3">
                                    <div class="thumbnail">
                                        <a href="{{ url('product/' . $relatedProduct->slug) }}">
                                            <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="">
                                        </a>
                                        <div class="caption">
                                            <h5>{{ $relatedProduct->name }}</h5>
                                            <h4 style="text-align:center">
                                                <a class="btn btn-primary"
                                                    href="{{ url('product/' . $relatedProduct->slug) }}">
                                                    View
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .product-thumb {
            cursor: pointer;
            border: 2px solid transparent;
        }

        .active-thumb {
            border: 2px solid #007bff;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            /*
            |--------------------------------------------------------------------------
            | Change Product Image
            |--------------------------------------------------------------------------
            */
            $('.changeImage').click(function() {
                let image = $(this).data('image');

                /* Update Main Image */
                $('#mainProductImage').attr('src', image);

                /* Active Thumbnail */
                $('.product-thumb').removeClass('active-thumb');
                $(this).closest('.product-thumb').addClass('active-thumb');
            });
        });
    </script>
@endpush
