<div>
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">{{ __('Shopping Cart') }}</h2>
        </div>
    </section>
    <section class="section-content bg padding-y border-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('empty_cart_warning'))
                        <p class="alert alert-warning">{{ __(Session::get('empty_cart_warning')) }}</p>
                    @endif
                    @if (Session::has('payment_type_warning'))
                        <p class="alert alert-danger">{{ __(Session::get('payment_type_warning')) }}</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <main class="col-sm-9">
                    @if (\Cart::session(auth()->id())->isEmpty())
                        <p class="alert alert-warning">{{ __('No items to display') }}.</p>
                    @else
                        <div class="card">
                            <table class="table table-hover shopping-cart-wrap">
                                <thead class="text-muted">
                                    <tr>
                                        <th scope="col">{{ __('Product') }}</th>
                                        <th scope="col" width="120">{{ __('Quantity') }}</th>
                                        <th scope="col" width="120">{{ __('Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\Cart::session(auth()->id())->getContent() as $item)
                                        <tr>
                                            <td>
                                                <figure class="media">
                                                    <figcaption class="media-body">
                                                        <h6 class="title text-truncate">
                                                            {{ Str::words($item->name, 20) }}
                                                        </h6>
                                                        @foreach ($item->attributes as $key => $value)
                                                            <dl class="dlist-inline small">
                                                                <dt>{{ ucwords($key) }}: </dt>
                                                                <dd>{{ ucwords($value) }}</dd>
                                                            </dl>
                                                        @endforeach
                                                    </figcaption>
                                                </figure>
                                            </td>
                                            <td>
                                                <var class="price">{{ $item->quantity }}</var>
                                            </td>
                                            <td>
                                                <div class="price-wrap">
                                                    <var
                                                        class="price"><small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ number_format($item->price * $item->quantity) }}</var>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <button class="btn btn-outline-danger"
                                                    wire:click="removeItem('{{ $item->id }}')"><i
                                                        class="fa fa-times"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </main>
                <aside class="col-sm-3">
                    @if (config('settings.shipping_cost.value') > 0)
                        <p class="alert alert-success text-center">
                            <small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ config('settings.shipping_cost.value') }}
                            {{ __('will be added as a shipping cost') }}
                        </p>
                    @endif
                    @if (config('settings.shipping_cost.value') > 0)
                        <dl class="dlist-align h6">
                            <dt>{{ __('Subtotal') }}:</dt>
                            <dd class="text-right">
                                <small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ number_format(Cart::session(auth()->id())->getSubTotal(), 2) }}
                            </dd>
                        </dl>
                        <dl class="dlist-align h6">
                            <dt>{{ __('Shipping') }}:</dt>
                            <dd class="text-right">
                                <small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ config('settings.shipping_cost.value') }}
                            </dd>
                        </dl>
                        <br>
                    @endif
                    <dl class="dlist-align h6">
                        <dt>{{ __('Total') }}:</dt>
                        <dd class="text-right">
                            <small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ config('settings.shipping_cost.value') > 0 ? number_format(\Cart::session(auth()->id())->getSubTotal() + config('settings.shipping_cost.value')) : number_format(\Cart::session(auth()->id())->getSubTotal()) }}
                        </dd>
                    </dl>
                    <hr>
                    <a href="{{ route('checkout.index', ['payment_type' => 'paypal']) }}"
                        class="btn btn-outline-primary btn-md btn-block">{{ __('Checkout with PayPal') }}</a>
                    <a href="{{ route('checkout.index', ['payment_type' => 'card']) }}"
                        class="btn btn-outline-secondary btn-md btn-block">{{ __('Checkout with Bank Card') }}</a>
                    <hr>
                    <button class="btn btn-outline-danger btn-block mb-4"
                        wire:click="clear()">{{ __('Clear Cart') }}</button>
                </aside>
            </div>
        </div>
    </section>
    <section>
        @include('site.partials.featured_products')
    </section>
</div>
