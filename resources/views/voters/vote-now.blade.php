@extends('layouts.home-temp')

@section('content')
    <!-- Page Content-->

    <style>
        .candidateBtn {
            cursor: pointer;
        }

        .btn-div {
            display: flex;
            align-items: center;
            margin-left: 40%;
            margin-bottom: 20px;
        }

        #btn-submit {

            border-radius: 5px;
            align-items: center;
        }
    </style>
    <section class="py-5">
        <div class="container px-5 my-5">



            @if ($checkVotersStatus == '1')
                {{-- already Voted --}}

                <div class="text-center mb-5">
                    <h1 class="fw-bolder">Your Vote is already been Submitted!</h1>
                    <p class="lead fw-normal text-muted mb-0">Pleas wait for the Results</p>
                </div>
            @else
                <div class="text-center mb-5">
                    <h1 class="fw-bolder">Vote Now!</h1>
                    <p class="lead fw-normal text-muted mb-0">You can now participates or Vote your favorite Candidates!</p>
                </div>

                <div class="row gx-5">
                    <div class="col-xl-8">
                        <!-- FAQ Accordion 1-->
                        <h2 class="fw-bolder mb-3">Select Your Candidates!</h2>
                        <div class="accordion mb-5" id="accordionExample">
                            <div class="accordion">

                                <form id="voteForm">


                                    @csrf
                                    @foreach ($allCandidates as $position => $candidates)
                                        <div class="accordion-item">
                                            <h3 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    {{ $position }}
                                                </button>
                                            </h3>
                                            <div class="accordion-collapse collapse show" id="collapseOne"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        @foreach ($candidates as $candidate)
                                                            <div class="col-lg-6 mb-3">
                                                                <div class="card">
                                                                    <div class="card-body">

                                                                        <img src="{{ URL::asset('assets/img/messages-3.jpg') }}"
                                                                            alt="Profile" class="rounded-circle w-50 mb-2">
                                                                        <div class="ms-3">
                                                                            <strong>{{ $candidate->candidate_name }}</strong>
                                                                            <p class="pt-2">Lorem ipsum dolor sit amet
                                                                                consectetur
                                                                                adipisicing elit. Optio,
                                                                                aliquid?</p>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input candidateBtn"
                                                                                    type="radio"
                                                                                    name="{{ $position }}[]"
                                                                                    id="candidate{{ $candidate->candidate_id }}"
                                                                                    value="{{ $candidate->candidate_id }}"
                                                                                    required>
                                                                                <label class="form-check-label"
                                                                                    for="candidate{{ $candidate->candidate_id }}">Select
                                                                                    Your Candidate</label>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                            </div>


                        </div>
                        <div class="btn-div">
                            <input type="submit" class="btn btn-md btn-primary" id="btn-submit" value="Submit">
                        </div>
                        </form>

                    </div>
                    <div class="col-xl-4">
                        <div class="card border-0 bg-light mt-xl-5">
                            <div class="card-body p-4 py-lg-5">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <div class="h6 fw-bolder">Have more questions?</div>
                                        <p class="text-muted mb-4">
                                            Contact us at
                                            <br />
                                            <a
                                                href="https://www.facebook.com/ryan.anderez">https://www.facebook.com/ryan.anderez</a>
                                        </p>
                                        <div class="h6 fw-bolder">Follow us</div>

                                        <a class="fs-5 px-2 link-dark" href="https://www.facebook.com/ryan.anderez"><i
                                                class="bi-facebook"></i></a>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-linkedin"></i></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $(document).on('submit', '#voteForm', function(e) {
                e.preventDefault();

                let candidate_id = [];
                $('#voteForm input[type=radio]:checked').each(function() {
                    candidate_id.push($(this).val());
                });


                $.ajax({
                    url: '{{ route('submit.votes') }}',
                    method: 'post',
                    data: {
                        candidate_id: candidate_id
                    },
                    dataType: 'json',

                    success: function(resp) {
                        //console.log(resp)
                        if (resp.message == 'success') {
                            message('Your Vote Submitted Successfully!', 'success');
                        }
                    },

                    error: function(xhr, status, error) {
                        let err = JSON.parse(xhr.responseText)
                        if (err.message == 'Error') {
                            msg('Opps! Unexpected Error! Request Failed!', 'error');
                        }
                    }

                });

            })

        });
    </script>
@endsection
