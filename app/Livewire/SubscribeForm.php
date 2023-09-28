<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use App\Models\Subscriber;
use Livewire\Component;

class SubscribeForm extends Component
{
    #[Rule('required|email|unique:subscribers,email')]
    public $email = '';
    public $button_status = 'Subscribe';
    public $button_color = 'dark';

    public function subscribe()
    {
        $this->validate();

        Subscriber::create([
            'email' => $this->email
        ]);

        $this->button_status = 'Subscribed';
        $this->button_color = 'success';
    }

    public function render()
    {
        return view('livewire.subscribe-form');
    }
}
