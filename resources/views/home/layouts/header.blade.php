<!doctype html>
<html lang="en">

<head>
    <!-- Meta and Title -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="color-scheme" content="light only">
    <meta name="description" content="Author: Murzal Pathway">
    <title>{{ $title }}</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/icons/favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/icons/favicon.png') }}" type="image/x-icon">

    {{-- CSS --}}
    {{-- Important --}}
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    {{-- Bootstrap Icon --}}
    <link href="{{ asset('assets/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
    {{-- Customize Home Page --}}
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    {{-- Optional --}}
    @if (!empty($css))
        @foreach ($css as $c)
            <link rel="stylesheet" href='{{ $c }}'>
        @endforeach
    @endif
</head>

<body>
