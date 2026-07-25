<!-- JS -->
<script src="{{ asset('themes/js/jquery.js') }}"></script>
<script src="{{ asset('themes/js/front.min.js') }}"></script>
<script src="{{ asset('themes/js/google-code-prettify/prettify.js') }}"></script>
<script src="{{ asset('themes/js/front.js') }}"></script>
<script src="{{ asset('themes/js/jquery.lightbox-0.5.js') }}"></script>

<!-- Frontend Custom JS -->
<script src="{{ asset('js/frontend/custom.js') }}"></script>
<script src="{{ asset('js/frontend/partials/cart.js') }}"></script>

{{-- Extra Scripts --}}
@stack('scripts')