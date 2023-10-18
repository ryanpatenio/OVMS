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
                                    <a href="#" type="button" id="edit_btn"
                                        class="btn btn-warning btn-sm bi bi-pencil" data-id="{{ $voter->id }}">
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
        <div class="modal fade modal-md" id="editVotersModal" tabindex="-1" role="dialog"
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
                        <form id="editVotersForm">

                            @csrf
                            <input type="hidden" value="" name="id" id="edit_id">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <label for="candidates edit name">Voters Name</label>
                                            <input type="text" name="name" id="edit_name" class="form-control"
                                                placeholder="Candidates Name..." required>
                                        </div>

                                    </div>
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('click', '#edit_btn', function(e) {
                    e.preventDefault();

                    //lets clear the form first
                    $('#editVotersForm')[0].reset();

                    let ID = $(this).attr('data-id');
                    $.ajax({
                        url: '{{ route('edit.voters') }}',
                        method: 'post',
                        data: {
                            ID: ID
                        },
                        dataType: 'json',

                        success: function(resp) {
                            //console.log(resp)
                            $('#edit_name').val(resp.data.name);
                            $('#edit_email').val(resp.data.email);
                            $('#edit_id').val(resp.data.id);
                            $('#editVotersModal').modal('show');
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText)
                        }

                    });

                });

                $(document).on('submit', '#editVotersForm', function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: '{{ route('voters.update') }}',
                        method: 'post',
                        data: $(this).serialize(),
                        dataType: 'json',

                        success: function(resp) {
                            //console.log(resp)
                            clearFields('#editVotersForm');
                            closeModal('#editVotersModal');
                            if (resp.message == 'success') {
                                message('Voters Updated Successfully!', 'success');
                            }
                            if (resp.message == 'error_find') {
                                msg('Oops! Unexpected Error!', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText)
                        }

                    });

                });

            });



            const clearFields = (fieldName) => {
                $(fieldName)[0].reset();
            }
            const closeModal = (modalName) => {
                $(modalName).modal('hide');
            }
        </script>
    @endsection
