@extends('layouts.ballot-admin')
@section('content')
    <div class="pagetitle">
        <h1>Position Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ballot.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Position Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            {{-- <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addPartyModal" type="button"><i
                    class="bi bi-plus-circle"> New</i></button> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datatable table-light" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Ballot Name</th>
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
                                <td>
                                    <a href="{{ route('add.position.form', $ballot->ballot_id) }}" type="button"
                                        class="btn btn-success bi bi-plus btn-sm" data-id="">
                                        Add Position</a>
                                    {{-- <a href="{{ route('view.party') }}" type="button"
                                    class="btn btn-primary bi bi-search btn-sm">
                                    View</a> --}}
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
