@extends('layouts.home-temp')

@section('content')
    <!-- Page content-->
    <section class="py-5">
        <div class="container px-5">
            <!-- Contact form-->
            <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                <div class="text-center mb-5">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-lock-fill"></i>
                    </div>
                    <h1 class="fw-bolder">Login</h1>
                    <p class="lead fw-normal text-muted mb-0"></p>
                </div>
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6">

                        {{-- <form id="contactForm" data-sb-form-api-token="API_TOKEN"> --}}
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- UserName input-->
                            <div class="form-floating mb-3">
                                <input class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" type="email" value="{{ old('email') }}" placeholder="" required
                                    autocomplete="email" autofocus />
                                <label for="username">Username</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Password input-->
                            <div class="form-floating mb-3">
                                <input class="form-control @error('password') is-invalid @enderror" id="password"
                                    type="password" placeholder="Enter your Password..." name="password" required
                                    autocomplete="current-password" />
                                <label for="username">Password</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-floating mb-3">

                            </div>
                            <!-- Submit Button-->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
