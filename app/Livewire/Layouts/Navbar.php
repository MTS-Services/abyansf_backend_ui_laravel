<?php

namespace App\Livewire\Layouts;

use Livewire\Component;

class Navbar extends Component
{

    public function mount()
    {
        if (!api_is_authenticated()) {
            $this->redirect(route('login'));
        }
    }

    public function render()
    {
        return view('livewire.layouts.navbar');
    }
}
