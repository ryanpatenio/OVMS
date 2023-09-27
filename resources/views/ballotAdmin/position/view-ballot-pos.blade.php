@extends('layouts.ballot-admin')
@section('content')
    <div class="pagetitle">
        <h1>Add Position</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('position.index') }}">Position Dashboard</a></li>

                <li class="breadcrumb-item active">Position Dashboard</li>
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
                            <div class="col">
                                <label for="Ballot Name">Ballot Name</label>
                                <input type="text" class="form-control" value="{{ $ballot->ballot_name }}"
                                    placeholder="Ballot Name..." readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="Ballot Name">Short Description</label>
                                <textarea class="form-control" id="" cols="20" rows="5" readonly>
                                   {{ $ballot->details }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Position</h5>

                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addPositionModal"
                            type="button"><i class="bi bi-plus-circle"> New</i></button>

                        <div class="table-responsive">
                            <table class="table table-light" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Position Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="posTable">


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ballot Key</h5>
                        <div
                            class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">


                            <div class="ms-xl-4">
                                <div class="input-group mb-2">
                                    <input type="text" value="{{ $ballot->ballot_key }}" id="key-code"
                                        class="form-control"@readonly(true)>
                                    <input class="btn btn-sm btn-primary" id="button-copy" type="button"
                                        onclick="CopyToClipboard('key-code','button-copy')";return false; value="Copy">
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>


        </div>

        <section>
            <!--Modal-->
            <div class="modal fade" id="addPositionModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Position</h5>
                            <button type="button" class="close" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('add.position') }}" method="POST" id="addPositionForm">
                                @csrf
                                {{-- <input type="hidden" name="_method" value="PATCH"> --}}
                                <input type="hidden" id="ballot_id" name="ballot_id" value="{{ $ballot->ballot_id }}">
                                <div class="row">
                                    <div class="col">
                                        <label for="Position">Position</label>
                                        <input type="text" class="form-control" name="position_name" id="position_name"
                                            value="" placeholder="Position..." required>
                                        <span class="text-danger mt-2" id="pos_err_text"></span>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="addPosBtn" class="btn btn-primary">Add</button>
                        </div>
                        </form>
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
                            <button type="button" class="close" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
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

        <script></script>
    @endsection
    @section('scripts')
        <script>
            const ballotID = $('#ballot_id').val();
            $(document).ready(function() {

                $('#addPositionForm').on('submit', function(e) {
                    e.preventDefault();

                    let err_pos_text = $('#pos_err_text');
                    let pos_input_field = $('#position_name');
                    let url = $(this).attr('action');
                    let form = $(this).serialize();

                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: form,
                        DataType: 'json',

                        success: function(resp) {
                            //console.log(resp)
                            $('#addPositionForm')[0].reset();
                            $('#addPositionModal').modal('hide');
                            showPostionDataTables(ballotID);
                            if (resp.status == 'success') {
                                msg('New Position Added Successfully!', 'success');
                            }
                            if (resp.status == 'error') {
                                msg('Oops! an error Occured!', 'error');
                            }

                        },
                        error: function(xhr, status) {
                            //console.log(xhr.responseText);
                            let err = JSON.parse(xhr.responseText);

                            if (err.message == 'pos_unique_err') {
                                err_pos_text.text('This Position is already Exist!').fadeTo(3000,
                                        500)
                                    .slideUp(500);
                                pos_input_field.focus();

                            }
                        },

                    });

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
                        console.log(resp);
                        $('#editPositionModal').modal('hide');
                        showPostionDataTables(ballotID);
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

            showPostionDataTables(ballotID);

            function showPostionDataTables(ID) {
                let i = 1;
                $.ajax({
                    url: "/ballotAdmin/getPositionData/" + ID,
                    method: "GET",
                    dataType: 'json',

                    success: function(data) {
                        $('tbody').html("");
                        $.each(data.position, function(key, item) {
                            $('tbody').append(
                                '<tr> <td>' +
                                i +
                                '</td><td>' + item.position_name +
                                '</td><td><button class="btn btn-sm btn-warning bi bi-pencil" id="btn-position-edit"data-id = "' +
                                item.position_id +
                                '"></button><button class="btn btn-sm btn-danger bi bi-trash" id="btn-position-remove"></button></td> </tr>'
                            );

                            i++;
                        });
                    },


                });
            }
        </script>
    @endsection
