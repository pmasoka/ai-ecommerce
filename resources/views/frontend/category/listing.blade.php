@extends('frontend.layouts.app')

@section('title', $category->name)

@section('content')
    <div id="mainBody">
        <div class="container">
            <div class="row">
                {{-- Filters Sidebar --}}
                <div class="span3">
                    @include('frontend.category.partials.filters')
                </div>

                {{-- Products Section --}}
                <div class="span9" id="productsSection">
                    @include('frontend.category.partials.products')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            /* 
            | NEW: Price Filter Change
            */
            $(document).on('change', '.price-filter', function() {
                loadProducts();
            });

            /* 
            | NEW: Category Filter Change
            */
            $(document).on('change', '.category-filter', function() {
                loadProducts();
            });

            function loadProducts() {
                let prices = [];
                let categories = [];

                /* 
                | NEW: Selected Prices
                */
                $('.price-filter:checked').each(function() {
                    prices.push($(this).val());
                });

                /* 
                | NEW: Selected Categories
                */
                $('.category-filter:checked').each(function() {
                    categories.push($(this).val());
                });

                /* 
                | NEW: Build SEO Friendly URL
                */
                let params = new URLSearchParams();

                /* 
                | NEW: Multiple Price Filters
                */
                if (prices.length > 0) {
                    params.set('price', prices.join(','));
                }

                /* 
                | NEW: Multiple Category Filters
                */
                if (categories.length > 0) {
                    params.set('categories', categories.join(','));
                }

                let newUrl = window.location.pathname + '?' + params.toString();

                /* 
                | NEW: Update Browser URL
                */
                window.history.pushState({}, '', newUrl);

                /* 
                | AJAX Request
                */
                $.ajax({
                    url: newUrl,
                    type: "GET",
                    beforeSend: function() {
                        $('#productsSection').html(
                            '<div class="text-center">Loading Products...</div>'
                        );
                    },
                    success: function(response) {
                        $('#productsSection').html(response);
                    }
                });
            }

        });
    </script>
@endpush
