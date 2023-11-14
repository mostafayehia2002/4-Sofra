<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')
</head>
<body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl   footer-offset">
<script src={{asset('assets/js/hs.theme-appearance.js')}}></script>
<script src={{asset('assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js')}}></script>
@include('layouts.sidebar')
@include('layouts.navbar')
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main" class="main">
@yield('content')
</main>
<!-- ========== END MAIN CONTENT ========== -->
{{--javaScript links--}}
@include('layouts.script')
{{--End JaveScript Links--}}
</body>
</html>

