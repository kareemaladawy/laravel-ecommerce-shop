@extends('site.app')
@section('title', __('My Orders'))
@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">{{ __('My Orders') }}</h2>
        </div>
    </section>
    <section class="section-content bg padding-y border-top">
        <div class="container">
            <div class="row">
                @if (Session::has('INVNUM'))
                    <p class="alert alert-success">{{ __('Order placed successfully. Your order number is:') }}
                        {{ Session::get('INVNUM') }}</p>
                @endif
            </div>
            <div class="row">
                <main class="col-sm-12">
                    @if ($orders->count() > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Order No.') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                    <th scope="col">{{ __('Total') }}</th>
                                    <th scope="col">{{ __('Currency') }}</th>
                                    <th scope="col">{{ __('Payment Method') }}</th>
                                    <th scope="col">{{ __('Items') }}</th>
                                    <th scope="col">{{ __('Date Created') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td scope="row">{{ $order->number }}</td>
                                        <td><span
                                                class="badge badge-success">{{ __(strtoupper($order->status->value)) }}</span>
                                        <td>{{ number_format($order->grand_total) }}
                                        </td>
                                        <td>{{ $order->currency }}</td>
                                        <td>{{ __($order->payment_method) }}</td>
                                        <td>
                                            @foreach ($order->items as $item)
                                                <span class="">{{ $item->name }}
                                                    @foreach ($item->attributes as $key => $value)
                                                        , {{ $value }}
                                                    @endforeach
                                                    | {{ __('Qty') }}: {{ $item->qty }}
                                                </span>
                                                <br>
                                            @endforeach
                                        </td>
                                        </td>
                                        <td>{{ Carbon\Carbon::parse($order->created_at)->isoFormat('A h:m ,dddd, D/MM/YYYY ') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="col-sm-12">
                            <p class="alert alert-warning">{{ __('No orders to display') }}</p>
                        </div>
                    @endif
                </main>
            </div>
        </div>
    </section>
@endsection
