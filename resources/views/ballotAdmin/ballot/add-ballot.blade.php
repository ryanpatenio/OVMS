@extends('layouts.ballot-admin')

@section('content')
    <div class="pagetitle">
        <h1>Create New Ballot</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('MyBallots.index') }}">Ballot Dashboard</a></li>
                <li class="breadcrumb-item active">Create New Ballot</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">

                <form id="BallotForm" action="{{ route('store.ballot') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth::id() }}">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ballot Details</h5>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="Ballot Name">Ballot Name</label>
                                    <input type="text" name="ballot_name" class="form-control"
                                        placeholder="Ballot Name..." required>

                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="Ballot Name">Short Description</label>
                                    <textarea name="details" placeholder="Short description..." class="form-control" id="" cols="20"
                                        rows="5"></textarea>
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
                                <input type="text" id="ballotKey" name="ballot_key" class="form-control"required
                                    readonly>
                                <span class="text-danger" id="err_key"></span>

                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">

                                <input type="submit" id="genCode" class="btn btn-success btn-md " value="Generate Code">
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary btn-md" value="Save">
                </div>
            </div>
        </div>
        </form>

    </section>
    <script></script>
@endsection

@section('scripts')
    <script>
        $('#BallotForm').on('submit', function(e) {
            e.preventDefault();

            let form = $(this).serialize();
            let url = $(this).attr('action');
            let code = $('#ballotKey').val();

            if (code != '') {
                // $('#err_key').text('');
                $.ajax({
                    url: url,
                    method: 'post',
                    data: form,
                    dataType: 'json',

                    success: function(data) {
                        $('#BallotForm')[0].reset();
                        if (data.status == 'success') {
                            msg('Ballot added successfully! After Creating Ballot You must add Position',
                                'success');
                            setInterval(() => {
                                window.location = '{{ route('position.index') }}';
                            }, 5000);

                        }
                        if (data.status == 'error') {
                            message('Request Failed!', 'error');
                        }
                        //console.log(data);

                    },
                    error: function(xhr, error) {
                        console.log(xhr.responseText);
                    }

                });
            } else {
                $('#err_key').text('Ballot Code is required!');
            }


        });
    </script>
@endsection
