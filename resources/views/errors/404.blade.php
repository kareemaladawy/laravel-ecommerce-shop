@extends('site.app')
@section('title', __('Not found'))
@section('content')
    @if (session('message'))
        <p class="alert alert-danger">{{ session('message') }}</p>
    @endif
    <div class="body-wrapper">
        <div class="error404-area pt-30 pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="error-wrapper text-center ptb-50 pt-xs-20">
                            <br>
                            <div class="error-text">
                                <h1>404</h1>
                                <h2>{{ __('PAGE NOT FOUND') }}</h2>
                                <p>{{ __('Sorry, the page you are looking for does not exist') }}</p>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
