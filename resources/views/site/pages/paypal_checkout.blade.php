@extends('site.app')
@section('title', __('Checkout'))
@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">{{ __('Checkout with PayPal') }}</h2>
        </div>
    </section>
    <section class="section-content bg padding-y">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('payment-cancelled'))
                        <p class="alert alert-danger">{{ Session::get('payment-cancelled') }}</p>
                    @endif
                    @if (Session::has('message'))
                        <p class="alert alert-danger">{{ Session::get('message') }}</p>
                    @endif
                </div>
            </div>
            <form action="{{ route('checkout.placePayPalOrder') }}" method="POST" role="form">
                @csrf
                @include('site.partials.billing_form')
            </form>
        </div>
    </section>
@endsection
