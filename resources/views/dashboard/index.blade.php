@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="font-poppins-bold">Dashboard</h3>
    </div>
    @if (session('success'))
        @if (Auth::user()->role == 'admin')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Welcome, <strong>{{ Auth::user()->name }}</strong>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(Auth::user()->role == 'superadmin')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Welcome <strong>{{ Auth::user()->name }}</strong>, you're login as
                <strong>{{ Auth::user()->role }}</strong>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @endif
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
@endsection
