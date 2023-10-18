@extends('layouts.home-temp')

@section('content')
    <!-- Header-->
    <header class=" py-5"
        style="background-image: url('https://www.saperessere.com/wp-content/uploads/2019/04/give_me_five.jpeg');background-repeat:no-repeat;background-size:cover;">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 text-center text-xl-start">
                        <h1 class="display-5 fw-bolder text-white mb-2">Welcome to the Online Voting Management System!</h1>
                        <p class="lead fw-normal text-white mb-4">your
                            gateway to modern, efficient, and secure election processes. This is all FREE!</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                            @guest


                                @if (Route::has('login'))
                                    <a class="btn btn-primary btn-lg px-4 me-sm-3" href="{{ route('register') }}">Sign Up
                                        Now!</a>
                                    <a class="btn btn-outline-light btn-lg px-4" href="#!">Learn More</a>
                                @endif
                            @else
                                @canany(['can-vote', 'candidate'])
                                    <a class="btn btn-primary btn-lg px-4 me-sm-3" href="{{ route('vote.now.page') }}">Vote Now!
                                    </a>
                                @endcanany


                            @endguest
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                </div>
            </div>
        </div>
    </header>

    <!-- Features section-->
    <section class="py-5" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h2 class="fw-bolder mb-0">How to Create Ballot?</h2>
                </div>
                <div class="col-lg-8">
                    <h2 class="mb-3">Follow the following</h2>
                    <div class="row gx-5 row-cols-1 row-cols-md-2">

                        <div class="col mb-5 h-100">

                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i
                                    class="bi bi-layout-text-sidebar"></i>
                            </div>
                            <h2 class="h5">Register First!</h2>
                            <p class="mb-0">If you are not registered yet just click the Sign Up! Button above!<br>or just
                                <a href="{{ route('register') }}">Click here to Sign Up!</a><br>then Choose your level of
                                involvement if you
                                are the Creator of the ballot or you are the Voters!
                            </p>
                        </div>
                        <div class="col mb-5 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i
                                    class="bi bi-plus-circle-dotted"></i>
                            </div>
                            <h2 class="h5">Create a ballot!</h2>
                            <p class="mb-0">After Registered just create a ballot form then fill up all the details in
                                field! </p>
                        </div>
                        <div class="col mb-5 mb-md-0 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i
                                    class="bi bi-gear-wide-connected"></i></div>
                            <h2 class="h5">Manage your Created ballot!</h2>
                            <p class="mb-0">You can add any candidates and position and you must generate a Pass Code for
                                your participants!.</p>
                        </div>

                    </div>
                </div>
            </div>
    </section>

    {{-- Voters Guide --}}
    <section class="py-5" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h2 class="fw-bolder mb-0">How to Vote?</h2>
                </div>
                <div class="col-lg-8">
                    <h2 class="mb-3">Follow the following</h2>
                    <div class="row gx-5 row-cols-1 row-cols-md-2">

                        <div class="col mb-5 h-100">

                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i
                                    class="bi bi-layout-text-sidebar"></i>
                            </div>
                            <h2 class="h5">First Login</h2>
                            <p class="mb-0">The Ballot Creator is the one who provide your username || Email! <br>If you
                                Can't log in Kindly reach your Team Leader or the one whos responsible created the Election

                            </p>
                        </div>
                        <div class="col mb-5 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-key"></i>
                            </div>
                            <h2 class="h5">After Login</h2>
                            <p class="mb-0">After you login you can visit the navigation Panel above. It will display all
                                the Candidates and you can also select your choice candidates!</p>
                        </div>
                        <div class="col mb-5 mb-md-0 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i
                                    class="bi bi-check-circle"></i></div>
                            <h2 class="h5">Select to Vote!</h2>
                            <p class="mb-0">Important Notice that think wisely before you choose your candidates. You only
                                have one chance to vote!</p>
                        </div>
                        <div class="col h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-send" viewBox="0 0 16 16">
                                    <path
                                        d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                                </svg>
                            </div>
                            <h2 class="h5">Submit your Vote!</h2>
                            <p class="mb-0">Note! once you submit your Vote it cannot be change anymore so that! before
                                your submit Just Review your Balot or your Choice!.<br>And wait for the Announcement of the
                                creator about the results of the election!<br>
                                The Creator Can't change any Votes! to avoid Bias!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial section-->
    {{-- <div class="py-5 bg-light">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-10 col-xl-7">
                    <div class="text-center">
                        <div class="fs-4 mb-4 fst-roman">"</div>
                        <div class="d-flex align-items-center justify-content-center">
                            <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d"
                                alt="..." />
                            <div class="fw-bold">
                                Tom Ato
                                <span class="fw-bold text-primary mx-1">/</span>
                                CEO, Pomodoro
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Blog preview section-->
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="text-center">
                        <h2 class="fw-bolder">An Online Voting System with your needs!</h2>
                        <p class="lead fw-normal text-muted mb-5">We are dedicated to providing a robust, user-friendly
                            platform that empowers
                            organizations, governments, and institutions to manage their voting processes seamlessly and
                            securely, ultimately strengthening the foundation of democracy.</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-2 mb-4">
                <h2 class="fw-bolder">What we offer?</h2>
            </div>
            <div class="row gx-5">
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top"
                            src="https://tse4.mm.bing.net/th?id=OIP.ZA0EDtB9oVe1Y182AHh6cQHaE8&pid=Api&P=0&h=220"
                            alt="..." />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Features!</div>
                            <a class="text-decoration-none link-dark stretched-link" href="#!">
                                <h5 class="card-title mb-3">Security!</h5>
                            </a>
                            <p class="card-text mb-0">A reliable Online Voting WebSite! We secure all the Data and Privacy
                                of
                                the user!</p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top"
                            src="https://media.istockphoto.com/photos/wave-of-coloured-lights-picture-id182197837?k=6&m=182197837&s=612x612&w=0&h=ZcTQCAKgyg5ukYOuW9CQLqJGDh6lfhBGFcx2KOAAoA4=
                            "
                            alt="..." />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Features!</div>
                            <a class="text-decoration-none link-dark stretched-link" href="#!">
                                <h5 class="card-title mb-3">Electronic Voting</h5>
                            </a>
                            <p class="card-text mb-0">A fast Phased Voting Website that you can get the result faster and
                                stays
                                protected from double Voting!</p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top"
                            src="https://www.westend61.de/images/0001186009pw/smiling-man-using-cell-phone-in-the-city-DIGF06980.jpg"
                            alt="..." />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Features!</div>
                            <a class="text-decoration-none link-dark stretched-link" href="#!">
                                <h5 class="card-title mb-3">Easy to Vote!
                                </h5>
                            </a>
                            <p class="card-text mb-0">The Voters can easily access the Web application and it is responsive
                                Web app that can use in any Android or Apple devices!.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Call to action-->
            <aside class="bg-primary bg-gradient rounded-3 p-4 p-sm-5 mt-5">
                <div
                    class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                    <div class="mb-4 mb-xl-0">
                        <div class="fs-3 fw-bold text-white">Reach Us!</div>
                        <div class="text-white-50">If you want to Message us!, You can direct Message or E-mail in our
                            Email
                            Address or Facebook Account!.</div>
                    </div>
                    <div class="ms-xl-4">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" id="myEmail" value="ryanpatenio06@gmail.com"
                                readonly>
                            <input class="btn btn-outline-light" id="button-copy" type="button"
                                onclick="CopyToClipboard('myEmail','button-copy');return false;" value="Copy">
                        </div>
                        <div class="small text-white-50">Here our Email and Also my Fb Account Name: <a
                                href="https://www.facebook.com/ryan.anderez" class="text-black">Ryan Anderez Patenio</a>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </section>
@endsection
