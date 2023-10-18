@extends('layouts.ballot-admin')


@section('content')
    <div class="pagetitle">
        <h1>Create New Voters</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('voters.index') }}">Voters Dashboard</a></li>
                <li class="breadcrumb-item active">Create New Voters</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">

                <form id="addVotersForm" method="POST">
                    @csrf
                    <div class="card">
                        <div id="validation-errors" class="alert alert-danger d-none">

                            <ul id="error-ds" class="text-danger">

                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Voters Name</h5>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="Voters Name">Voters Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Voters Name..."
                                        required>

                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                    <span class="text-danger" id="err_email"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="contact">Contact|Phone</label>
                                    <input type="text" name="contact" class="form-control" placeholder="+63" required>
                                    <span class="text-danger" id="err_contact"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="pass">Default Temporary Password (@user123)</label>
                                    <input class="form-control" id="password" type="password" placeholder="Password"
                                        name="password" value="@user123" readonly required>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col">
                                    <label for="pass">Select Ballots</label>
                                    <select name="ballot_id" id="" class="form-select" required>
                                        <option value="" id="hidden-ballot-id">--Select--</option>

                                        @forelse ($ballots as $ballot)
                                            <option value="{{ $ballot->ballot_id }}">{{ $ballot->ballot_name }}</option>
                                        @empty
                                            <p>No Data Found!...</p>
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Search Existing Candidates</h5>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="Ballot Name">Candidates Name</label>
                                <input type="text" id="search_id"class="form-control" value=""
                                    placeholder="Candidate name">
                                <div class="mt-0">
                                    <p id="loading"></p>
                                    <select name="list" id="list" class="form-select d-none"
                                        style="cursor: pointer">


                                    </select>
                                    <p id="error-res"></p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary btn-md" value="Add">
                </div>
            </div>
        </div>
        </form>

    </section>

    <section class="add-Candidates-Modal">

        <div class="modal fade modal-md" id="addCandidateModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add This Candidates as Voters</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div id="validation" class="alert alert-danger d-none">

                                <ul id="error" class="text-danger">

                                </ul>
                            </div>
                            <form id="addModalForm">
                                @csrf
                                <input type="hidden" name="ballot_id" value="" id="ballot_id">
                                <input type="hidden" name="candidate_id" value="" id="candidate_id">


                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <label for="candidates edit name">Voters Name</label>
                                                <input type="text" class="form-control" name="candidate_name"
                                                    id="candidate_name" placeholder="Candidates Name..." required
                                                    readonly>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="Voters Edit Email">Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="Email..." required>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="Voters Edit name">Default Temporary Password (@user123)</label>
                                                <input type="password" name="password" class="form-control bi"
                                                    value="@user123" required readonly>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="Voters Edit name">Contact|Phone</label>
                                                <input type="text" name="contact" maxlength="11"
                                                    class="form-control bi" required placeholder="+63">
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


    </section>
@endsection

@section('scripts')
    {{-- import jquery dbounce to throttle delay when sending request to the server.. --}}
    <script src="http://benalman.com/code/projects/jquery-throttle-debounce/jquery.ba-throttle-debounce.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('submit', '#addVotersForm', function(e) {
                e.preventDefault();
                $('#error-ds').empty();
                $.ajax({
                    url: '{{ route('voter.store') }}',
                    method: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',

                    success: function(resp) {
                        $('#validation-errors').addClass('d-none');
                        //console.log(resp)
                        if (resp.message == 'success') {
                            msgRedirect('New Voters added Successfully!', 'success',
                                '{{ route('voters.index') }}');
                        }
                        if (resp.message == 'process_error[2]') {
                            msg('Oops! Unexpected Error!', 'error');
                        }
                        if (resp.message == 'process_error') {
                            msg('Oops! Unexpected error!', 'error');
                        }

                    },

                    error: function(xhr, status, errors) {
                        //console.log(xhr.responseText)
                        $('#validation-errors').removeClass('d-none');
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#error-ds').append(
                                '<li>' + value +
                                '</li>'

                            );

                        });


                    }

                });

            });

            $('#search_id').on('input', $.debounce(200, function(e) {
                e.preventDefault();
                //remove white space and the display list make sure its empty
                let name = $(this).val().trim();
                $('#list').empty();

                if ($(this).val().trim() == '') {
                    //console.log('null')
                    //make sure its empty and the display list must be hidden
                    $('#error-res').text('');
                    $('#list').empty();
                    $('#list').addClass('d-none');
                    $('#search_id').val('');
                } else {
                    $.ajax({
                        url: '{{ route('search.input') }}',
                        method: 'post',
                        data: {
                            name: name
                        },
                        cache: false,
                        dataType: 'json',

                        beforeSend: function() {
                            $('#loading').html('Searching...').css('color', 'green');
                        },
                        success: function(res) {
                            // console.log(res)
                            //empty display list before display data
                            $('#list').html('');
                            $('#error-res').text('');

                            //checks if the data(array) is not null
                            if (res.data != 0) {
                                //then remove the class d-none to display the list unhidden
                                $('#list').removeClass('d-none');
                                $('#list').append('  <option value="">--Select--</option>');
                                $.each(res.data, function(key, value) {
                                    $('#list').append(
                                        '<option value="' + value.candidate_id +
                                        '">' +
                                        value.candidate_name + '</option>'
                                    )
                                });
                            } else {
                                //if null will display in <p> tags No results</p>
                                //and add class d-none to display hidden
                                $('#error-res').text('No result(s) found!');
                                $('#list').addClass('d-none');
                            }

                        },
                        complete: function() {
                            //coordinate in the beforeSendFunction after it finish request the loading message will disappear
                            $('#loading').html('');

                        },
                        error: function(xhr, status, error) {
                            //catch errors in display in the console
                            console.log(xhr.responseText)
                        }

                    })

                }



            }));

            $('#list').on('change', $.debounce(300, function(e) {
                e.preventDefault();

                //empty modal form
                $('#addModalForm')[0].reset();

                if (!$(this).val() == '') {
                    let id = $(this).val();
                    $.ajax({
                        url: '{{ route('find.candidates') }}',
                        method: 'POST',
                        data: {
                            candidate_id: id
                        },
                        dataType: 'json',

                        success: function(resp) {
                            //console.log(resp);
                            if (resp != 0) {
                                $('#ballot_id').val(resp.data.ballot_id)
                                $('#candidate_id').val(resp.data.candidate_id)
                                $('#candidate_name').val(resp.data.candidate_name)
                                $('#addCandidateModal').modal('show');
                            } else {
                                msg('The Selected Candidate is already added!', 'error');
                            }
                        },

                        error: function(xhr, status, error) {
                            console.log(xhr.responseText)
                        }
                    });
                }
            }));

            $(document).on('submit', '#addModalForm', function(e) {
                e.preventDefault();
                $('#error').empty();
                $.ajax({
                    url: '{{ route('add.candidate.to.voter') }}',
                    method: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',

                    success: function(resp) {
                        //console.log(resp)
                        $('#validation').addClass('d-none');
                        $('#addModalForm').modal('hide');
                        if (resp.message == 'success') {
                            msgRedirect('Candidate Successfully added as Voters', 'success',
                                '{{ route('voters.index') }}');

                        }
                    },

                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        $('#validation').removeClass('d-none');
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#error').append(
                                '<li>' + value +
                                '</li>'

                            );

                        });
                    }


                });



            });

        });
    </script>
@endsection
