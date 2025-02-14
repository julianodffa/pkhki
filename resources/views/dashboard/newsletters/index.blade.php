@extends('dashboard.layouts.main')
@section('container')
    <div class="row">
        <div class="col-12 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-poppins-bold text-warning">{{ $countSubscribers }}</h1>
                    <h5 class="card-title font-poppins-bold">Subscribers</h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-poppins-bold text-warning">{{ $countVerifiedSubscribers }}</h1>
                    <h5 class="card-title font-poppins-bold">Verified Subscribers</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h3 class="font-poppins-bold">Newsletter</h3>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive mt-4">
                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col">Verified</th>
                            <th scope="col">Verified At</th>
                            <th scope="col">Subscribe On</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($countSubscribers == 0)
                            <tr>
                                <td colspan="10" class="text-center">no subscribers yet</td>
                            </tr>
                        @else
                            @foreach ($subscribers as $subscriber)
                                <tr @if ($subscriber->is_verified == false) class="table-secondary" @endif>
                                    <td @if ($subscriber->is_verified == true) class="fw-bold" @endif>{{ $subscriber->email }}</td>
                                    <td @if ($subscriber->is_verified == true) class="fw-bold" @endif>{{ $subscriber->is_verified ? 'Yes' : 'no' }}</td>
                                    <td>{{ $subscriber->verified_at }}</td>
                                    <td>{{ $subscriber->created_at->diffForHumans() }}</td>
                                    <td class="align-middle">
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="deleteConfirmation(event, {{ $subscriber->id }}, 'subscriber', '{{ $subscriber->email }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <form id="delete-subscriber-{{ $subscriber->id }}" method="POST"
                                            action="/dashboard/newsletter/{{ $subscriber->id }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $subscribers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
