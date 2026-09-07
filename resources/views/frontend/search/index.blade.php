@extends('frontend.layouts.app')
@section('title', 'Search Results')
@section('content')

    <div id="mainBody">
        <div class="container">
            <h3>Search Results</h3>
            @if ($keyword)
                <p>
                    Search Keyword :
                    <strong>{{ $keyword }}</strong>
                </p>
            @endif
            <p>
                {{ $products->count() }}
                {{ Str::plural('Product', $products->count()) }}
                Found
            </p>
            <hr>
            <ul class="thumbnails">
                @forelse($products as $product)
                    <li class="span3">
                        <div class="thumbnail">
                            <a href="{{ url('product/' . $product->slug) }}">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                @else
                                    <img src="https://placehold.co/250x250?text=No+Image" alt="No Image">
                                @endif
                            </a>
                            <div class="caption">
                                <h5>
                                    {{ $product->name }}
                                </h5>
                                <p>
                                    {{ Str::limit($product->short_description, 60) }}
                                </p>
                                <h4 style="text-align:center">
                                    <a class="btn" href="{{ url('product/' . $product->slug) }}">
                                        View Details
                                    </a>
                                    <a class="btn btn-primary" href="{{ url('product/' . $product->slug) }}">
                                        Rs.{{ $product->sale_price ?? $product->price }}
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </li>
                @empty
                    <li>
                        <div class="alert alert-info">
                            No products found.
                        </div>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
