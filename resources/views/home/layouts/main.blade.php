@include('home.layouts.header')
@include('home.layouts.navbar')

@yield('contain')

@if(!isset($hideFooter) || !$hideFooter)
    @include('home.layouts.footer')
@endif
