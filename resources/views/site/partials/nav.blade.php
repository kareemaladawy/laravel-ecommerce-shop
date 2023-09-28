<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
                @forelse ($categories as $category)
                    @if ($category->items->isEmpty())
                        <li class="nav-item font-weight-normal">
                            @if (Request::segment(2) == $category->slug)
                                <a class="nav-link active"
                                    href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
                            @else
                                <a class="nav-link"
                                    href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
                            @endif
                        </li>
                    @else
                        <li class="nav-item dropdown font-weight-normal">
                            @if (Request::segment(2) == $category->slug)
                                <a class="nav-link dropdown-toggle active"
                                    href="{{ route('categories.show', $category->slug) }}" id="dropdown07"
                                    data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">{{ $category->name }}
                                </a>
                            @else
                                <a class="nav-link dropdown-toggle"
                                    href="{{ route('categories.show', $category->slug) }}" id="dropdown07"
                                    data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">{{ $category->name }}
                                </a>
                            @endif
                            <div class="dropdown-menu" aria-labelledby="dropdown07">
                                <a class="dropdown-item"
                                    href="{{ route('categories.show', $category->slug) }}">{{ __('All') }}
                                    {{ $category->name }}</a>
                                <div class="dropdown-divider"></div>
                                @foreach ($category->items as $sub_category)
                                    <a class="dropdown-item"
                                        href="{{ route('categories.show', $sub_category->slug) }}">{{ $sub_category->name }}</a>
                                @endforeach
                            </div>
                        </li>
                    @endif
                @empty
                    <li class="nav-item">
                        <span class="nav-link disabled">{{ __('No active categories') }}</span>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</nav>
