@include('home.layouts.header')
@include('home.layouts.navbar')

@yield('contain')


@if (!isset($showFooter) || $showFooter)
    @include('home.layouts.footer')
@endif
