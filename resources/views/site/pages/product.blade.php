@extends('site.app')
@section('styles')
    <style>
        div.stars {
            width: 40%;
            display: inline-block;
        }

        input.star {
            display: none;
        }

        label.star {
            float: right;
            left: 0;
            padding: 2px;
            font-size: 34px;
            color: rgb(175, 175, 175);
        }

        input.star:checked~label.star:before {
            content: '\f005';
            color: #FD4;
        }

        input.star-5:checked~label.star:before {
            color: #FE7;
        }

        input.star-1:checked~label.star:before {}

        label.star:hover {
            transform: scale(1.1);
        }

        label.star:before {
            content: '\f006';
            font-family: FontAwesome;
        }

        .rating_circle {
            width: 100px;
            height: 100px;
            border-radius: 70px;
            border: 1px none;
            font-size: 35px;
        }

        .rating_text {
            margin-top: 38px;
        }

        .stars-outer {
            display: inline-block;
            position: relative;
            font-family: FontAwesome;
            font-size: 20px;
            letter-spacing: 5px;
        }

        .stars-outer::before {
            content: "\f006 \f006 \f006 \f006 \f006";
        }

        .stars-inner {
            position: absolute;
            top: 0;
            left: 0;
            white-space: nowrap;
            overflow: hidden;
            width: 0;
        }

        .stars-inner::before {
            content: "\f005 \f005 \f005 \f005 \f005";
            color: #FE7;
        }
    </style>
@endsection
@section('title', $product->name)
@section('content')
    <section onload="resetForm()" class="section-content bg padding-y border-top" id="site">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if (Session::has('added_to_cart'))
                        <p class="alert alert-success">{{ __(Session::get('added_to_cart')) }}</p>
                    @endif
                    @if (Session::has('add_to_cart_error'))
                        <p class="alert alert-danger">{{ __(Session::get('add_to_cart_error')) }}</p>
                    @endif
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="row no-gutters">
                            <aside class="col-sm-5 border-right">
                                <article class="gallery-wrap">
                                    @if ($product->images)
                                        <div class="img-big-wrap">
                                            <a href="{{ asset('storage/' . $product->images[0]) }}" data-fancybox="">
                                                <img src="{{ asset('storage/' . $product->images[0]) }}"
                                                    alt="{{ $product->name . ' image' }}">
                                            </a>
                                        </div>
                                    @else
                                        <div class="img-big-wrap">
                                            <a href="https://via.placeholder.com/176" data-fancybox=""><img
                                                    src="https://via.placeholder.com/176"></a>
                                        </div>
                                    @endif
                                    @if (count($product->images) > 1)
                                        <div class="img-small-wrap">
                                            @foreach ($product->images as $image)
                                                <div class="item-gallery">
                                                    <a href="{{ asset('storage/' . $image) }}" data-fancybox="">
                                                        <img src="{{ asset('storage/' . $image) }}" alt="">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </article>
                            </aside>

                            <aside class="col-sm-7">
                                <article class="p-5">
                                    <h3 class="title mb-3">{{ $product->name }}
                                        <br>
                                        @livewire('product-rating-wrap', ['product' => $product, 'inline' => true])
                                        &nbsp;
                                        @if ($product->offer?->discount_percentage)
                                            <span
                                                class="badge badge-success mt-3 inline">{{ $product->offer?->discount_percentage . '% ' . __('Discount') }}
                                            </span>
                                        @endif
                                    </h3>
                                    <dl class="row">
                                        <dt class="col-sm-3">{{ __('Brand Name') }}</dt>
                                        <dd class="col-sm-9">{{ $product->brand->name }}</dd>
                                        <dt class="col-sm-3">{{ __('Model Name') }}</dt>
                                        <dd class="col-sm-9">{{ $product->model }}</dd>
                                        <dt class="col-sm-3">{{ __('About this item') }}</dt>
                                        <dd class="col-sm-9">{!! $product->description !!}</dd>
                                    </dl>
                                    <div class="mb-3">
                                        @if ($product->sale_price > 0)
                                            <var class="price h3 text-primary">
                                                <span class="price" id="productPrice">
                                                    <span
                                                        class="currency"><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small></span>{{ number_format($product->sale_price) }}
                                                </span>
                                                <small
                                                    class="price-old"><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>
                                                    <del>
                                                        {{ number_format($product->unit_price) }}
                                                    </del>
                                                </small>
                                            </var>
                                        @else
                                            <var class="price h3 text-primary">
                                                <span class="num" id="productPrice"><span
                                                        class="currency"><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small></span>{{ number_format($product->unit_price) }}</span>
                                            </var>
                                        @endif
                                    </div>
                                    <form action="{{ route('cart.addItem') }}" method="POST" role="form" id="addToCart"
                                        name="addToCartForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <dl class="dlist-inline">
                                                    @foreach ($attributes as $attribute)
                                                        @php $attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray()) @endphp
                                                        @if ($attributeCheck)
                                                            <dt>{{ $attribute->name }}: </dt>
                                                            <dd>
                                                                <select id="attribute"
                                                                    class="form-control form-control-sm option"
                                                                    style="width:100%"
                                                                    name="{{ strtolower($attribute->name) }}">
                                                                    @foreach ($product->attributes as $attributeValue)
                                                                        @if ($attributeValue->attribute_id == $attribute->id)
                                                                            <option
                                                                                data-price="{{ floatval($attributeValue->price) }}"
                                                                                value="{{ $attributeValue->value }}">
                                                                                {{ ucwords($attributeValue->value) }}
                                                                                @if ($attributeValue->price != null)
                                                                                    {{ '+' . config('settings.currency_symbol.value') . $attributeValue->price }}
                                                                                @endif
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </dd>
                                                            &ensp;
                                                        @endif
                                                    @endforeach
                                                </dl>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <dl class="dlist-inline">
                                                    <dt>{{ __('Quantity') }}: </dt>
                                                    <dd>
                                                        <input class="form-control" type="number" min="1"
                                                            value="1" max="{{ $product->qty }}" name="qty"
                                                            id="qty" style="width:70px;">
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                        <input type="hidden" name="unit_price" id="finalPrice"
                                                            value="{{ $product->sale_price ?: $product->unit_price }}">
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-outline-primary"><i
                                                class="fas fa-shopping-cart"></i>
                                            {{ __('Add To Cart') }}</button>
                                    </form>
                                </article>
                            </aside>
                        </div>
                    </div>
                </div>
                <section class="section-content padding-y-sm bg">
                    <div class="container">
                        <header class="section-heading heading-line">
                            <h4 class="title-section bg">{{ __('Related Products') }}</h4>
                        </header>
                        <div class="row">
                            @foreach ($product->categories()
            ?->first()
            ?->products()->limit(5)->get()->except($product->id) as $related_product)
                                @include('site.partials.related_products')
                            @endforeach
                        </div>
                    </div>
                </section>

                <div class="col-md-12">
                    <article class="card mt-4">
                        <div class="card-body">
                            {!! $product->details !!}
                        </div>
                    </article>
                </div>
                @livewire('product-ratings', ['product' => $product])
                @livewire('rate-form', ['product' => $product])
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#addToCart').submit(function(e) {
                if ($('.option').val() == 0) {
                    e.preventDefault();
                    alert('Please select an option');
                }

                calculatePrice();
            });

            $('.option').change(function() {
                calculatePrice();
            });
        });

        function calculatePrice() {
            $('#productPrice').html(
                "{{ $product->sale_price != '' ? $product->sale_price : $product->unit_price }} ");

            let price = parseFloat($('#productPrice').html());

            [].forEach.call(document.querySelectorAll('#attribute :checked'), function(element) {
                price = parseFloat(price) + parseFloat(element.dataset.price);
            })

            document.getElementById("productPrice").innerHTML =
                "<span class='currency'><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small></span>" +
                price.toLocaleString();
            document.getElementById("finalPrice").value =
                price.toFixed(2);
        }
    </script>
@endpush
