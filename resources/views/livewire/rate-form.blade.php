@auth
    @if (isset($rated, $stars_width))
        <div class="col-md-6">
            <article class="card mt-4">
                <div class="card-header">{{ __('Rate this product') }}</div>
                <div class="card-body">
                    <span class="center mt-3 py-2 px-3">{{ __('You rated this product') }} {{ $stars_width }}
                        {{ __('out of 5') }}</span>
                    <div class="rating-wrap d-inline">
                        <ul class="rating-stars">
                            <li style="width:{{ $stars_width * 20 }}%" class="stars-active">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="fa fa-star"></i>
                            </li>
                            <li>
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="fa fa-star"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </article>
        </div>
    @else
        <div class="col-md-6">
            <article class="card mt-4">
                <div class="card-header">{{ __('Rate this product') }}</div>
                <div class="card-body">
                    <form wire:submit="addRating" class=" px-4" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <div class="stars mt-2">
                                <input class="star star-5" id="star-5" type="radio" name="star" value="5"
                                    wire:model='star_rating' wire:click="showButton" />
                                <label class="star star-5" for="star-5"></label>
                                <input class="star star-4" id="star-4" type="radio" name="star" value="4"
                                    wire:model='star_rating' wire:click="showButton" />
                                <label class="star star-4" for="star-4"></label>
                                <input class="star star-3" id="star-3" type="radio" name="star" value="3"
                                    wire:model='star_rating' wire:click="showButton" />
                                <label class="star star-3" for="star-3"></label>
                                <input class="star star-2" id="star-2" type="radio" name="star" value="2"
                                    wire:model='star_rating' wire:click="showButton" />
                                <label class="star star-2" for="star-2"></label>
                                <input class="star star-1" id="star-1" type="radio" name="star" value="1"
                                    wire:model='star_rating' wire:click="showButton" />
                                <label class="star star-1" for="star-1"></label>
                            </div>
                            @if ($button)
                                <button type="submit"
                                    class="btn float-right mt-3 py-2 px-3 btn-primary">{{ __('Rate') }}
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </article>
        </div>
    @endif
@endauth
@guest
    <div class="col-md-6">
        <article class="card mt-4">
            <div class="card-header">{{ __('Rate this product') }}</div>
            <div class="card-body">
                <span class="center mt-3 py-2 px-3"><a href="{{ route('login') }}">{{ __('Login to rate') }}</a></span>
            </div>
        </article>
    </div>
@endguest
