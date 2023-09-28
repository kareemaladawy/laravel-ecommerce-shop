<?php

namespace App\Livewire;

use Livewire\Component;

class ProductRatingWrap extends Component
{
    public $product;
    public $inline = false;

    public function mount($product, $inline)
    {
        $this->product = $product;
        $this->inline = $inline;
    }

    public function render()
    {
        $ratings_count = $this->product->ratings()->count('star_rating');
        if ($ratings_count > 0) {
            $ratings_sum = $this->product->ratings()->sum('star_rating');
            $avg_rating = round($ratings_sum / $ratings_count, 1);
            $stars_width = ($avg_rating / 5) * 100;

            return view('livewire.product-rating-wrap', [
                'stars_width' => $stars_width,
                'ratings_count' => $ratings_count,
                'inline' => $this->inline
            ]);
        }

        return view('livewire.product-rating-wrap', [
            'stars_width' => 0,
            'ratings_count' => $ratings_count,
            'inline' => $this->inline
        ]);
    }
}
