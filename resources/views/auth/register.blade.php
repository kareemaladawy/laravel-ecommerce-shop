@extends('site.app')
@section('title', 'Register')
@section('content')
    <section class="section-content bg padding-y">
        <div class="container">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title text-center mt-2">{{ __('Register') }}</h4>
                    </header>
                    <article class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="first_name">{{ __('First Name') }}</label><span class="required"
                                        style="color: red">
                                        * @error('first_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <input required type="text"
                                        class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                        value="{{ old('first_name') }}">
                                </div>
                                <div class="col form-group">
                                    <label for="last_name">{{ __('Last Name') }}</label><span class="required"
                                        style="color: red">
                                        * @error('last_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <input required type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('Email Address') }}</label><span class="required"
                                    style="color: red">
                                    * @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input required type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label for="phone_number">{{ __('Phone Number') }}</label><span class="required"
                                    style="color: red">
                                    * @error('phone_number')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input required type="text"
                                    class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                    value="{{ old('phone_number') }}">
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label><span class="required"
                                    style="color: red"> *
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <input required type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="city">{{ __('City') }}<span class="required"
                                        style="color: red">
                                        @error('city')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    </label>
                                    <input type="text" class="form-control" name="city" id="city"
                                        value="{{ old('city') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="country">{{ __('Country') }}<span class="required"
                                        style="color: red">
                                        @error('country')
                                            {{ $message }}
                                        @enderror
                                        </span>
                                    </label>
                                    <select id="country" class="form-control" name="country">
                                        <option selected></option>
                                        @foreach ($countries as $key => $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark btn-block">{{ __('Register') }}</button>
                            </div>
                            <div class="form-group">
                                <a class="btn btn-info btn-block" href="{{ route('socialite.auth', 'google') }}">
                                    {{ __('Or Login with Google') }}
                                </a>
                            </div>
                            <small class="text-muted">By clicking the 'Register' button, you confirm that you accept our
                                <br>
                                Terms of use and Privacy Policy.</small>
                        </form>
                    </article>

                    <div class="border-top card-body text-center">{{ __('Have an account?') }}
                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </section>
@endsection




{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- First Name -->
        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')"
                required autofocus />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('name')"
                required autofocus />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="city">City</label>
                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" />
            </div>
            <div class="form-group col-md-6">
                <label for="country">Country</label>
                <select id="country" class="form-control" name="country">
                    <option>Choose</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="France">France</option>
                    <option value="United States" selected="">United States</option>
                </select>
            </div>
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />

            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" />

            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

{{-- <script>
    $('#country').on('change', function() {
        var idCountry = this.value;
        $.ajax({
            url: "{{ route('list-countries') }}",
            type: "GET",
            dataType: 'json',
            success: function(result) {
                $.each(result, function(key, value) {
                    $("#country").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
            }
        });
    });
</script> --}}
