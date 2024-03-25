@extends('layouts.home-temp')

@section('content')
    <!-- Page content-->
    <section class="py-5">
        <div class="container px-5">
            <!-- Contact form-->
            <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                <div class="text-center mb-5">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-pencil-square"></i>
                    </div>
                    <h1 class="fw-bolder">Sign Up!</h1>
                    <p class="lead fw-normal text-muted mb-0"></p>
                </div>
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6">

                        <form method="POST" action="{{ route('register') }}" onsubmit="showLoadx()">
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" type="text" placeholder="Enter your name..."
                                    data-sb-validations="required" value="{{ old('name') }}" />
                                <label for="name">Full name</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control @error('email') is-invalid @enderror" id="email"
                                    type="email" name="email" placeholder="name@example.com" value="{{ old('email') }}"
                                    data-sb-validations="required,email" />
                                <label for="email">Email address</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control @error('contact') is-invalid @enderror" id="phone"
                                    type="tel" name="contact" placeholder="(123) 456-7890" value="{{ old('contact') }}"
                                    data-sb-validations="required" />
                                <label for="phone">Phone number</label>

                                @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control @error('password') is-invalid @enderror" id="password"
                                    type="password" placeholder="Password" data-sb-validations="required" name="password" />
                                <label for="password">Password</label>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control @error('password') is-invalid @enderror" id="password-confirm"
                                    type="password" placeholder="Password" data-sb-validations="required"
                                    name="password_confirmation" />
                                <label for="password-confirm">Confirm Password</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Submit Button-->
                            <div class="d-grid"><button class="btn btn-primary btn-lg" id="submitButton"
                                    type="submit">{{ __('Register') }}!</button></div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <script>
        $(document).ready(function() {



            $(document).on('change', '#voters-type', function(e) {
                e.preventDefault();

                let votersType = $(this).val();
                let passCodeDiv = $('#passCodeDiv');
                // let psCode = $('#passCode');

                // let crs = randomStr(8);

                if (votersType == '2') {
                    //voters
                    $(passCodeDiv).removeClass('d-none');
                    // psCode.val(crs);
                } else {
                    //creators
                    //  psCode.val('');
                    $(passCodeDiv).addClass('d-none');
                }

            });


            $(document).on('submit', '#regForm', function(e) {
                e.preventDefault();




                let whatType = $('#voters-type').val();

                if (whatType == '1') {

                    //alert(urltoReg)
                } else if (whatType == '2') {
                    alert(urlToVoters);
                } else {
                    alert('Opps Something went wrong!');
                }

            });

        });

        function randomStr(len) {
            var text = "";

            var charset = "abcdefghijklmnopqrstuvwxyz0123456789";
            var date = new Date();
            var ltf = date.getMonth() + 1 + '' + date.getYear() + date.getHours();

            for (var i = 0; i < len; i++)
                text += charset.charAt(Math.floor(Math.random() * charset.length));

            return text + ltf;
        }
    </script>
@endsection
