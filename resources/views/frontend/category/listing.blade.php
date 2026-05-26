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