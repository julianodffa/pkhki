@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="font-poppins-bold">Detail Information</h3>
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
                    <th class="table-light" scope="row" style="width: 1%; white-space: nowrap;">Name</th>
                    <td class="align-middle">{{ $registrant->name }}</td>
                </tr>
                <tr>
                    <th class="table-light" scope="row" style="width: 1%; white-space: nowrap;">Phone</th>
                    <td class="align-middle">{{ $registrant->phone }}</td>
                </tr>
                <tr>
                    <th class="table-light" scope="row" style="width: 1%; white-space: nowrap;">Email</th>
                    <td class="align-middle">{{ $registrant->email }}</td>
                </tr>
                <tr>
                    <th class="table-light" scope="row" style="width: 1%; white-space: nowrap;">Address</th>
                    <td class="align-middle">{{ $registrant->address }}</td>
                </tr>
                <tr>
                    <th class="table-light" scope="row" style="width: 1%; white-space: nowrap;">Institution</th>
                    <td class="align-middle">{{ $registrant->institution }}</td>
                </tr>
                <tr>
                    <th class="table-light" scope="row" style="width: 1%; white-space: nowrap;">Position</th>
                    <td class="align-middle">{{ $registrant->position }}</td>
                </tr>
                <tr>
                    <th class="table-light" scope="row" style="width: 1%; white-space: nowrap;">Company Email</th>
                    <td class="align-middle">{{ $registrant->company_email }}</td>
                </tr>
                <tr>
                    <th class="table-light" scope="row" style="width: 1%; white-space: nowrap;">Member of Other Legal
                        Association</th>
                    <td class="align-middle">{{ $registrant->is_member_of_other_legal_association ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                    <th class="table-light" scope="row" style="width: 1%; white-space: nowrap;">Accepted By</th>
                    <td class="align-middle"><strong>{{ $registrant->user->name }}</strong></td>

                </tr>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h5 class="font-poppins-bold">Uploaded Documents</h5>
    </div>
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
                        <img src="{{ route('member.file', ['folder' => 'ktp', 'filename' => basename($registrant->ktp)]) }}"
                            alt="KTP" class="img-fluid">
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
                        <img src="{{ route('member.file', ['folder' => 'photo', 'filename' => basename($registrant->photo)]) }}"
                            alt="Photo" class="img-fluid">
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
                        <iframe
                            src="{{ route('member.file', ['folder' => 'ilc_certificate', 'filename' => basename($registrant->immigration_law_consultant_certificate)]) }}"
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
                                <iframe
                                    src="{{ route('member.file', ['folder' => 'other_certificate', 'filename' => basename($certificate)]) }}"
                                    width="100%" height="800px"></iframe>
                            </div>
                        @endforeach
                    @else
                        <p>No other certificates uploaded.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection
