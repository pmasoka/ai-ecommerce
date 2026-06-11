<div class="well well-small">
    <h5>Filters</h5>
    <hr>

    {{-- NEW: Categories Filter --}}
    @if ($filterCategories->count() > 0)

        <h6>Categories</h6>

        @foreach ($filterCategories as $filterCategory)
            <label class="checkbox">

                <input type="checkbox" class="filter-checkbox category-filter" value="{{ $filterCategory->id }}"
                    {{ request()->categories && in_array($filterCategory->id, explode(',', request()->categories)) ? 'checked' : '' }}>

                {{ $filterCategory->name }}

            </label>
        @endforeach

        <hr>

    @endif

    {{-- Brand Filters --}}
    @if ($brands->count() > 0)
        <h6>Brands</h6>

        @foreach ($brands as $brand)
            <label class="checkbox">
                <input type="checkbox" class="filter-checkbox brand-filter" value="{{ $brand->id }}"
                    {{ request()->brands && in_array($brand->id, explode(',', request()->brands)) ? 'checked' : '' }}>
                {{ $brand->name }}
            </label>
        @endforeach
    @endif

    <hr>

    <?php
    
    if (!empty($filters['brands'])) {
        $brands = explode(',', $filters['brands']);
        $query->whereIn('brand_id', $brands);
    }
    ?>

    {{-- NEW: Size Filters --}}
    @if ($sizes->count() > 0)
        <h6>Sizes</h6>

        @foreach ($sizes as $size)
            <label class="checkbox">
                <input type="checkbox" class="filter-checkbox size-filter" value="{{ $size->size }}"
                    {{ request()->sizes && in_array($size->size, explode(',', request()->sizes)) ? 'checked' : '' }}>
                {{ $size->size }}
            </label>
        @endforeach

        <hr>
    @endif

    {{-- NEW: Dynamic Attribute Filters --}}
    @if ($attributes->count() > 0)

        @foreach ($attributes as $attribute)
            @if ($attribute->values->count() > 0)
                <h6>{{ $attribute->name }}</h6>

                @foreach ($attribute->values as $value)
                    <label class="checkbox">

                        <input type="checkbox" class="filter-checkbox attribute-filter" value="{{ $value->id }}"
                            {{ request()->attribute_values && in_array($value->id, explode(',', request()->attribute_values))
                                ? 'checked'
                                : '' }}>

                        {{ $value->value }}

                    </label>
                @endforeach

                <hr>
            @endif
        @endforeach

    @endif

    {{-- NEW: Price Filter --}}
    <h6>Price</h6>

    <label class="checkbox">
        <input type="checkbox" class="filter-checkbox price-filter" value="0-50"
            {{ request()->price && in_array('0-50', explode(',', request()->price)) ? 'checked' : '' }}>
        $0 - $50
    </label>

    <label class="checkbox">
        <input type="checkbox" class="filter-checkbox price-filter" value="50-100"
            {{ request()->price && in_array('50-100', explode(',', request()->price)) ? 'checked' : '' }}>
        $50 - $100
    </label>

    <label class="checkbox">
        <input type="checkbox" class="filter-checkbox price-filter" value="100-250"
            {{ request()->price && in_array('100-250', explode(',', request()->price)) ? 'checked' : '' }}>
        $100 - $250
    </label>

    <label class="checkbox">
        <input type="checkbox" class="filter-checkbox price-filter" value="250-500"
            {{ request()->price && in_array('250-500', explode(',', request()->price)) ? 'checked' : '' }}>
        $250 - $500
    </label>

    <label class="checkbox">
        <input type="checkbox" class="filter-checkbox price-filter" value="500-1000"
            {{ request()->price && in_array('500-1000', explode(',', request()->price)) ? 'checked' : '' }}>
        $500 - $1000
    </label>

    <label class="checkbox">
        <input type="checkbox" class="filter-checkbox price-filter" value="1000-5000"
            {{ request()->price && in_array('1000-5000', explode(',', request()->price)) ? 'checked' : '' }}>
        $1000 - $5000
    </label>
</div>
