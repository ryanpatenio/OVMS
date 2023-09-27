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
                                    <a href="#" type="button" data-bs-toggle="modal"
                                        data-bs-target="#UpdatePartyModal" class="btn btn-warning bi bi-pencil btn-sm"
                                        id="editParty" data-id="">
                                        Modify</a>
                                    <a href="{{ route('view.party') }}" type="button"
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
                        <form>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <label for="candidates name">Party Name</label>
                                            <input type="text" class="form-control" placeholder="Candidates Name..."
                                                required value="Ryan Wong">
                                        </div>
                                        <div class="row mb-2">
                                            <label for="candidates name">Ballot Name</label>
                                            <select name="ballotsName" id="" class="form-select">
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
                })


            });

            const clearError = () => {
                $('#err_party_name').text('');
            }
        </script>
    @endsection
