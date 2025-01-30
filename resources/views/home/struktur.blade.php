@extends('home.layouts.main')


@section('contain')
    <!-- Carousel Struktur -->
    <section id="section-1" class="section-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-white">
                    <h1 class="font-times fw-bold text-shadow">DEWAN KEHORMATAN</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Carousel Struktur -->

    <section id="section-2" class="section-2 mt-5">
        <div class="container">
            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @if ($roles->isNotEmpty())
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="{{ $roles[0]->slug }}-tab" data-bs-toggle="tab"
                            data-bs-target="#{{ $roles[0]->slug }}" type="button" role="tab"
                            aria-controls="{{ $roles[0]->slug }}" aria-selected="true">{{ $roles[0]->name }}</button>
                    </li>
                    @foreach ($roles->skip(1) as $role)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="{{ $role->slug }}-tab" data-bs-toggle="tab"
                                data-bs-target="#{{ $role->slug }}" type="button" role="tab"
                                aria-controls="{{ $role->slug }}" aria-selected="true">{{ $role->name }}</button>
                        </li>
                    @endforeach
                @else
                    <b>Dewan kehormatan akan ditampilkan di sini.</b>
                @endif
            </ul>
            <div class="tab-content my-5" id="tab-content">
                @if ($roles->isNotEmpty())
                    <div class="tab-content my-5" id="tab-content">
                        @foreach ($roles as $role)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $role->slug }}"
                                role="tabpanel" aria-labelledby="{{ $role->slug }}-tab">
                                @if (isset($structures[$role->id]))
                                    <div class="row justify-content-evenly">
                                        {{-- Hero Section --}}
                                        @if (!empty($structures[$role->id][0]))
                                            <div class="col col-10 col-md-5 col-lg-3 align-self-center p-0 text-center">
                                                <img src="{{ asset($structures[$role->id][0]->image) }}" alt="{{ $structures[$role->id][0]->name }}"
                                                    class="img-fluid" />
                                                <div class="title">
                                                    <p class="h-100 p-2 row justify-content-center align-items-center">
                                                        <span>
                                                            <b>{{ $structures[$role->id][0]->name }}</b><br />
                                                            <i>{{ $structures[$role->id][0]->position }}</i>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="overlay">
                                                    <div class="row justify-content-center h-100 text-start py-4">
                                                        <div class="col-10 align-self-start">
                                                            <b class="d-block">{{ $structures[$role->id][0]->name }}</b>
                                                            <i>{{ $structures[$role->id][0]->position }}</i>
                                                        </div>
                                                        <div class="col-10 align-self-end">
                                                            <b class="d-block">Kantor Hukum</b>
                                                            {{ $structures[$role->id][0]->lawfirm }}<br />
                                                            <b class="d-block">Kontak</b>
                                                            {{ $structures[$role->id][0]->email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-100 mb-3"></div>
                                        @endif

                                        {{-- Additional Members --}}
                                        @foreach ($structures[$role->id]->skip(1) as $structure)
                                            <div class="col col-10 col-md-5 col-lg-3 mx-lg-1 align-self-center p-0 text-center mb-3">
                                                <img src="{{ asset($structure->image) }}" alt="{{ $structure->name }}"
                                                    class="img-fluid" />
                                                <div class="title">
                                                    <p class="h-100 p-2 row justify-content-center align-items-center">
                                                        <span>
                                                            <b>{{ $structure->name }}</b><br />
                                                            <i>{{ $structure->position }}</i>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="overlay">
                                                    <div class="row justify-content-center h-100 text-start py-4">
                                                        <div class="col-10 align-self-start">
                                                            <b class="d-block">{{ $structure->name }}</b>
                                                            <i>{{ $structure->position }}</i>
                                                        </div>
                                                        <div class="col-10 align-self-end">
                                                            <b class="d-block">Kantor Hukum</b>
                                                            {{ $structure->lawfirm }}<br />
                                                            <b class="d-block">Kontak</b>
                                                            {{ $structure->email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="mt-4">
                                        <h4>{{ $role->name }}</h4>
                                        <p>Data untuk {{ $role->name }} belum tersedia.</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
    </section>
@endsection
