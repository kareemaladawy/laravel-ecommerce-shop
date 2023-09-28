<section class="section-request bg padding-y-sm">
    <div class="container">
        <header class="section-heading heading-line">
            <h4 class="title-section bg">{{ __('Recently Added Products') }}</h4>
        </header>
        <div class="row">
            @foreach ($recently_added_products as $product)
                @include('site.partials.products')
            @endforeach
        </div>
    </div>
</section>
