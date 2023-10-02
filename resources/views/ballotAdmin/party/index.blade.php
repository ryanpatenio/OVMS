@extends('layouts.ballot-admin')

@section('content')
    <div class="pagetitle">
        <h1>Party Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ballot.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Party Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addPartyModal" type="button"><i
                    class="bi bi-plus-circle"> New</i></button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datatable table-light" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Party Name</th>

                            <th>Ballot Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @forelse ($parties as $party)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $party->party_name }}</td>

                                <td>{{ $party->ballot_name }}</td>

                                <td>
                                    <button type="button" id="edit_party_button" data-id="{{ $party->party_id }}"
                                        class="btn btn-warning bi bi-pencil btn-sm">
                                        Modify</button>
                                    <a href="{{ route('view.party', $party->party_id) }}" type="button"
                                        class="btn btn-primary bi bi-search btn-sm">
                                        View</a>
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
        <!--ADD Modal-->
        <div class="modal fade modal-md" id="addPartyModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Party</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addPartyForm">
                            @csrf
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <label for="candidates name">Party Name</label>
                                            <input type="text" name="party_name" class="form-control"
                                                placeholder="Party Name..." required>
                                            <span class="text-danger" id="err_party_name"></span>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="candidates name">Ballot Name</label>
                                            <select name="ballot_id" id="" class="form-select">
                                                @forelse ($ballotData as $ballot)
                                                    <option value="{{ $ballot->ballot_id }}">{{ $ballot->ballot_name }}
                                                    </option>
                                                @empty
                                                @endforelse

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Add">

                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--End of ADD Modal-->

        <!--Edit Modal-->
        <div class="modal fade modal-md" id="UpdatePartyModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Party</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="edit_party_form">
                            @csrf
                            @can('manage-ballots')
                                <input type="hidden" id="hidden_id" name="party_id">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <label for="party name">Party Name</label>
                                                <input type="text" name="party_name" id="edit_party_name"
                                                    class="form-control" placeholder="Party Name..." required>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endcan

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

                //add Party
                $(document).on('submit', '#addPartyForm', function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: '{{ route('party.add') }}',
                        method: 'POST',
                        data: $(this).serialize(),
                        dataType: 'json',

                        success: function(resp) {
                            //  console.log(resp)
                            clearError()
                            if (resp.message == 'success') {
                                message('New Party Added Successfully!', 'success');
                            }

                        },
                        error: function(xhr, status) {
                            //console.log(xhr.responseText)
                            let err = JSON.parse(xhr.responseText);

                            if (err.message == 'name_unique') {
                                $('#err_party_name').text('Party Name is already taken!');
                            }
                            if (err.message == 'error_request') {
                                msg('Oops! Unexpected Error!', 'error');
                            }
                        }

                    });
                });

                //edit Party
                $(document).on('click', '#edit_party_button', function(e) {
                    e.preventDefault();
                    $('#hidden_id').val('');
                    let p_ID = $(this).attr('data-id');

                    $.ajax({
                        url: '{{ route('edit.party') }}',
                        method: 'post',
                        data: {
                            p_ID: p_ID
                        },
                        dataType: 'json',

                        success: function(resp) {
                            //console.log(resp)
                            $('#hidden_id').val(resp.data[0].party_id)
                            $('#edit_party_name').val(resp.data[0].party_name)
                            $('#edit_ballot_id').val(resp.data[0].ballot_id)
                            $('#edit_ballot_id').text(resp.data[0].ballot_name)
                            $('#UpdatePartyModal').modal('show');
                        },
                        error: function(xhr, status) {
                            console.log(xhr.responseText)
                        }

                    });
                });

                //Update Party
                $(document).on('submit', '#edit_party_form', function(e) {
                    e.preventDefault();

                    swal({
                        title: "Are you sure you want Update this Party?",
                        text: 'Please Click the `OK` Button to Continue!',
                        icon: "info",
                        buttons: true,
                        dangerMode: true,
                    }).then((willconfirmed) => {

                        if (willconfirmed) {

                            $.ajax({
                                url: '{{ route('update.party') }}',
                                method: 'POST',
                                data: $(this).serialize(),
                                dataType: 'json',

                                success: function(resp) {
                                    // console.log(resp)
                                    $('#edit_party_form')[0].reset()
                                    $('#UpdatePartyModal').modal('hide');
                                    if (resp.message == 'success') {
                                        message('Party Updated successfully!', 'success')
                                    }

                                },
                                error: function(xhr, status) {
                                    // console.log(xhr)
                                    let err = JSON.parse(xhr.responseText);
                                    if (err.message == 'proccess_error') {
                                        msg('Oops! Unexpeted Error! error 422', 'error');
                                    }
                                }
                            })
                        }

                    });

                });


            });



            const clearError = () => {
                $('#err_party_name').text('');
            }
        </script>
    @endsection
