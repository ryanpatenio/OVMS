@extends('layouts.ballot-admin')


@section('content')
    <div class="pagetitle">
        <h1>Party Name : <strong
                style="font-style: italic; color:rgb(5, 168, 5)">{{ $getSelectedParty->party_name }}</strong>
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('party.index') }}">Party Dashboard</a></li>
                <li class="breadcrumb-item active">View Party</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            <button class="btn btn-sm btn-primary" id="addModalBtn" data-id="{{ $getSelectedParty->ballot_id }}"
                type="button"><i class="bi bi-plus-circle"> Add</i></button>

        </div>
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
                        @forelse ($PartyMembers as $Member)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $Member->candidate_name }}</td>
                                <td>{{ $Member->position_name }}</td>
                                <td>{{ $Member->ballot_name }}</td>

                                <td>

                                    <button id="removeBtn" data-id="{{ $Member->candidate_id }}"
                                        class="btn btn-danger btn-sm bi bi-trash">Remove</button>
                                    <a href="/view-candidates" type="button" class="btn btn-primary bi bi-search btn-sm">
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
        <div class="modal fade " id="addPartyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Candidates in The Party</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addCandidatesThisPartyForm" method="POST">

                            <input type="hidden" name="party_id" id="party_id" value="{{ $getSelectedParty->party_id }}">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row mb-2">
                                            <label for="candidates name"><strong>Ballot Name</strong></label>
                                            <select name="ballot_id" id="ballot_id" class="form-select">
                                                <option value="{{ $getSelectedParty->ballot_id }}">
                                                    {{ $getSelectedParty->ballot_name }}</option>

                                            </select>
                                        </div>
                                        <div class="row mb-2 mt-5">

                                            <table class="table table-light" id="dTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Candidates Name</th>
                                                        <th>Position</th>

                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="tbl-display">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
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
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $('#addModalBtn').on('click', function(e) {
                    e.preventDefault();
                    let i = 1;
                    let ID = $(this).attr('data-id')

                    $.ajax({
                        url: '{{ route('get.partyList') }}',
                        method: 'POST',
                        data: {
                            ballot_ID: ID
                        },

                        success: function(resp) {
                            //console.log(resp)
                            $('#tbl-display').html("");
                            $.each(resp.dataCandidates, function(key, item) {
                                $('#tbl-display').append(
                                    '<tr> <td>' +
                                    i +
                                    '</td><td>' + item.candidate_name +
                                    '</td><td>' + item.position_name +
                                    '</td><td><div class="form-check form-switch"><input class="form-check-input candidate_input_check" name"candidate_id[]" value="' +
                                    item.candidate_id +
                                    '"type="checkbox" id="flexSwitchCheckDefault"></div></td> </tr>'
                                );

                                i++;
                            });

                            $('#addPartyModal').modal('show');
                            new DataTable('#dTable');
                        },
                        error: function(xhr, status) {
                            console.log(xhr.responseText)
                        }

                    });

                });

                $(document).on('submit', '#addCandidatesThisPartyForm', function(e) {
                    e.preventDefault();

                    let candidate_id = [];
                    let party_id = $('#party_id').val();

                    $('.candidate_input_check:checked').each(function() {
                        candidate_id.push($(this).val())
                    });

                    if (candidate_id.length > 0) {
                        //has Data
                        $.ajax({
                            url: '{{ route('store.candidatesToParty') }}',
                            method: 'POST',
                            data: {
                                party_id: party_id,
                                candidate_id: candidate_id
                            },
                            dataType: 'json',

                            success: function(resp) {
                                resetModalForm();
                                //console.log(resp)
                                if (resp.message == 'success') {
                                    message('Selected Candidate(s) Added to Party Successfully!',
                                        'success');
                                }
                            },
                            error: function(xhr, status) {
                                resetModalForm();
                                // console.log(xhr.responseText)
                                let err = JSON.parse(xhr.responseText)
                                if (err.message == 'processing_error') {
                                    msg('Opps! Unexpected Error! Request Failed!', 'error');
                                }
                            }

                        });
                    } else {
                        //No Data

                        msg('Please Select atleast One check Box!', 'info');
                    }



                });

                $(document).on('click', '#removeBtn', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('data-id');

                    $.ajax({
                        url: '{{ route('remove.candidate') }}',
                        method: 'POST',
                        data: {
                            candidate_id: id
                        },
                        datType: 'json',

                        success: function(resp) {
                            console.log(resp)
                        },

                        error: function(xhr, status) {
                            console.log(xhr.responseText)
                        }

                    });

                });

                //for searching
                // $('#search').on("keyup", function() {
                //     var value = $(this).val().toLowerCase();
                //     console.clear();

                //     $('#dt_table tr').each(function(index) {
                //         if (index !== 0) {
                //             $row = $(this);
                //             $row.find("td").each(function(i, td) {
                //                 var id = $(td).text().toLowerCase();
                //                 //console.log(id+" | "+value+" | "+ id.indexOf(value))
                //                 if (id.indexOf(value) !== -1) {
                //                     $row.show();
                //                     return false;
                //                 } else {
                //                     $row.hide();

                //                 }

                //             });
                //         }

                //     });

                // });

            });

            const resetModalForm = () => {
                $('#addCandidatesThisPartyForm')[0].reset();
                $('#addPartyModal').modal('hide');
            }
        </script>
    @endsection
