<header class="section-header">
    <section class="header-main">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="brand-wrap">
                        @if (config('settings.site_logo.attachment') !== null)
                            <a href="{{ route('home') }}">
                                <img class="logo"
                                    src="{{ secure_asset('storage/' . config('settings.site_logo.attachment')) }}">
                            </a>
                        @else
                            <a href="{{ route('home') }}" class="text-dark">
                                <h2 class="logo-text">{{ config('settings.site_title.value') }}</h2>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <form action="{{ route('products.search') }}" class="search-wrap">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="{{ __('Search Products') }}"
                                name="q" value="{{ isset($q) ? $q : '' }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ config('languages.' . app()->getLocale()) ?? config('languages.' . config('app.fallback_locale')) }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach (config('languages') as $locale => $lang)
                            <a class="dropdown-item"
                                href="{{ route('langswitcher', ['locale' => $locale]) }}">{{ $lang }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <div class="widgets-wrap d-flex justify-content-end">
                        @auth
                            @include('site.partials.cart_widget')
                        @endauth
                        @include('site.partials.user_widget')
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('site.partials.nav')
</header>
