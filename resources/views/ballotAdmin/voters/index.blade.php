@extends('layouts.ballot-admin')

@section('content')
    <div class="pagetitle">
        <h1>Voters Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ballot.index') }}">Home Dashboard</a></li>
                <li class="breadcrumb-item active">Voters Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            <a href="{{ route('voters.add') }}" class="btn btn-sm btn-primary" type="button"><i class="bi bi-plus-circle">
                    New</i></a>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datatable table-light" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Voters Name</th>
                            <th>Ballot Name</th>

                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @forelse ($Voters as $voter)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $voter->name }}</td>
                                <td>{{ $voter->ballot_name }}</td>

                                <td>
                                    <a href="#" type="button" class="btn btn-warning btn-sm bi bi-pencil"
                                        data-bs-toggle="modal" data-bs-target="#updateVotersModal" id="editCandidates"
                                        data-id="">
                                    </a>
                                    <a type="button" class="btn btn-danger btn-sm bi bi-trash" id="removeVoters"
                                        data-id="">
                                    </a>


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


        <!--Edit Modal-->
        <div class="modal fade modal-md" id="updateVotersModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Candidates</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <label for="candidates edit name">Voters Name</label>
                                            <input type="text" class="form-control" placeholder="Candidates Name..."
                                                required value="Ryan Wong">
                                        </div>
                                        <div class="row mb-2">
                                            <label for="Voters Edit Email">Email</label>
                                            <input type="email" class="form-control" placeholder="Email..." required>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="Voters Edit name">Temporary Password</label>
                                            <input type="text" class="form-control bi"
                                                placeholder="Temporary Password..." required>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="Voters edit Ballot Name">Ballot Name</label>
                                            <select name="editBallotName" id="" class="form-select">
                                                <option value="">Sun's Company</option>
                                                <option value="">Psy Company</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script>
            $(document).ready(function() {


                $(document).on('change', '#votersType', function(e) {
                    e.preventDefault();
                    let votersDiv = $('#votersDiv');
                    let candidatesDiv = $('#candidatesDiv');

                    // if ($(this).val() == 'Voters') {
                    //     candidatesDiv.addClass('d-none');
                    //     votersDiv.removeClass('d-none');
                    //     console.log($('#c').val())
                    //     console.log($('#v').val())
                    // }
                    // if ($(this).val() == 'Candidates') {
                    //     votersDiv.addClass('d-none');
                    //     candidatesDiv.removeClass('d-none');
                    //     console.log($('#c').val())
                    //     console.log($('#v').val())
                    // }
                });

            });


            function show(divId) {
                $("#" + divId).show();
            }

            function GFG_Fun() {
                show('div');
                $('#GFG_DOWN').text("DIV Box is visible.");
            }
        </script>
    @endsection
