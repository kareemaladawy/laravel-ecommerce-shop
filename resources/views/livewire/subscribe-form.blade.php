<form wire:submit="subscribe" class="row-sm form-noborder">
    @csrf
    <div class="col-8">
        <input wire:model='email' class="form-control" placeholder="{{ __('Email Address') }}" type="email" name="email">
        <div>
            <br>
            @error('email')
                <span class="error text-white">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-4">
        <button type="submit" class="btn btn-block btn-{{ $button_color }}"> <i class="fa fa-envelope"></i>
            {{ __($button_status) }} </button>
    </div>
</form>
