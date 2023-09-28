@if (config('settings.site_logo.attachment') != null)
    <img src="{{ asset('storage/' . config('settings.site_logo.attachment')) }}" alt="">
@else
    <b>{{ config('settings.site_title.value') }}</b>
@endif
