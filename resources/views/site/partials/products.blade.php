<div class="col-md-3">
    <figure class="card card-product">
        @if ($product->images)
            <div class="img-wrap">
                <a href="{{ route('products.show', $product->slug) }}"><img
                        src="{{ asset('storage/' . $product->images[0]) }}"></a>
            </div>
        @else
            <div class="img-wrap">
                <a href="https://via.placeholder.com/176"><img src="https://via.placeholder.com/176"></a>
            </div>
        @endif
        <figcaption class="info-wrap">
            <h5 class="title">{{ $product->name }}</h5>
            <div class="rating-wrap d-inline">
                @php
                    $ratings_count = $product->ratings->count('star_rating');
                    if ($ratings_count > 0) {
                        $ratings_sum = $product->ratings->sum('star_rating');
                        $avg_rating = round($ratings_sum / $ratings_count, 1);
                        $stars_width = ($avg_rating / 5) * 100;
                    } else {
                        $stars_width = 0;
                    }
                @endphp
                <ul class="rating-stars">
                    <li style="width:{{ $stars_width }}%" class="stars-active">
                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                            class="fa fa-star"></i><i class="fa fa-star"></i>
                    </li>
                    <li>
                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                            class="fa fa-star"></i><i class="fa fa-star"></i>
                    </li>
                </ul>
                <small>({{ $ratings_count }})</small>
            </div> &nbsp;
            @if ($product->offer?->discount_percentage)
                <span
                    class="d-inline badge badge-success">{{ $product->offer?->discount_percentage . '% ' . __('Discount') }}
                </span>
            @endif
        </figcaption>
        <div class="bottom-wrap">
            <a href="{{ route('products.show', $product->slug) }}"
                class="btn btn-sm btn-outline-primary float-right">{{ __('View') }}</a>
            <div class="price-wrap h5">
                @if ($product->sale_price > 0)
                    <span
                        class="price-new"><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ number_format($product->sale_price) }}</span>
                    <small><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small><del
                            class="price-old">{{ number_format($product->unit_price) }}</del></small>
                @else
                    <span
                        class="price-new"><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ number_format($product->unit_price) }}</span>
                @endif
            </div>
        </div>
    </figure>
</div>
