<footer class="section-footer bg-dark white">
    <div class="container">
        <section class="footer-top padding-top">
            <div class="row">
                <aside class="col-sm-3  col-md-3 white">
                    @auth
                        <h5 class="title">{{ __('My Account') }}</h5>
                        <ul class="list-unstyled">
                            <li> <a href="{{ route('account.edit') }}"> {{ __('Account Setting') }} </a></li>
                            <li> <a href="{{ route('account.orders') }}"> {{ __('My Orders') }} </a></li>
                            <li> <a href="{{ route('cart.index') }}"> {{ __('My Cart') }} </a></li>
                        </ul>
                    @else
                        <h5 class="title">{{ __('Account') }}</h5>
                        <ul class="list-unstyled">
                            <li> <a href="{{ route('register') }}"> {{ __('User Registration') }} </a></li>
                        </ul>
                    @endauth
                </aside>
                <aside class="col-sm-3">
                    <article class="white">
                        <h5 class="title">{{ __('Contact Us') }}</h5>
                        <p>
                            <strong>{{ __('Phone') }}:</strong> {{ config('settings.phone.value') }}
                            <br>
                            <strong>{{ __('Fax') }}:</strong> {{ config('settings.fax.value') }}
                        </p>

                        <div class="btn-group white">
                            <a href="{{ config('settings.social_facebook.value') }}" class="btn btn-facebook"
                                title="Facebook" target="_blank"><i class="fab fa-facebook-f  fa-fw"></i></a>
                            <a class="btn btn-instagram" title="Instagram" target="_blank"
                                href="{{ config('settings.social_instagram.value') }}"><i
                                    class="fab fa-instagram  fa-fw"></i></a>
                            <a class="btn btn-twitter" title="Twitter" target="_blank"
                                href="{{ config('settings.social_twitter.value') }}"><i
                                    class="fab fa-twitter  fa-fw"></i></a>
                        </div>
                    </article>
                </aside>
            </div>
            <br>
        </section>
        <section class="footer-bottom row border-top-white">
            <div class="col-sm-6">
                <p class="text-white-50"> {{ __('Made by') }}
                    <br> Kareem Aladawy
                </p>
            </div>
            <div class="col-sm-6">
                <p class="text-md-right text-white-50">
                    {{ __('Copyright') }} &copy
                    <br>
                    <a href="http://bootstrap-ecommerce.com" class="text-white-50">Bootstrap-ecommerce UI kit</a>
                </p>
            </div>
        </section>
        <!-- //footer-top -->
    </div>
    <!-- //container -->
</footer>
