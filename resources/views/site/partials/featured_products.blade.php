<section class="section-content padding-y-sm bg">
    <div class="container">
        <header class="section-heading heading-line">
            <h4 class="title-section bg">{{ __('Featured Products') }}</h4>
        </header>
        <div class="row">
            @foreach ($featured_products as $product)
                @include('site.partials.products')
            @endforeach
        </div>
    </div>
</section>
