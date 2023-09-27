@extends('layouts.ballot-admin')
@section('content')
    <div class="pagetitle">
        <h1>View Ballot</h1>
        <nav>
            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="/{{ route('MyBallots.index') }}">Ballot Dashboard</a></li>
                <li class="breadcrumb-item active">View Ballot</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Ballot Card -->
    <div class="col-xxl-12 col-md-6">

        <div class="card info-card sales-card">


            <div class="card-body">
                <h5 class="card-title text-center">SUN's Company Election <span></span></h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                    </div>
                    <div class="ps-3">

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum saepe fugiat quisquam aut
                            repellat autem quis nesciunt recusandae delectus laboriosam?</p>

                    </div>
                </div>
            </div>

        </div>

    </div><!-- End Created Ballot Card -->

    <!-- Bar Chart-->
    <div class="col-lg-10">
        <div class="row">
            <!-- Bar Chart for Highest Position-->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">CEO Position</h5>

                        <!-- Bar Chart -->
                        <div id="barChart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#barChart"), {
                                    series: [{
                                        data: [400, 430]
                                    }],
                                    chart: {
                                        type: 'bar',
                                        height: 125
                                    },
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 20,
                                            horizontal: true,
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    xaxis: {
                                        categories: ['Ryan Wong', 'Mike Tan', ],
                                    }
                                }).render();
                            });
                        </script>
                        <!-- End Bar Chart -->

                    </div>
                </div>
            </div>

            <!-- Bar Chart-->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Vice CEO Position</h5>

                        <!-- Bar Chart -->
                        <div id="barChart2"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#barChart2"), {
                                    series: [{
                                        data: [200, 500]
                                    }],
                                    chart: {
                                        type: 'bar',
                                        height: 125
                                    },
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 20,
                                            horizontal: true,
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    xaxis: {
                                        categories: ['James Kratus', 'Henry Psy', ],
                                    }
                                }).render();
                            });
                        </script>
                        <!-- End Bar Chart -->

                    </div>
                </div>
            </div>
            <!-- Bar Chart-->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Administrative Position</h5>

                        <!-- Bar Chart -->
                        <div id="barChart3"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#barChart3"), {
                                    series: [{
                                        data: [200, 300, 400, 500]
                                    }],
                                    chart: {
                                        type: 'bar',
                                        height: 200
                                    },
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 20,
                                            horizontal: true,
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    xaxis: {
                                        categories: ['Henry Bigman', 'Dwayne Johnson', 'Osama Ben Lhadin', 'Bill Gates'],
                                    }
                                }).render();
                            });
                        </script>
                        <!-- End Bar Chart -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <input type="submit" class="btn btn-primary btn-md" value="Publish Results">
        </div>
    </div>
@endsection
