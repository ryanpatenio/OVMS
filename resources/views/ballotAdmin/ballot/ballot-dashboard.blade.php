@extends('layouts.ballot-admin')
@section('content')
    <div class="pagetitle">
        <h1>Ballot Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ballot.index') }}">Home Dashboard</a></li>
                <li class="breadcrumb-item active">Ballot Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            <a href="{{ route('addBallotPage') }}" class="btn btn-sm btn-primary" type="button"><i class="bi bi-plus-circle">
                    New</i></a>

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
                        @php
                            $i = 1;
                        @endphp
                        @forelse ($ballots as $ballot)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $ballot->ballot_name }}</td>
                                <td>{{ $ballot->details }}</td>


                                <td>
                                    <a href="{{ route('edit.ballot', $ballot->ballot_id) }}" type="button"
                                        class="btn btn-warning btn-sm bi bi-pencil" id="edit_cust_btn" data-id="">
                                    </a>
                                    <a href="/view-ballot" type="button" class="btn btn-primary btn-sm bi bi-search"></a>
                                    <a href="#" type="button" class="btn btn-sm btn-danger bi bi-trash"
                                        id="del_btn" data-id="{{ $ballot->ballot_id }}"></a>
                                    <a href="#"type="button" class="btn btn-sm btn-success bi bi-check">publish</a>

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
    @endsection

    @section('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('click', '#del_btn', function(e) {
                    e.preventDefault();

                    let ID = $(this).attr('data-id');

                    swal({
                        title: "Are you sure you want to Delete this Ballot?",
                        text: 'When you delete This, All of its Records Will be deleted Also!',
                        icon: "error",
                        buttons: [true, "Yes"],
                        dangerMode: true,
                    }).then((willconfirmed) => {
                        if (willconfirmed) {
                            $.ajax({
                                url: '{{ route('delete.ballot') }}',
                                method: 'post',
                                data: {
                                    ID: ID
                                },
                                dataType: 'json',

                                success: function(resp) {
                                    //console.log(resp)
                                    if (resp.message == 'success') {
                                        message('Ballot Deleted Successfully!', 'success');
                                    }
                                    if (resp.message == 'error_deleting') {
                                        msg('Oops! Unexpected Error!', 'error');
                                    }
                                    if (resp.message == 'error_find') {
                                        msg('Oops! Unexpected Error! Data Not Found!',
                                            'error');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.log(xhr.responseText)
                                }

                            });
                        }
                    });

                })

            });
        </script>
    @endsection
