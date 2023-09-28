<?php

namespace App\Livewire;

use Livewire\Component;

class ProductRatings extends Component
{
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        $ratings_count = $this->product->ratings()->count('star_rating');
        if ($ratings_count > 0) {
            $ratings_sum = $this->product->ratings()->sum('star_rating');
            $avg_rating = round($ratings_sum / $ratings_count, 1);
            $stars_width = ($avg_rating / 5) * 100;

            $ratings = $this->product->ratings()->get()->groupBy('star_rating');

            $star_rating_percentages = [];
            foreach ($ratings as $key => $star_rating) {
                $star_rating_percentages[$key] = round(($star_rating->count() / $ratings_count) * 100, 0);
            }

            krsort($star_rating_percentages);

            return view('livewire.product-ratings', [
                'avg_rating' => $avg_rating,
                'stars_width' => $stars_width,
                'star_rating_percentages' => $star_rating_percentages
            ]);
        }

        return view('livewire.product-ratings', [
            'avg_rating' => 0,
            'stars_width' => 0,
            'star_rating_percentages' => []
        ]);
    }
}
