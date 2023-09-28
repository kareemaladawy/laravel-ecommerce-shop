@extends('site.app')
@section('title', __('Login'))
@section('content')
    <section class="section-content bg padding-y">
        <div class="container">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title text-center mt-2">{{ __('Login') }}</h4>
                    </header>
                    <article class="card-body">
                        <form action="{{ route('login') }}" method="POST" role="form">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" placeholder="email@example.com"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="Password" id="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="remember">{{ __('Remember me') }}</label>
                                <input type="checkbox" name="remember" value=true>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="loginButton"
                                    class="btn btn-dark btn-block">{{ __('Login') }}</button>
                            </div>
                            <div class="form-group">
                                <a class="btn btn-info btn-block" href="{{ route('socialite.auth', 'google') }}">
                                    {{ __('Or Login with Google') }}
                                </a>
                            </div>
                        </form>
                    </article>
                    <div class="border-top card-body text-center"><a
                            href="{{ route('register') }}">{{ __('Don\'t have an account? Register') }}</a></div>
                </div>
                <br>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        var input = document.getElementById("loginButton");

        input.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("loginButton").click();
            }
        });
    </script>
@endpush
