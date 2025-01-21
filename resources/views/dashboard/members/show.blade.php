@extends('dashboard.layouts.main')
@section('container')
    <div class="row justify-content-start my-3">
        <div class="col-md-12">
            <a href="#" onclick="history.back()">
                Back
            </a>

            <div class="mt-4">
                <h3>Uploaded Documents</h3>
                <div class="accordion" id="accordionPanelsStayOpenExample" class="rounded-0">
                    <div class="accordion-item rounded-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button rounded-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                <b>Identity Card</b>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                @if ($registrant->ktp)
                                    <img src="{{ asset($registrant->ktp) }}" alt="KTP" class="img-fluid">
                                @else
                                    <p>No KTP uploaded.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item rounded-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button rounded-0 collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseTwo">
                                <b>Photo</b>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                @if ($registrant->photo)
                                    <img src="{{ asset($registrant->photo) }}" alt="Photo" class="img-fluid">
                                @else
                                    <p>No Photo uploaded.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item rounded-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button rounded-0 collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                <b>Immigration Law Consultant Certificate</b>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                @if ($registrant->immigration_law_consultant_certificate)
                                    <iframe src="{{ asset($registrant->immigration_law_consultant_certificate) }}"
                                        width="100%" height="800px"></iframe>
                                @else
                                    <p>No Immigration Law Consultant Certificate uploaded.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item rounded-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button rounded-0 collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseFourth" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseFourth">
                                <b>Other Certificates</b>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseFourth" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                @if ($registrant->other_certificates)
                                    @foreach ($registrant->other_certificates as $certificate)
                                        <div class="mb-2">
                                            <iframe src="{{ asset($certificate) }}" width="100%" height="800px"></iframe>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No other certificates uploaded.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
