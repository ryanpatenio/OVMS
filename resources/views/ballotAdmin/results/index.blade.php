@extends('layouts.ballot-admin')
@section('content')
    <div class="pagetitle">
        <h1>Result Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ballot.index') }}">Home Dashboard</a></li>
                <li class="breadcrumb-item active">Results Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>

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


                        <tr>
                            <td>1</td>
                            <td>Suns Company Election</td>
                            <td>Election for Choosing New CEO </td>


                            <td>

                                <a href="/view-ballot" type="button" class="btn btn-primary bi bi-search"> View</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    @endsection
