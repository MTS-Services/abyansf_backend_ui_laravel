<?php

namespace App\Livewire\Layouts;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Header extends Component
{
    public function logout()
    {
        Session::forget('api_token');
        return  $this->redirectRoute('login',  navigate: true);
    }
    public function render()
    {
        return view('livewire.layouts.header');
    }
}
