@extends('site.app')

@section('title', 'Home')

@section('content')
    @if (Session::has('message'))
        <div>
            <p class="alert alert-warning">{{ Session::get('message') }}</p>
        </div>
    @endif
    @include('site.partials.slider')
    @include('site.partials.featured_categories')
    @include('site.partials.featured_products')
    @include('site.partials.recently_added_products')
@endsection
