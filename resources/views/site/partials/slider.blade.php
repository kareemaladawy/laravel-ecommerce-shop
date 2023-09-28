<section class="section-main bg padding-top-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <!-- ================= main slide ================= -->
                <div class="owl-init slider-main owl-carousel" data-items="1" data-dots="false" data-nav="true">
                    @foreach ($offers as $offer)
                        <div class="item-slide">
                            <a href="{{ route('products.show', $offer->product?->slug) }}"><img
                                    src="{{ asset('storage/' . $offer->image) }}"></a>
                        </div>
                    @endforeach
                </div>
                <!-- ============== main slidesow .end // ============= -->
            </div>
            <div class="col-md-3">
                @forelse ($featured_products as $product)
                    <div class="card mb-1">
                        <figure class="itemside">
                            @if ($product->images)
                                <div class="aside">
                                    <div class="img-wrap img-sm mt-3"><a
                                            href="{{ route('products.show', $product->slug) }}"><img
                                                src="{{ asset('storage/' . $product->images[0]) }}"></a>
                                    </div>
                                </div>
                            @else
                                <div class="aside">
                                    <div class="img-wrap img-sm border-right"><a
                                            href="https://via.placeholder.com/176"><img
                                                src="https://via.placeholder.com/176"></a>
                                    </div>
                                </div>
                            @endif
                            <figcaption class="p-3">
                                <h6 class="title">
                                    <a class="text-dark"
                                        href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                </h6>
                                @livewire('product-rating-wrap', ['product' => $product, 'inline' => true])
                                &nbsp;
                                @if ($product->offer?->discount_percentage)
                                    <span
                                        class="d-inline badge badge-success">{{ $product->offer?->discount_percentage . '% Discount' }}
                                    </span>
                                @endif
                                <div class="price-wrap mt-1">
                                    @if ($product->sale_price > 0)
                                        <span
                                            class="price-new b"><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ $product->sale_price }}</span>
                                        <del class="price-old text-muted"><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ $product->unit_price }}
                                        </del>
                                    @else
                                        <span
                                            class="price-new b"><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ $product->unit_price }}</span>
                                    @endif
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</section>
