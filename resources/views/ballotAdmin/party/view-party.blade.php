@extends('layouts.ballot-admin')

@section('content')
    <div class="pagetitle">
        <h1>Red Ribbon Party</h1>
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
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addPartyModal" type="button"><i
                    class="bi bi-plus-circle"> Add</i></button>
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


                        <tr>
                            <td>1</td>
                            <td>Roy</td>
                            <td>Running For CEO</td>
                            <td>Suns Company Election</td>

                            <td>

                                <button class="btn btn-danger btn-sm bi bi-trash">Remove</button>
                                <a href="/view-candidates" type="button" class="btn btn-primary bi bi-search btn-sm">
                                    View</a>
                            </td>
                        </tr>

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
                        <h5 class="modal-title" id="exampleModalLabel">Add New Candidates in Party</h5>
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
                                            <label for="candidates name"><strong>Ballot Name</strong></label>
                                            <select name="ballotsName" id="" class="form-select">
                                                <option value="">Sun's Company</option>

                                            </select>
                                        </div>
                                        <div class="row mb-2 mt-5">
                                            <table class="table datatable table-light" id="dataTable" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Candidates Name</th>
                                                        <th>Position</th>

                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>


                                                    <tr>
                                                        <td>1</td>
                                                        <td>Roy</td>
                                                        <td>Running For CEO</td>


                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="flexSwitchCheckDefault">
                                                            </div>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Add</button>
                    </div>
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
