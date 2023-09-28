@extends('site.app')
@section('title', __('Search Products'))
@section('content')
    <section class="section-request bg padding-y-sm">
        <div class="container">
            <header class="section-heading">
            </header>
            <div class="row">
                @forelse ($products as $product)
                    @include('site.partials.products')
                @empty
                    <div class="mb-4 center">
                        <h2>{{ __('No products found') }}</h2>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
