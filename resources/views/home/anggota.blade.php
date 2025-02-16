@extends('home.layouts.main')

@section('contain')
    <!-- Carousel Anggota -->
    <section id="section-1" class="section-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-white">
                    <h1 class="font-times fw-bold text-shadow">ANGGOTA</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Carousel Anggota -->

    <!-- Form Anggota -->
    <section id="section-2" class="section-2">
        <div class="container">
            <div class="table-responsive mt-4">
                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Nama Instansi/Firma Hukum/Perusahaan</th>
                            <th scope="col">Jabatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($members) == 0)
                            <tr>
                                <td colspan="10" class="text-center">Belum ada yang terdaftar sebagai anggota</td>
                            </tr>
                        @else
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->institution }}</td>
                                    <td>{{ $member->position }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- End Form Anggota -->
@endsection
