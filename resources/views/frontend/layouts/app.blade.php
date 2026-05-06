<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Stack Developers - Online Shopping')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', '')">

    {{-- Styles --}}
    @include('frontend.partials.styles')
</head>
<body>

    {{-- Header/Navbar --}}
    @include('frontend.partials.header')

    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('frontend.partials.footer')

    {{-- Scripts --}}
    @include('frontend.partials.scripts')

</body>
</html>