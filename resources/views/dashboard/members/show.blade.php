@extends('dashboard.layouts.main')
@section('container')
    <div class="row justify-content-start my-3">
        <div class="col-md-12">
            <a href="/dashboard/registrants">
                Back
            </a>

            <div class="mt-4">
                <h3>Uploaded Documents</h3>

                @if ($registrant->ktp)
                    <div>
                        <strong class="d-block">KTP Copy:</strong>
                        <img src="{{ asset($registrant->ktp) }}" alt="KTP" class="img-fluid" style="max-width: 200px;">
                    </div>
                @else
                    <p>No KTP uploaded.</p>
                @endif

                @if ($registrant->photo)
                    <div>
                        <strong class="d-block">Photo:</strong>
                        <img src="{{ asset($registrant->photo) }}" alt="Passport Photo" class="img-fluid"
                            style="max-width: 200px;">
                    </div>
                @else
                    <p>No Passport Photo uploaded.</p>
                @endif

                @if ($registrant->immigration_law_consultant_certificate)
                    <div>
                        <strong class="d-block">Immigration Law Consultant Certificate:</strong>
                        <img src="{{ asset($registrant->immigration_law_consultant_certificate) }}"
                            alt="Immigration Law Consultant Certificate" class="img-fluid" style="max-width: 200px;">
                    </div>
                @else
                    <p>No Immigration Law Consultant Certificate uploaded.</p>
                @endif

                @if ($registrant->other_certificates)
                    <div>
                        <strong class="d-block">Other Certificates:</strong>
                        @foreach ($registrant->other_certificates as $certificate)
                            <div class="mb-2">
                                <img src="{{ asset($certificate) }}" alt="Other Certificate" class="img-fluid"
                                    style="max-width: 200px;">
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No other certificates uploaded.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
