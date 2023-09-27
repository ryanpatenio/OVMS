@extends('layouts.ballot-admin')

@section('content')
    <div class="pagetitle">
        <h1>Candidates Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ballot.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Candidates Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addCandidatesModal"
                type="button"><i class="bi bi-plus-circle"> New</i></button>
        </div>
        {{-- table --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datatable table-light" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Candidates Name</th>
                            <th>Position</th>
                            <th>Ballot Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @forelse ($candidates as $candidate)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $candidate->candidate_name }}</td>
                                <td>{{ $candidate->position_name }}</td>
                                <td>{{ $candidate->ballot_name }}</td>

                                <td>
                                    <a href="#" type="button" class="btn btn-warning bi bi-pencil btn-sm"
                                        id="editCandidates" data-id="{{ $candidate->candidate_id }}">
                                        Modify</a>
                                    <a href="/view-candidates" type="button" class="btn btn-primary btn-sm bi bi-search">
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
        {{-- end of table --}}

        <!--ADD Modal-->
        <div class="modal fade modal-md" id="addCandidatesModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Candidates</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form id="addCandidatesForm" method="POST">

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <label for="candidates name">Candidates Name</label>
                                            <input type="text" class="form-control" name="candidate_name"
                                                placeholder="Candidates Name..." required>
                                        </div>

                                        <div class="row ">
                                            <label for="ballots name">Ballot Name</label>
                                            <select name="ballot_id" id="ballotDropDown" class="form-select">
                                                <option value="0">--Select--</option>

                                                @forelse ($ballots as $ballot)
                                                    <option value="{{ $ballot->ballot_id }}">{{ $ballot->ballot_name }}
                                                    </option>

                                                @empty
                                                @endforelse

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <label for="select Position">Running for Position</label>
                                            <select name="position_id" id="Position" class="form-select Position-x "
                                                required>

                                            </select>
                                            <span class="text-success" id="positionStatus"></span>
                                        </div>
                                        <div class="row">
                                            <label for="select Position">Party (Optional)</label>
                                            <select name="party_id" id="Parties" class="form-select Party-x">

                                            </select>
                                            <span class="text-success" id="PartyStatus"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close btn-close-x"
                            data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary btn-add-x" value="Add" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--End of ADD Modal-->

        <!--Edit Modal-->
        <div class="modal fade modal-md" id="UpdateCandidatesModal" tabindex="-1" role="dialog"
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
                        <form id="editCandidateForm" method="POST">
                            <input type="hidden" id="candidate-id" name="candidate_id">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <label for="candidates name">Candidates Name</label>
                                            <input type="text" id="edit-candidate-name" name="candidate_name"
                                                class="form-control" placeholder="Candidates Name..." required
                                                value="">
                                        </div>

                                        <div class="row ">
                                            <label for="ballots name">
                                                <p style="font-style:italic">
                                                    <strong style="color: rgb(238, 9, 116);">Note!!... </strong>
                                                    If you
                                                    want to change
                                                    the <strong style="color: rgb(238, 9, 116);"> Position</strong> or The
                                                    <strong style="color: rgb(238, 9, 116);"> Party</strong>
                                                    Please <strong style="color: rgb(238, 9, 116);">Re-Select</strong>
                                                    this <strong style="color: rgb(238, 9, 116);">Ballot
                                                        Drop down below!</strong>
                                                </p>
                                                Ballot Name
                                            </label>
                                            <select name="ballot_id" id="ballotDropDown2" name="ballot_id"
                                                class="form-select">
                                                <option value="0" id="ballot-edit-first"></option>
                                                @forelse ($ballots as $ballot)
                                                    <option value="{{ $ballot->ballot_id }}">{{ $ballot->ballot_name }}
                                                    </option>

                                                @empty
                                                @endforelse

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <label for="select Position">Running for Position</label>
                                            <select name="position_id" id="Position2" class="form-select Position-x2 "
                                                required>
                                                <option value="" id="pos-edit-first"></option>

                                            </select>
                                            <span class="text-success" id="positionStatus2"></span>
                                        </div>
                                        <div class="row">
                                            <label for="select Position">Party (Optional)</label>
                                            <select name="party_id" id="Parties2" class="form-select Party-x2">
                                                <option value="" id="party-edit-first"></option>
                                            </select>
                                            <span class="text-success" id="PartyStatus2"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-close-x2"
                            data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary btn-update-x2" value="Update">

                        </form>
                    </div>
                </div>
            </div>
        @endsection

        @section('scripts')
            <script>
                $(document).ready(function() {
                    //to fetch the ballot data
                    $(document).on('change', '#ballotDropDown', function(e) {
                        e.preventDefault();
                        let add = $('.btn-add-x');
                        let close = $('.btn-close-x');
                        let pos = $('.Position-x');
                        let party = $('.Party-x');


                        let ballot_id = $(this).val();

                        // var elements = document.getElementsByTagName("select");
                        // for (i = 0; i < elements.length; i++) {
                        //     elements[i].value = '';
                        // }

                        if (ballot_id != 0) {
                            $.ajax({
                                url: '{{ route('get.position') }}',
                                method: 'POST',
                                data: {
                                    ballot_id: ballot_id
                                },
                                dataType: 'json',
                                cache: false,
                                beforeSend: function() {
                                    $('#positionStatus').html("Retrieving data...");
                                    $('#PartyStatus').html("Retrieving data...");
                                    DisableButton(add, close, pos, party);

                                },

                                success: function(resp) {
                                    //console.log(resp)
                                    $('#Position').html("");
                                    $('#Parties').html("");


                                    $.each(resp.data, function(key, item) {
                                        $('#Position').append(

                                            '<option value=' +
                                            item.position_id + '>' + item.position_name +
                                            '</option>'
                                        );

                                    });
                                    if (resp.data_parties.length === 0) {
                                        $('#Parties').append(
                                            '<option value="">Independent</option>'
                                        );
                                    }
                                    $.each(resp.data_parties, function(key, item) {
                                        $('#Parties').append(
                                            '<option value="">Independent</option>',
                                            '<option value=' +
                                            item.party_id + '>' + item.party_name +
                                            '</option>'
                                        );

                                    });

                                },
                                complete: function() {
                                    $('#positionStatus').html("");
                                    $('#PartyStatus').html("");

                                    EnableButton(add, close, pos, party);
                                },

                                error: function(xhr, status) {
                                    $('#Position').html("");
                                    $('#Parties').html("");
                                    // console.log(xhr.responseText);
                                    let err = JSON.parse(xhr.responseText);
                                    if (err.message == 'error_find') {

                                        swal({
                                            title: "Opps! Unexpected Error! No Position Found in this Ballot! Please ADD Position First!",
                                            text: 'Would you like to Redirect To add Position?',
                                            icon: "error",
                                            buttons: [true, "Yes"],
                                            dangerMode: true,
                                        }).then((willconfirmed) => {
                                            if (willconfirmed) {

                                                window.location =
                                                    '/ballotAdmin/add-position-view/' +
                                                    err
                                                    .data_id + '/add';

                                            } else {
                                                // setInterval(() => {
                                                //     window.location =
                                                //         '/ballotAdmin/add-position-view/' +
                                                //         err
                                                //         .data_id + '/add';
                                                // }, 2000);
                                                resetAddModal();

                                            }
                                        })


                                    }
                                }

                            });

                        } else {
                            //selected have null value
                            $('#Position').html("");
                            $('#Parties').html("");
                        }
                    });
                    //to fetch and edit candidates
                    $(document).on('change', '#ballotDropDown2', function(e) {
                        e.preventDefault();
                        let update = $('.btn-update-x2');
                        let close = $('.btn-close-x2');
                        let pos = $('.Position-x2');
                        let party = $('.Party-x2');
                        let ballot_id = $(this).val();


                        if (ballot_id != 0) {
                            $.ajax({
                                url: '{{ route('get.position') }}',
                                method: 'POST',
                                data: {
                                    ballot_id: ballot_id
                                },
                                dataType: 'json',
                                cache: false,
                                beforeSend: function() {
                                    $('#positionStatus2').html("Retrieving data...");
                                    $('#PartyStatus2').html("Retrieving data...");
                                    DisableButton(update, close, pos, party);

                                },

                                success: function(resp) {
                                    // console.log(resp)
                                    $('#Position2').html("");
                                    $('#Parties2').html("");
                                    $.each(resp.data, function(key, item) {
                                        $('#Position2').append(
                                            '<option value=' +
                                            item.position_id + '>' + item.position_name +
                                            '</option>'
                                        );

                                    });
                                    if (resp.data_parties.length === 0) {
                                        $('#Parties2').append(
                                            '<option value="">Independent</option>'
                                        );
                                    }
                                    $.each(resp.data_parties, function(key, item) {
                                        $('#Parties2').append(
                                            '<option value="">Independent</option>',
                                            '<option value=' +
                                            item.party_id + '>' + item.party_name +
                                            '</option>'
                                        )
                                    });
                                },
                                complete: function() {
                                    $('#positionStatus2').html("");
                                    $('#PartyStatus2').html("");
                                    EnableButton(update, close, pos, party);
                                },

                                error: function(xhr, status) {
                                    // console.log(xhr.responseText);
                                    $('#Position2').html("");
                                    $('#Parties2').html("");

                                    let err = JSON.parse(xhr.responseText);
                                    if (err.message == 'error_find') {
                                        msg('Opps! Unexpected Error! Data Not Found! Please ADD Position First!',
                                            'error');

                                    }
                                }

                            });

                        } else {
                            //selected have null value
                            $('#Position2').html("");
                            $('#Parties2').html("");
                        }
                    });
                    //for adding new candidates
                    $(document).on('submit', '#addCandidatesForm', function(e) {
                        e.preventDefault();

                        $.ajax({
                            url: '{{ route('store.candidates') }}',
                            method: 'POST',
                            data: $(this).serialize(),
                            dataType: 'json',

                            success: function(resp) {
                                //console.log(resp)
                                $('#addCandidatesForm')[0].reset();
                                $('#addCandidatesModal').modal('hide');
                                if (resp.message == 'success') {
                                    message('New Candidate added successfully!', 'success');
                                }
                            },
                            error: function(xhr, status) {
                                console.log(xhr.responseText)
                                let err = JSON.parse(xhr.responseText);
                                if (err.message == 'processing_error') {
                                    msg('Opps! Request Unprocessable!', 'error');
                                }
                                if (err.message == 'ballot_id_err') {
                                    msg('Opps! Unexpected Error ID Not Found!', 'error');
                                }
                            }

                        });

                    });
                    //edit new candidates
                    $(document).on('click', '#editCandidates', function(e) {
                        e.preventDefault();
                        $('#editCandidateForm')[0].reset();

                        let ID = $(this).attr('data-id');
                        $.ajax({
                            url: '{{ route('candidate.edit') }}',
                            method: 'post',
                            data: {
                                candidate_id: ID
                            },
                            dataType: 'json',

                            success: function(data) {
                                // console.log(data)
                                $('#candidate-id').val(data.data.candidate_id);

                                $('#edit-candidate-name').val(data.data.candidate_name)
                                $('#ballot-edit-first').val(data.data.ballot_id);
                                $('#ballot-edit-first').text(data.data.ballot_name);

                                $('#pos-edit-first').val(data.data.position_id);
                                $('#pos-edit-first').text(data.data.position_name);

                                if (data.data.party_id != null) {
                                    $('#party-edit-first').val(data.data.party_id);
                                    $('#party-edit-first').text(data.data.party_name);

                                } else {
                                    $('#party-edit-first').val('');
                                    $('#party-edit-first').text('Independent');
                                }
                                $('#UpdateCandidatesModal').modal('show');

                            },

                            error: function(xhr, status, error) {
                                console.log(xhr.responseText)
                            }


                        });

                    });
                    //update candidates
                    $(document).on('submit', '#editCandidateForm', function(e) {
                        e.preventDefault();


                        swal({
                            title: "Are you sure you want Update this Candidate?",
                            text: 'Please Click the `OK` Button to Continue!',
                            icon: "info",
                            buttons: true,
                            dangerMode: true,
                        }).then((willconfirmed) => {

                            if (willconfirmed) {
                                $.ajax({
                                    url: '{{ route('update.candidate') }}',
                                    method: 'POST',
                                    data: $(this).serialize(),
                                    dataType: "JSON",

                                    success: function(resp) {
                                        //console.log(resp)
                                        $('#editCandidateForm')[0].reset();
                                        $('#UpdateCandidatesModal').modal('hide');
                                        if (resp.message == 'success') {
                                            message('Candidate updated Successfully!',
                                                'success');
                                            //sdad
                                        }
                                    },
                                    error: function(xhr, status) {
                                        //console.log(xhr.responseText)
                                        let err = JSON.parse(xhr.responseText);
                                        if (err.message == 'error_process') {
                                            msg('Opps! Request Unprocessable!', 'error');
                                        }
                                        if (err.message == 'error_find') {
                                            msg('Opps! Unexpected Error!', 'error')
                                        }
                                    }

                                });
                            }

                        });

                    })


                });

                function DisableButton(add, close, pos, party) {
                    $(close).addClass('disabled');
                    $(add).addClass('disabled');
                    $(pos).prop('disabled', true);
                    $(party).prop('disabled', true);
                }

                function EnableButton(add, close, pos, party) {
                    $(close).removeClass('disabled');
                    $(add).removeClass('disabled');
                    $(pos).prop('disabled', false);
                    $(party).prop('disabled', false);
                }
                const resetAddModal = () => {
                    $('#addCandidatesModal').modal('hide');
                    $('#addCandidatesForm')[0].reset();
                }
            </script>
        @endsection
