<div class="row">
    <div class="col-md-8">
        <div class="card">
            <header class="card-header">
                <h4 class="card-title mt-2">{{ __('Billing Details') }}</h4>
            </header>
            <article class="card-body">
                <div class="form-row">
                    <div class="col form-group">
                        <label>{{ __('First Name') }}</label><span class="required" style="color: red"> * </span>
                        @error('first_name')
                            <span class="required" style="color: red">{{ $message }}</span>
                        @enderror
                        <input type="text" required class="form-control @error('first_name') invalid @enderror"
                            value="{{ auth()->user()->first_name }}" name="first_name">
                    </div>
                    <div class="col form-group">
                        <label>{{ __('Last Name') }}</label><span class="required" style="color: red"> * </span>
                        @error('last_name')
                            <span class="required" style="color: red">{{ $message }}</span>
                        @enderror
                        <input type="text" required class="form-control @error('last_name') invalid @enderror"
                            value="{{ auth()->user()->last_name }}" name="last_name">
                    </div>
                    <div class="col form-group">
                        <label>{{ __('Phone Number') }}</label><span class="required" style="color: red"> * </span>
                        @error('phone_number')
                            <span class="required" style="color: red">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control @error('phone_number') invalid @enderror"
                            name="phone_number" @if (auth()->user()->info?->phone_number) readonly @endif
                            value="{{ old('phone_number') ?: auth()->user()->info?->phone_number }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label>{{ __('Apartment') }}</label><span class="required" style="color: red"> * </span>
                        @error('apartment')
                            <span class="required" style="color: red">{{ $message }}</span>
                        @enderror
                        <input type="number" min="0" required
                            class="form-control @error('apartment') is-invalid @enderror" name="apartment"
                            value="{{ old('apartment') }}">
                    </div>
                    <div class="form-group col">
                        <label>{{ __('Floor') }}</label><span class="required" style="color: red"> * </span>
                        @error('floor')
                            <span class="required" style="color: red">{{ $message }}</span>
                        @enderror
                        <input type="text" required class="form-control @error('floor') is-invalid @enderror"
                            name="floor" value="{{ old('floor') }}">
                    </div>
                    <div class="form-group col">
                        <label>{{ __('Street') }}</label><span class="required" style="color: red"> * </span>
                        @error('street')
                            <span class="required" style="color: red">{{ $message }}</span>
                        @enderror
                        <input type="text" required class="form-control @error('street') is-invalid @enderror"
                            name="street" value="{{ old('street') }}">
                    </div>
                    <div class="form-group col">
                        <label>{{ __('Building') }}</label><span class="required" style="color: red"> * </span>
                        @error('building')
                            <span class="required" style="color: red">{{ $message }}</span>
                        @enderror
                        <input type="number" min="0" required
                            class="form-control @error('building') is-invalid @enderror" name="building"
                            value="{{ old('building') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label>{{ __('City') }}</label><span class="required" style="color: red"> * </span>
                        @error('city')
                            <span class="required" style="color: red">{{ $message }}</span>
                        @enderror
                        <input type="text" required class="form-control @error('city') is-invalid @enderror"
                            name="city" value="{{ old('city') ?: auth()->user()->info?->city ?? '' }}">
                    </div>
                    <div class="form-group col">
                        <label>{{ __('State') }}</label><span class="required" style="color: red"> * </span>
                        @error('state')
                            <span class="required" style="color: red">{{ $message }}</span>
                        @enderror
                        <input type="text" required class="form-control @error('state') is-invalid @enderror"
                            name="state" value="{{ old('state') ?: auth()->user()->info?->state ?? '' }}">
                    </div>
                    <div class="form-group col">
                        <label>{{ __('Country') }}</label><span class="required" style="color: red"> * </span>
                        @error('country')
                            <span class="required" style="color: red">{{ $message }}</span>
                        @enderror
                        <select id="country" class="form-control @error('country') is-invalid @enderror"
                            name="country">
                            <option value="{{ old('country') ?: auth()->user()->info?->country ?? '' }}" selected>
                                {{ old('country') ?: auth()->user()->info?->country ?? '' }}</option>
                            @foreach ($countries as $key => $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col">
                        <label>{{ __('Postal Code') }}</label><span class="required" style="color: red"> * </span>
                        @error('postal_code')
                            <span class="required" style="color: red">{{ $message }}</span>
                        @enderror
                        <input type="number" required
                            class="form-control @error('postal_code') is-invalid @enderror" name="postal_code"
                            value="{{ old('postal_code') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ __('Order Notes') }}</label>
                    <textarea class="form-control" name="notes" rows="4">{{ old('notes') }}</textarea>
                </div>
            </article>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">{{ __('Payment Details') }}</h4>
                    </header>
                    <article class="card-body">
                        <dl class="dlist-align">
                            <dt>{{ __('Total') }}: </dt>
                            <dd class="text-right h5 b">
                                <small><sup>{{ config('settings.currency_symbol.value') }}</sup></small>{{ config('settings.shipping_cost.value') > 0 ? number_format(\Cart::session(auth()->id())->getSubTotal() + config('settings.shipping_cost.value')) : number_format(\Cart::session(auth()->id())->getSubTotal()) }}
                            </dd>
                        </dl>
                    </article>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <button type="submit" class="btn btn-outline-primary btn-lg btn-block">
                    {{ __('Checkout') }}
                </button>
            </div>
        </div>
    </div>
</div>
