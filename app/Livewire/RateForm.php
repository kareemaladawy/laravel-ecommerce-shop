<?php

namespace App\Livewire;

use App\Models\Rating;
use Livewire\Attributes\Rule;
use Livewire\Component;

class RateForm extends Component
{
    public $product;

    #[Rule('required')]
    public $star_rating;

    public $button = false;
    public $result = false;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function showButton()
    {
        $this->button = true;
    }

    public function addRating()
    {
        $this->product->ratings()->save(new Rating([
            'user_id' => auth()->id(),
            'star_rating' => $this->star_rating,
        ]));

        $this->result = 'Rated';
    }

    public function render()
    {
        if (auth()->check()) {
            if ($rate = auth()->user()->ratings()->where('product_id', $this->product->id)->first()) {
                return view('livewire.rate-form', [
                    'rated' => true,
                    'stars_width' => $rate->star_rating
                ]);
            }
        }

        return view('livewire.rate-form');
    }
}
