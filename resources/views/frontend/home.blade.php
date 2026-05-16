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
    <div id="myCarousel" class="carousel slide">
        <div class="carousel-inner">
            <div class="item active">
                <div class="container">
                    <a href="#">
                        <img style="width:100%" src="{{ asset('themes/images/carousel/1.png') }}" alt="" />
                    </a>
                    <div class="carousel-caption">
                        <h4>First Thumbnail label</h4>
                        <p>Banner text</p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="container">
                    <a href="#">
                        <img style="width:100%" src="{{ asset('themes/images/carousel/2.png') }}" alt="" />
                    </a>
                    <div class="carousel-caption">
                        <h4>Second Thumbnail label</h4>
                        <p>Banner text</p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="container">
                    <a href="#">
                        <img style="width:100%" src="{{ asset('themes/images/carousel/3.png') }}" alt="" />
                    </a>
                    <div class="carousel-caption">
                        <h4>Third Thumbnail label</h4>
                        <p>Banner text</p>
                    </div>
                </div>
            </div>
        </div>

        <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
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
                            <h4>Featured Products</h4>
                            <div class="row-fluid">
                                <ul class="thumbnails">
                                    @for ($i = 1; $i <= 4; $i++)
                                        <li class="span3">
                                            <div class="thumbnail">
                                                <a href="#">
                                                    <img src="{{ asset('themes/images/products/b/' . $i . '.jpg') }}"
                                                        alt="">
                                                </a>
                                                <div class="caption">
                                                    <h5>Product name</h5>
                                                    <h4>
                                                        <a class="btn" href="#">VIEW</a>
                                                        <span class="pull-right">Rs.1000</span>
                                                    </h4>
                                                </div>
                                            </div>
                                        </li>
                                    @endfor
                                </ul>
                            </div>
                        </div>

                        {{-- Latest --}}
                        <div class="well well-small">
                            <h4>Latest Products</h4>
                            <ul class="thumbnails">
                                @for ($i = 6; $i <= 9; $i++)
                                    <li class="span3">
                                        <div class="thumbnail">
                                            <a href="#">
                                                <img src="{{ asset('themes/images/products/' . $i . '.jpg') }}"
                                                    alt="">
                                            </a>
                                            <div class="caption">
                                                <h5>Product name</h5>
                                                <p>Lorem Ipsum is simply dummy text.</p>
                                                <h4 style="text-align:center">
                                                    <a class="btn btn-primary" href="#">Rs.1000</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
