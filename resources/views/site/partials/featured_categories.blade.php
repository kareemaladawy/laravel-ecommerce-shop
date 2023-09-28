<section class="section-content padding-y-sm bg">
    <div class="container">
        <header class="section-heading heading-line">
            <h4 class="title-section bg">{{ __('Featured Categories') }}</h4>
        </header>
        <div class="row">
            @forelse ($featured_categories as $category)
                <div class="col-md-4">
                    <div class="card-banner"
                        style="height:250px; background-image: url({{ secure_asset('storage/' . $category->image) }});">
                        <article class="overlay overlay-cover d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <a href="{{ route('categories.show', $category->slug) }}"
                                    class="btn btn-warning btn-sm"> {{ __('View Products') }}
                                </a>
                            </div>
                        </article>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</section>
