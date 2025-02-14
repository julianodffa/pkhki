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
    <div class="row">
        <!-- First Menu -->
        <div class="col-12 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-poppins-bold text-warning">{{ $count['publications'] }}</h1>
                    <h5 class="card-title font-poppins-bold">Publications</h5>
                </div>
            </div>
        </div>

        <!-- Second Menu -->
        <div class="col-12 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-poppins-bold text-warning">{{ $count['structures'] }}</h1>
                    <h5 class="card-title font-poppins-bold">Structures</h5>
                </div>
            </div>
        </div>

        <!-- Third Menu -->
        <div class="col-12 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-poppins-bold text-warning">{{ $count['newRegistrants'] }}</h1>
                    <h5 class="card-title font-poppins-bold"><sup class="text-warning">New</sup> Registrants</h5>
                </div>
            </div>
        </div>

        <!-- Fourth Menu -->
        <div class="col-12 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-poppins-bold text-warning">{{ $count['members'] }}</h1>
                    <h5 class="card-title font-poppins-bold">Members</h5>
                </div>
            </div>
        </div>
        <!-- Fourth Menu -->
        <div class="col-12 col-lg-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title font-poppins-bold mb-4 pb-4 pt-2 text-center border-bottom">Top 10 Most Popular
                        Publications</h5>
                    <canvas id="trafficChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
