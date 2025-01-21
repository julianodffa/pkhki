@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        @if (Auth::user()->role == 'admin')
            <h1>Welcome {{ Auth::user()->name }}</h1>
        @elseif(Auth::user()->role == 'superadmin')
            <h1>Welcome {{ Auth::user()->name }}, you're login as {{ Auth::user()->role }}</h1>
        @endif
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>
@endsection
