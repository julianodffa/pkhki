@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="font-poppins-bold">Detail Publication</h3>
    </div>
    <div class="row justify-content-start">
        <div class="col-md-10">
            <a class="btn btn-success" href="/dashboard/publications">
                Back
            </a>
            <a class="btn btn-warning text-white" href="/dashboard/publications/{{ $publication->slug }}/edit">Edit</a>
        </div>
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-bordered text-center  ">
            <thead class="table-light">
                <tr>
                    <th style="width: 1%; white-space: nowrap;"></th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="table-light" scope="row" style="width: 1%; white-space: nowrap;">Title</th>
                    <td class="align-middle"><strong>{{ $publication->title }}</strong></td>
                </tr>
                <tr>
                    <th class="table-light" scope="row" style="width: 1%; white-space: nowrap;">Created At</th>
                    <td class="align-middle">{{ $publication->created_at }}</td>
                </tr>
                <tr>
                    <th class="table-light" scope="row" style="width: 1%; white-space: nowrap;">Created At</th>
                    <td class="align-middle">{{ $publication->created_at }} /
                        {{ $publication->created_at->diffForHumans() }}</td>
                </tr>
                <tr>
                    <th class="table-light" scope="row" style="width: 1%; white-space: nowrap;">Author</th>
                    <td class="align-middle">{{ $publication->user->name }}</td>
                </tr>
                <tr>
                    <th class="table-light" scope="row" style="width: 1%; white-space: nowrap;">Category</th>
                    <td class="align-middle">
                        @foreach ($publication->categories as $category)
                            <span
                                class="btn btn-sm my-1 rounded-pill text-bg-secondary pe-none">{{ $category->name }}</span>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h5 class="font-poppins-bold">Content</h5>
    </div>
    <div class="accordion" id="accordionPanelsStayOpenExample" class="rounded-0">
        <div class="accordion-item rounded-0">
            <h2 class="accordion-header">
                <button class="accordion-button rounded-0 collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseOne">
                    <b>Cover</b>
                </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="col-12 col-md-6">
                        <picture class="img-fluid">
                            <source srcset="{{ asset($publication->cover_webp) }}" type="image/webp">
                            <img src="{{ asset($publication->cover) }}" class="w-100" alt="Fallback image">
                        </picture>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item rounded-0">
            <h2 class="accordion-header">
                <button class="accordion-button rounded-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                    aria-controls="panelsStayOpen-collapseTwo">
                    <b>Displayed Content</b>
                </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    <article id="contentHtml" class="my-3 lh-lg font-opensans">
                        {!! $contentHtml !!}
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection
