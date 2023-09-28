<section class="section-subscribe bg-primary padding-y-lg">
    <div class="container">
        <p class="pb-2 text-center white">
            {{ __('Delivering the latest product trends and industry news straight to your inbox') }}</p>

        <div class="row justify-content-md-center">
            <div class="col-lg-4 col-sm-6">
                @livewire('subscribe-form')
                <small class="form-text text-center text-white-50">{{ __('We’ll never share your email address') }}.
                </small>
            </div>
        </div>
    </div>
</section>
