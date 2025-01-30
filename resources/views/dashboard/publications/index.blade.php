@extends('dashboard.layouts.main')
@section('container')
    <div class="row">
        <div class="col-12 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-poppins-bold text-warning">{{ $countPublications }}</h1>
                    <h5 class="card-title font-poppins-bold">Publications</h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="font-poppins-bold text-warning">{{ count($categories) }}</h1>
                    <h5 class="card-title font-poppins-bold">Categories</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- First Menu -->
        <div class="col-md-8">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h3 class="font-poppins-bold">Publications</h3>
            </div>
            <div class="row justify-content-start mt-4">
                <div class="col-md-6">
                    <a class="btn btn-blue mb-3 mb-md-0" href="/dashboard/publications/create">Create</a>
                </div>
                <div class="col-md-6">
                    <form action="/dashboard/publications">
                        <div class="input-group">
                            <input type="text" id="search" class="form-control" placeholder="Search..." name="s"
                                value="{{ request('s') }}" autocomplete="off">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </form>
                    <div class="position-relative">
                        <ul id="suggestion-list" class="suggestion-list list-group mt-2">
                        </ul>
                    </div>
                </div>
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
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Category</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($countPublications == 0)
                            <tr>
                                <td colspan="5" class="text-center">No Publications</td>
                            </tr>
                        @else
                            @foreach ($publications as $publication)
                                <tr>
                                    <td class="align-middle">{{ $publication->title }}</td>
                                    <td class="align-middle">{{ $publication->user->name }}</td>
                                    <td class="align-middle">
                                        @foreach ($publication->categories as $category)
                                            <span
                                                class="btn btn-sm d-block my-1 rounded-pill text-bg-secondary pe-none">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        <span class="d-inline-flex align-items-center">
                                            <a href="/dashboard/publications/{{ $publication->slug }}"
                                                class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="deleteConfirmation(event, {{ $publication->id }}, 'publications', '{{ $publication->title }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <form id="delete-publications-{{ $publication->id }}" method="POST"
                                            action="/dashboard/publications/{{ $publication->id }}" style="display: none;">
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
                    {{ $publications->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-4 mt-md-0">
            <div class="position-sticky" style="top: 4rem">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h4 class="font-poppins-bold">Categories</h4>
                </div>
                <a class="btn btn-blue mt-3" href="/dashboard/publications/categories/create">Create</a>
                @if (session('success-category'))
                    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                        <strong>{{ session('success-category') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('error-category'))
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                        <strong>{{ session('error-category') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="table-responsive mt-3">
                    <table class="table table-sm table-bordered text-center">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($categories) == 0)
                                <tr>
                                    <td colspan="5" class="text-center">No Categories</td>
                                </tr>
                            @else
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a href="/dashboard/publications/categories/{{ $category->id }}/edit"
                                                class="btn btn-sm btn-outline-warning me-1"><i
                                                    class="bi bi-pencil-square"></i></a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="deleteConfirmation(event, {{ $category->id }}, 'categories', '{{ $category->name }}')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <form id="delete-categories-{{ $category->id }}" method="POST"
                                                action="/dashboard/publications/categories/{{ $category->id }}"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
