{{-- Breadcrumb --}}
<ul class="breadcrumb">
    <li>
        <a href="{{ url('/') }}">Home</a>
        <span class="divider"></span>
    </li>
    <li class="active">
        {{ $category->name }}
    </li>
</ul>

{{-- Category Title --}}
<h3>
    {{ $category->name }}
    <small class="pull-right">
        {{ $products->count() }} products available
    </small>
</h3>

<hr class="soft"/>

{{-- Products --}}
<ul class="thumbnails">
    @forelse($products as $product)
    <li class="span3">
        <div class="thumbnail">
            <a href="{{ url('product/' . $product->slug) }}">
                <img src="{{ asset('storage/'. $product->image) }}" alt="">
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

                <a class="btn" href="{{ url('product/' . $product->slug) }}">
                    Add to 
                    <i class="icon-shopping-cart"></i>
                </a>

                <a class="btn btn-primary" href="{{ url('product/' . $product->slug) }}">
                    $ {{ $product->sale_price ?? $product->price }}
                </a>
            </h4>
        </div>
    </li>
    @empty
    <li>
        No products found.
    </li>
    @endforelse
</ul>