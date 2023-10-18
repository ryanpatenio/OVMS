@extends('layouts.ballot-admin')

@section('content')
    <div class="pagetitle">
        <h1>Update Ballot</h1>
        <nav>
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{ route('MyBallots.index') }}">Ballot Dashboard</a></li>
                <li class="breadcrumb-item active">Update Ballot</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ballot Details</h5>
                        <div class="row mb-2">
                            <form method="POST" id="Update-Ballot-Form">
                                @csrf
                                <div class="col">

                                    <input type="hidden" name="id" id="ballot_id"
                                        value="{{ $ballotData->ballot_id }}">

                                    <label for="Ballot Name">Ballot Name</label>
                                    <input type="text" name="ballot_name" class="form-control"
                                        placeholder="Ballot Name..." value="{{ $ballotData->ballot_name }}" required>
                                    <span class="text-danger" id="err_name"></span>
                                </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="Ballot Name">Short Description</label>
                                <textarea name="details" placeholder="Short description..." class="form-control" id="" cols="20"
                                    rows="5" required>{{ $ballotData->details }}</textarea>
                                <span class="text-danger" id="err_details"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Generate Ballot Code</h5>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="Ballot Name">Generate</label>
                                <input type="text" class="form-control" name="ballot_key" id="ballot-code" required
                                    value="{{ $ballotData->ballot_key }}">
                                <span class="text-danger" id="err_code"></span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">

                                <input type="submit" class="btn btn-success btn-md " id="Ballot-GenCode"
                                    value="Change Code">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5" style="margin-top:-20px;">
                <div class="col">
                    <input type="submit" class="btn btn-md btn-primary" value="Update">
                </div>
            </div>

            </form>


            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Position</h5>
                        <div class="table-responsive">
                            <table class="table  table-light" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Position Name</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="b-posTable">


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!--Edit Modal-->
        <div class="modal fade" id="editPositionModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Position</h5>
                        <button type="button" class="close" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="UpdatePostForm">
                            <input type="hidden" id="hidden_pos_id" name="position_id">
                            <div class="row">
                                <div class="col">
                                    <label for="Position">Position</label>
                                    <input type="text" class="form-control" name="position_name" id="pos_name"
                                        value="CEO" placeholder="Position..." required>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="upPosBtn" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#btn-position-update', function(e) {
                e.preventDefault();

                $('#editPositionModal').modal('show');
            })
        })
    </script>

    <script>
        const Ballot_id = $('#ballot_id').val();
        $(document).ready(function() {
            $(document).on('click', '#Ballot-GenCode', function(e) {
                e.preventDefault();
                $('#ballot-code').val('');

                let inputField = $('#ballot-code').val(RandomGen(10));
            });



            $(document).on('submit', '#Update-Ballot-Form', function(e) {
                e.preventDefault();

                let Form = $(this).serialize();
                $.ajax({
                    url: "{{ route('ballot.update') }}",
                    method: 'POST',
                    data: Form,
                    dataType: 'json',

                    success: function(resp) {
                        //console.log(resp);
                        showPostionDataTables(Ballot_id);
                        clearErrorField();
                        if (resp.message == 'success') {
                            msg('Ballot Updated Successfully!', 'success');
                        }
                    },

                    error: function(xhr, status) {
                        //console.log(xhr.responseText);
                        let err = JSON.parse(xhr.responseText);
                        if (err.message == 'ballot_name_err') {
                            $('#err_name').text('Ballot Name is Required!')
                        }
                        if (err.message == 'ballot_details_err') {
                            $('#err_details').text('Ballot Details is Required!')
                        }
                        if (err.message == 'ballot_key_err') {
                            $('#err_code').text('Ballot Code is Required!')
                        }
                        if (err.message == 'ballot_id_err') {
                            msg('Opps Unexpected Error! ID Not Found!', 'error');
                        }
                        if (err.message == 'error_find') {
                            msg('Opps Unexpected Error! ID Not Found!', 'error');
                        }
                        if (err.message == 'error_save') {
                            msg('Opps Unexpected Error! ID Not Found!', 'error');
                        }



                    }

                });


            });

            $(document).on('click', '#btn-position-edit', function(e) {
                e.preventDefault();
                let pos_id = $(this).attr('data-id');
                let hidden_id = $('#hidden_pos_id')
                let pos_name = $('#pos_name')


                $.ajax({
                    url: '{{ route('get.pos.data') }}',
                    method: 'POST',
                    data: {
                        pos_id: pos_id
                    },
                    dataType: 'json',

                    success: function(resp) {
                        hidden_id.val(resp.data[0].position_id);
                        pos_name.val(resp.data[0].position_name);
                        $('#editPositionModal').modal('show');
                    },
                    error: function(xhr, status) {
                        console.log(xhr.responseText);
                    }

                });

            });
            $(document).on('submit', '#UpdatePostForm', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('update.position') }}',
                    method: "post",
                    data: $(this).serialize(),
                    dataType: 'json',

                    success: function(resp) {
                        //console.log(resp);
                        $('#editPositionModal').modal('hide');
                        showPostionDataTables(Ballot_id);
                        if (resp.message == 'success') {
                            msg('Position Updated Successfull!', 'success');
                        }

                    },
                    error: function(xhr, status) {
                        // console.log(xhr.responseText);
                        let err = JSON.parse(xhr.responseText);
                        if (err.message == 'err_find') {
                            msg('Opps! enexpected Error! ID not Found!', 'error');
                        }
                    }

                });

            });



        });
        showPostionDataTables(Ballot_id);

        function clearErrorField() {
            $('#err_name').text('');
            $('#err_details').text('');
            $('#err_code').text('');
        }

        function showPostionDataTables(ID) {
            let i = 1;
            $.ajax({
                url: "/ballotAdmin/getPositionData/" + ID,
                method: "GET",
                dataType: 'json',

                success: function(data) {
                    $('#b-posTable').html("");
                    $.each(data.position, function(key, item) {
                        $('#b-posTable').append(
                            '<tr>\
                                                                                        <td>' +
                            i +
                            '</td>\
                                                                        <td>' +
                            item
                            .position_name +
                            '</td>\
                                                                            <td>\
                                                                        <button class="btn btn-sm btn-warning bi bi-pencil"\ id="btn-position-edit"data-id = "' +
                            item
                            .position_id +
                            '"></button>\
                                                                        <button class="btn btn-sm btn-danger bi bi-trash"\ id="btn-position-remove"></button>\
                                                                                    </td>\
                                                                                </tr>\
                                                                                '
                        );

                        i++;
                    });
                },


            });
        }
    </script>
@endsection
