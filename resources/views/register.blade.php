@extends('layouts.shop')

@section('title', 'Register')
@section('content')
    <!-- Register Section -->
    <section id="register" class="register section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="registration-form-wrapper">
                        <div class="form-header text-center">
                            <h2>Create Your Account</h2>
                            <p>Create your account and start shopping with us</p>
                        </div>

                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <form action="{{ route('user.register.post') }}" method="post">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="fullName" name="name"
                                            placeholder="Full Name" required="" autocomplete="name">
                                        <label for="fullName">Full Name</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email Address" required="" autocomplete="email">
                                        <label for="email">Email Address</label>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="password" class="form-control" id="password" name="password"
                                                    placeholder="Password" required="" minlength="8"
                                                    autocomplete="new-password">
                                                <label for="password">Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="password" class="form-control" id="confirmPassword"
                                                    name="password_confirmation" placeholder="Confirm Password" required=""
                                                    minlength="8" autocomplete="new-password">
                                                <label for="confirmPassword">Confirm Password</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" id="termsCheck" name="termsCheck"
                                            required="">
                                        <label class="form-check-label" for="termsCheck">
                                            I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy
                                                Policy</a>
                                        </label>
                                    </div>

                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" id="marketingCheck"
                                            name="marketingCheck">
                                        <label class="form-check-label" for="marketingCheck">
                                            I would like to receive marketing communications about products, services, and
                                            promotions
                                        </label>
                                    </div>

                                    <div class="d-grid mb-4">
                                        <button type="submit" class="btn btn-register">Create Account</button>
                                    </div>

                                    <div class="login-link text-center">
                                        <p>Already have an account? <a href="{{ route('user.login') }}">Sign in</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="decorative-elements">
                            <div class="circle circle-1"></div>
                            <div class="circle circle-2"></div>
                            <div class="circle circle-3"></div>
                            <div class="square square-1"></div>
                            <div class="square square-2"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Register Section -->
@endsection