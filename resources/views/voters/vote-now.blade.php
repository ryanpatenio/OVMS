@extends('layouts.home-temp')

@section('content')
    <!-- Page Content-->
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="text-center mb-5">
                <h1 class="fw-bolder">Vote Now!</h1>
                <p class="lead fw-normal text-muted mb-0">You can now participates or Vote your favorite Candidates!</p>
            </div>
            <div class="row gx-5">
                <div class="col-xl-8">
                    <!-- FAQ Accordion 1-->
                    <h2 class="fw-bolder mb-3">Select Your Candidates!</h2>
                    <div class="accordion mb-5" id="accordionExample">
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingOne"><button class="accordion-button " type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">CEO Position </button></h3>
                            <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">

                                    <div class="col-xxl-12 col-md-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row mb-2 align-items-center justify-content-center">
                                                            <img src="{{ URL::asset('assets/img/messages-3.jpg') }}"
                                                                alt="Profile" class="rounded-circle w-50 mb-2">
                                                            <strong>Ryan Wong</strong>
                                                            <p class="pt-2">Lorem ipsum dolor sit amet consectetur
                                                                adipisicing
                                                                elit. Optio,
                                                                aliquid?</p>
                                                            <div class="row mb-2">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="inlineRadioOptions" id="inlineRadio1"
                                                                        value="option1">
                                                                    <label class="form-check-label" for="inlineRadio1">Vote
                                                                        Ryan Wong</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row mb-2 align-items-center justify-content-center">
                                                            <img src="{{ URL::asset('assets/img/messages-3.jpg') }}"
                                                                alt="Profile" class="rounded-circle w-50 mb-2">
                                                            <strong>Henry Sy</strong>
                                                            <p class="pt-2">Lorem ipsum dolor sit amet consectetur
                                                                adipisicing
                                                                elit. Optio,
                                                                aliquid?</p>
                                                            <div class="row mb-2">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="inlineRadioOptions" id="inlineRadio1"
                                                                        value="option1">
                                                                    <label class="form-check-label" for="inlineRadio1">Vote
                                                                        Henry Sy</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingTwo"><button class="accordion-button collapsed"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">Vice CEO Position</button></h3>
                            <div class="accordion-collapse collapse" id="collapseTwo" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="col-xxl-12 col-md-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row mb-2 align-items-center justify-content-center">
                                                            <img src="{{ URL::asset('assets/img/messages-3.jpg') }}"
                                                                alt="Profile" class="rounded-circle w-50 mb-2">
                                                            <strong>Ryan Wong</strong>
                                                            <p class="pt-2">Lorem ipsum dolor sit amet consectetur
                                                                adipisicing
                                                                elit. Optio,
                                                                aliquid?</p>
                                                            <div class="row mb-2">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="inlineRadioOptions2" id="inlineRadio2"
                                                                        value="option2">
                                                                    <label class="form-check-label" for="inlineRadio1">Vote
                                                                        Ryan Wong</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row mb-2 align-items-center justify-content-center">
                                                            <img src="{{ URL::asset('assets/img/messages-3.jpg') }}"
                                                                alt="Profile" class="rounded-circle w-50 mb-2">
                                                            <strong>Henry Sy</strong>
                                                            <p class="pt-2">Lorem ipsum dolor sit amet consectetur
                                                                adipisicing
                                                                elit. Optio,
                                                                aliquid?</p>
                                                            <div class="row mb-2">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="inlineRadioOptions2" id="inlineRadio2"
                                                                        value="option2">
                                                                    <label class="form-check-label"
                                                                        for="inlineRadio1">Vote
                                                                        Henry Sy</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingThree"><button class="accordion-button collapsed"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree">Administrative Position</button>
                            </h3>
                            <div class="accordion-collapse collapse" id="collapseThree" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="col-xxl-12 col-md-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row mb-2 align-items-center justify-content-center">
                                                            <img src="{{ URL::asset('assets/img/messages-3.jpg') }}"
                                                                alt="Profile" class="rounded-circle w-50 mb-2">
                                                            <strong>Ryan Wong</strong>
                                                            <p class="pt-2">Lorem ipsum dolor sit amet consectetur
                                                                adipisicing
                                                                elit. Optio,
                                                                aliquid?</p>
                                                            <div class="row mb-2">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="inlineRadioOptions3" id="inlineRadio3"
                                                                        value="option3">
                                                                    <label class="form-check-label"
                                                                        for="inlineRadio1">Vote
                                                                        Ryan Wong</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row mb-2 align-items-center justify-content-center">
                                                            <img src="{{ URL::asset('assets/img/messages-3.jpg') }}"
                                                                alt="Profile" class="rounded-circle w-50 mb-2">
                                                            <strong>Henry Sy</strong>
                                                            <p class="pt-2">Lorem ipsum dolor sit amet consectetur
                                                                adipisicing
                                                                elit. Optio,
                                                                aliquid?</p>
                                                            <div class="row mb-2">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="inlineRadioOptions3" id="inlineRadio3"
                                                                        value="option3">
                                                                    <label class="form-check-label"
                                                                        for="inlineRadio1">Vote
                                                                        Henry Sy</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
        </div>
    </section>
@endsection
