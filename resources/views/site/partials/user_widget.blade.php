<div class="widget-header dropdown">
    <a href="#" class="ml-3 icontext" data-toggle="dropdown" data-offset="20,10">
        <div class="icon-wrap icon-xs bg2 round text-secondary"><i class="fa fa-user"></i>
        </div>
        <div class="text-wrap">
            @auth
                <small>{{ Str::limit(auth()->user()->full_name, 15) }}</small>
            @else
                <span>{{ __('Login') }} <i class="fab fa-caret-down"></i></span>
            @endauth
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        @auth
            <a class="dropdown-item" href="{{ route('account.edit') }}">{{ __('My Account') }}</a>
            <a class="dropdown-item" href="{{ route('account.orders') }}">{{ __('My Orders') }}</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        @else
            <form action="{{ route('login') }}" method="POST" role="form" class="px-4 py-3">
                @csrf
                <div class="form-group">
                    <label>{{ __('Email Address') }}</label>
                    <input type="email" name="email" class="form-control" placeholder="email@example.com">
                </div>
                <div class="form-group">
                    <label>{{ __('Password') }}</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
            </form>
            <hr class="dropdown-divider">
            <a class="dropdown-item" href="{{ route('register') }}">{{ __('Don\'t have an account? Register') }}</a>
            <a class="dropdown-item" href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
        @endauth
    </div>
</div>
