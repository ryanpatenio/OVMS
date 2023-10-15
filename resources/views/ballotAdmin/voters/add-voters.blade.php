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
                if (!$(this).val() == '') {
                    alert('selected');
                }
            }));

        });
    </script>
@endsection
