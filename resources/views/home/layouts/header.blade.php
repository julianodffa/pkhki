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

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/icons/sinnar-favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/icons/sinnar-favicon.png') }}" type="image/x-icon">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @if (!empty($css))
        <link rel="stylesheet" href='{{ asset("assets/css/home/$css.css") }}'>
    @endif


    <!-- Bootstrap Icon -->
    <link href="{{ asset('assets/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Javascript -->
    <script src="{{ asset('assets/js/scrollreveal.js') }}"></script>
</head>

<body>
