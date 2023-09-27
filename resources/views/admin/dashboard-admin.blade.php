@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Admin Dashboard</h1>
        <nav>
            <ol class="breadcrumb">


            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Ballot Card -->
                    <div class="col-xxl-6 col-md-6">
                        <a href="/super-admin-ballot">
                            <div class="card info-card sales-card">


                                <div class="card-body">
                                    <h5 class="card-title">Created Ballot <span></span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-menu-button-wide"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>5</h6>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div><!-- End Created Ballot Card -->

                    <!-- Participants Card -->
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card revenue-card">
                            <a href="/super-admin-voters-approved">

                                <div class="card-body">
                                    <h5 class="card-title">Voters <span></span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>200</h6>


                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div><!-- End Participants Card -->

                    <!-- Ballot Creator Card -->
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card revenue-card">
                            <a href="/super-admin-ballot-creator">

                                <div class="card-body">
                                    <h5 class="card-title">Ballot Creator</h5><span></span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>200</h6>


                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div><!-- End Ballot Creator Card -->

                    <!-- USERS Card -->
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card revenue-card">
                            <a href="/super-admin-users">

                                <div class="card-body">
                                    <h5 class="card-title">Users<span></span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>3</h6>


                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div><!-- End Users Card -->

                    <div class="col-12">
                        <div class="card-body pb-0">

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Ballot Creator Chart</h5>

                                        <!-- Line Chart -->
                                        <div id="lineChart"></div>

                                        <script>
                                            document.addEventListener("DOMContentLoaded", () => {
                                                new ApexCharts(document.querySelector("#lineChart"), {
                                                    series: [{
                                                        name: "Ballot Creator",
                                                        data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                                                    }],
                                                    chart: {
                                                        height: 350,
                                                        type: 'line',
                                                        zoom: {
                                                            enabled: false
                                                        }
                                                    },
                                                    dataLabels: {
                                                        enabled: false
                                                    },
                                                    stroke: {
                                                        curve: 'straight'
                                                    },
                                                    grid: {
                                                        row: {
                                                            colors: ['#f3f3f3',
                                                                'transparent'
                                                            ], // takes an array which will be repeated on columns
                                                            opacity: 0.5
                                                        },
                                                    },
                                                    xaxis: {
                                                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                                                    }
                                                }).render();
                                            });
                                        </script>
                                        <!-- End Line Chart -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Election Result -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

                            <div class="card-body pb-0">
                                <h5 class="card-title">Election Votes Tally Based on the Highest Position<span>|
                                        Ballot
                                        Name</span></h5>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Ballot Name</th>
                                            <th scope="col">Position</th>
                                            <th scope="col">%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><a href="#"><img
                                                        src="{{ URL::asset('assets/img/profile-img.jpg') }}"
                                                        alt=""></a>
                                            </th>
                                            <td><a href="#" class="text-primary fw-bold">Siobe Lim</a></td>
                                            <td>Janna's CEO
                                                election</td>
                                            <td class="fw-bold">CEO</td>
                                            <td>67%</td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Election Result -->

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Recent Activity -->
                <div class="card">


                    <div class="card-body">
                        <h5 class="card-title">Recent Activity <span></span></h5>

                        <div class="activity">

                            <div class="activity-item d-flex">
                                <div class="activite-label">32 min</div>
                                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                <div class="activity-content">
                                    Ryan wong are already Voted
                                </div>
                            </div><!-- End activity item-->
                        </div>

                    </div>
                </div><!-- End Recent Activity -->

            </div><!-- End Right side columns -->

        </div>
    </section>
@endsection
