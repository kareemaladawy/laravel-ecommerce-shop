<div class="col-md-6">
    <div class="card mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h2>{{ __('Rating') }}</h2>
                    <ul class="rating-stars">
                        <li style="width:{{ $stars_width }}%" class="stars-active">
                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                class="fa fa-star"></i><i class="fa fa-star"></i>
                        </li>
                        <li>
                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                class="fa fa-star"></i><i class="fa fa-star"></i>
                        </li>
                    </ul>
                    <button class="rating_circle mt-3">{{ $avg_rating }}</button>
                </div>
                <div class="col-md-7">
                    @forelse ($star_rating_percentages as $star_key => $star_value)
                        <div class="progress {{ $loop->first ? 'mt-4' : 'mt-3' }}" style="height:10px">
                            <div class="progress-bar " style="width:{{ $star_value }}%;height:10px"></div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="col-md-1">
                    @foreach (array_keys($star_rating_percentages) as $star_key)
                        <div class="row">
                            <h6 class="{{ $loop->first ? 'mt-3' : '' }}">{{ $star_key }}</h6>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
