<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="color-scheme" content="light only">
    <meta name="description" content="Author: Murzal Pathway">
    <title>{{ $title }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/icons/sinnar-favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/icons/sinnar-favicon.png') }}" type="image/x-icon">

    {{-- CSS --}}
    {{-- Important --}}
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    {{-- Bootstrap Icons --}}
    <link href="{{ asset('assets/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
    {{-- Customize Dashboard --}}
    <link href="{{ asset('assets/css/dashboard/dashboard.css') }}" rel="stylesheet">

    {{-- Optional --}}
    @if (!empty($css))
        @foreach ($css as $c)
            <link rel="stylesheet" href='{{ $c }}'>
        @endforeach
    @endif
</head>

<body>
    @include('dashboard.layouts.header')
    <div class="container-fluid">
        <div class="row">
            @include('dashboard.layouts.sidebar')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-4 font-opensans">
                <div class="container py-4">
                    @include('dashboard.layouts.breadcrumbs')
                    @yield('container')
                </div>
            </main>
        </div>
    </div>
    
    {{-- JS --}}
    {{-- Important --}}
    {{-- Jquery (S) --}}
    <script src="{{ asset('assets/js/jquery/jquery-3.7.1.min.js') }}"></script>
    {{-- Bootstrap (S) --}}
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    {{-- Optional --}}
    @if (!empty($javascript))
        @foreach ($javascript as $js)
            <script src="{{ $js }}"></script>
        @endforeach
    @endif
</body>

</html>
