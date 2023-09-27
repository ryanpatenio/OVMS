@extends('layouts.ballot-admin')
@section('content')
    <div class="pagetitle">
        <h1>Ballot Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ballot.index') }}">Home Dashboard</a></li>
                <li class="breadcrumb-item active">Ballot Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            <a href="{{ route('addBallotPage') }}" class="btn btn-sm btn-primary" type="button"><i class="bi bi-plus-circle">
                    New</i></a>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datatable table-light" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Ballot Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @forelse ($ballots as $ballot)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $ballot->ballot_name }}</td>
                                <td>{{ $ballot->details }}</td>


                                <td>
                                    <a href="{{ route('edit.ballot', $ballot->ballot_id) }}" type="button"
                                        class="btn btn-warning btn-sm bi bi-pencil" id="edit_cust_btn" data-id="">
                                    </a>
                                    <a href="/view-ballot" type="button" class="btn btn-primary btn-sm bi bi-search"></a>
                                    <a href="#"type="button" class="btn btn-sm btn-success bi bi-check">publish</a>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @empty
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    @endsection
