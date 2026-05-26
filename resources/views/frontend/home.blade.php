@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')

    <style>
        #sideMenu ul li {
            background: none !important;
            border: none;
        }

        #sideMenu ul li a {
            background: none !important;
            color: #333;
        }

        #sideMenu ul li a:hover {
            background: #f5f5f5;
        }
    </style>

    {{-- ==================== Carousel ==================== --}}
    <div id="carouselBlk">
        <div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">

                @foreach ($sliderBanners as $key => $banner)
                    <div class="item {{ $key == 0 ? 'active' : '' }}">
                        <div class="container">
                            <a href="{{ $banner->link ?? '#' }}">
                                <img style="width:100%" src="{{ asset('storage/' . $banner->image) }}" alt="">
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>

            <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($gridBanners as $banner)
                <div class="span4">
                    <div class="thumbnail">
                        <a href="{{ $banner->link ?? '#' }}">
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ==================== Main Body ==================== --}}
    <div id="mainBody">
        <div class="container">
            <div class="row">
                {{-- Sidebar --}}
                <div id="sidebar" class="span3">
                    <div class="well well-small">
                        <a href="#">
                            <img src="{{ asset('themes/images/ico-cart.png') }}" alt="cart">
                            3 Items in your cart
                        </a>
                    </div>

                    <ul id="sideMenu" class="nav nav-tabs nav-stacked">
                        @foreach ($categories as $category)
                            <li class="subMenu">
                                {{-- Parent --}}
                                <a href="{{ url('category/' . $category->slug) }}" class="category-toggle">
                                    <span class="toggle-icon">+</span>
                                    {{ $category->name }}
                                </a>

                                @if ($category->children->count())
                                    <ul style="display:none;">
                                        @foreach ($category->children as $child)
                                            <li>
                                                <a href="{{ url('category/' . $child->slug) }}">
                                                    <i class="icon-chevron-right"></i>
                                                    {{ $child->name }}
                                                </a>
                                            </li>

                                            {{-- Sub child --}}
                                            @foreach ($child->children as $sub)
                                                <li style="padding-left:15px;">
                                                    <a href="{{ url('category/' . $sub->slug) }}">
                                                        <i class="icon-chevron-right"></i>
                                                        {{ $sub->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    <br>
                    <div class="thumbnail">
                        <img src="{{ asset('themes/images/payment_methods.png') }}" alt="">
                        <div class="caption">
                            <h5>Payment Methods</h5>
                        </div>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="span9">
                    {{-- Products --}}
                    <div class="span9">
                        {{-- Featured --}}
                        <div class="well well-small">
                            <h4>
                                Featured Products
                                <small class="pull-right">
                                    {{ $featuredProducts->count() }} featured products
                                </small>
                            </h4>

                            <div class="row-fluid">
                                <ul class="thumbnails">
                                    @foreach ($featuredProducts as $product)
                                        <li class="span3">
                                            <div class="thumbnail">
                                                <a href="#">
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="">
                                                </a>

                                                <div class="caption">
                                                    <h5>{{ $product->name }}</h5>
                                                </div>

                                                <h4>
                                                    <a class="btn" href="#">
                                                        VIEW
                                                    </a>
                                                    <span class="pull-right">
                                                        $ {{ $product->sale_price ?? $product->price }}
                                                    </span>
                                                </h4>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        {{-- Latest --}}
                        <div class="well well-small">
                            <h4>Latest Products</h4>
                            <ul class="thumbnails">
                                @foreach ($latestProducts as $product)
                                    <li class="span3">
                                        <div class="thumbnail">
                                            <a href="#">
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="">
                                            </a>

                                            <div class="caption">
                                                <h5>{{ $product->name }}</h5>
                                                <p>
                                                    {{ Str::limit($product->short_description, 50) }}
                                                </p>
                                            </div>

                                            <h4 style="text-align:center">
                                                <a class="btn" href="#">
                                                    <i class="icon-zoom-in"></i>
                                                </a>

                                                <a class="btn" href="#">
                                                    Add to
                                                    <i class="icon-shopping-cart"></i>
                                                </a>

                                                <a class="btn btn-primary" href="#">
                                                    $ {{ $product->sale_price ?? $product->price }}
                                                </a>
                                            </h4>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
