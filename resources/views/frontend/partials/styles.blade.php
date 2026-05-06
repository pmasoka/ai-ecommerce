<!-- CSS -->
<link id="callCss" rel="stylesheet" href="{{ asset('themes/css/front.min.css') }}" media="screen"/>
<link href="{{ asset('themes/css/base.css') }}" rel="stylesheet" media="screen"/>

<!-- Responsive -->
<link href="{{ asset('themes/css/front-responsive.min.css') }}" rel="stylesheet"/>

<!-- Font Awesome -->
<link href="{{ asset('themes/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>

<!-- Google-code-prettify -->
<link href="{{ asset('themes/js/google-code-prettify/prettify.css') }}" rel="stylesheet"/>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('themes/images/ico/favicon.ico') }}">

<!-- Google-code-prettify -->
<link href="{{ asset('themes/js/google-code-prettify/prettify.css') }}" rel="stylesheet"/>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('themes/images/ico/favicon.ico') }}">

<!-- Apple Icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('themes/images/ico/apple-touch-icon-144-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('themes/images/ico/apple-touch-icon-114-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('themes/images/ico/apple-touch-icon-72-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" href="{{ asset('themes/images/ico/apple-touch-icon-57-precomposed.png') }}">

{{-- Extra Styles --}}
@stack('styles')