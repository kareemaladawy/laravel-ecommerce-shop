<div class="col-md">
    <figure class="card card-product">
        @if ($related_product->images)
            <div class="img-wrap">
                <a href="{{ route('products.show', $related_product->slug) }}"><img
                        src="{{ asset('storage/' . $related_product->images[0]) }}"></a>
            </div>
        @else
            <div class="img-wrap">
                <a href="https://via.placeholder.com/176"><img src="https://via.placeholder.com/176"></a>
            </div>
        @endif
        <figcaption class="info-wrap">
            <h5 class="title">{{ $related_product->name }}</h5>
            <div class="rating-wrap d-inline">
                @php
                    $ratings_count = $related_product->ratings->count('star_rating');
                    if ($ratings_count > 0) {
                        $ratings_sum = $related_product->ratings->sum('star_rating');
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
            @if ($related_product->offer?->discount_percentage)
                <span
                    class="d-inline badge badge-success">{{ $related_product->offer?->discount_percentage . '% ' . __('Discount') }}
                </span>
            @endif
        </figcaption>
        <div class="bottom-wrap">
            <a href="{{ route('products.show', $related_product->slug) }}"
                class="btn btn-sm btn-outline-primary float-right">{{ __('View') }}</a>
            <div class="price-wrap h5">
                @if ($related_product->sale_price > 0)
                    <span
                        class="price-new"><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ number_format($related_product->sale_price) }}</span>
                    <small><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small><del
                            class="price-old">{{ number_format($related_product->unit_price) }}</del></small>
                @else
                    <span
                        class="price-new"><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ number_format($related_product->unit_price) }}</span>
                @endif
            </div>
        </div>
    </figure>
</div>
