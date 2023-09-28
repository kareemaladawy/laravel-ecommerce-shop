<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;

class Collection extends Component
{
    public $products;
    public $filtered_products;
    public $category;
    public $brands;

    #[Rule('nullable|numeric')]
    public $min_price;
    #[Rule('nullable|numeric')]
    public $max_price;

    public $selected_brands = [];

    public bool $preventSubmission = false;

    public function submitted()
    {
        $this->preventSubmission = false;
    }

    public function mount($category, $brands)
    {
        $this->category = $category;
        $this->brands = $brands;
        $this->products = $this->category->products()->with(['ratings', 'offer'])->get();
        $this->filtered_products = $this->category->products()->with(['ratings', 'offer'])->get();
    }

    public function updateBrand()
    {
        if ($this->selected_brands) {
            $this->filtered_products = $this->products->filter(function ($item) {
                return in_array($item->brand->name, $this->selected_brands);
            });
        } else {
            $this->filtered_products = $this->products;
        }
    }

    public function updatePrice()
    {
        $this->validate();

        if (intval($this->min_price) > 0 && intval($this->max_price) > 0) {
            $this->filtered_products = $this->products->filter(function ($item) {
                return $item->sale_price ? $item->sale_price >= intval($this->min_price) && $item->sale_price <= intval($this->max_price) : $item->unit_price >= intval($this->min_price) && $item->unit_price <= intval($this->max_price);
            });
        } else if (intval($this->min_price) > 0) {
            $this->filtered_products = $this->products->filter(function ($item) {
                return $item->sale_price ? $item->sale_price >= intval($this->min_price) : $item->unit_price >= intval($this->min_price);
            });
        } else if (intval($this->max_price) > 0) {
            $this->filtered_products = $this->products->filter(function ($item) {
                return $item->sale_price ? $item->sale_price <= intval($this->max_price) : $item->unit_price <= intval($this->max_price);
            });
        } else {
            $this->filtered_products = $this->products;
        }
    }

    public function render()
    {
        return view('livewire.collection', [
            'filtered_products' => $this->filtered_products,
        ]);
    }
}
