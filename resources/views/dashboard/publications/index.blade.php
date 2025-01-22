@extends('dashboard.layouts.main')
@section('container')
    <div class="row mt-4">
        <div class="col-md-8">
            <h4>Publications</h4>
            <a href="/dashboard/publications/create">Create a Publication</a>
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
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Category</th>
                            <th scope="col" colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($publications) == 0)
                            <tr>
                                <td colspan="5" class="text-center">No Publications</td>
                            </tr>
                        @else
                            @foreach ($publications as $publication)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $publication->title }}</td>
                                    <td>{{ $publication->user->name }}</td>
                                    <td>
                                        @foreach ($publication->categories as $category)
                                            <span class="badge rounded-pill text-bg-secondary">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="/dashboard/publications/{{ $publication->id }}"
                                            class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                                    </td>
                                    <td>
                                        <a href="/dashboard/publications/{{ $publication->id }}/edit"
                                            class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil-square"></i></a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-danger"
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
            </div>
        </div>
        <div class="col-md-4 mt-4 mt-md-0">
            <div class="position-sticky" style="top: 4rem">
                <h4>Categories</h4>
                <a href="/dashboard/publications/categories/create">Create a Category</a>
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
                <div class="table-responsive mt-4">
                    <table class="table table-bordered text-center">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
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
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a href="/dashboard/publications/categories/{{ $category->id }}/edit"
                                                class="btn btn-sm btn-outline-warning me-1"><i
                                                    class="bi bi-pencil-square"></i></a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
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
