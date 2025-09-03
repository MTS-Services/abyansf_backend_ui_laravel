<?php

namespace App\Livewire\Layouts;

use Livewire\Component;

class Notification extends Component
{

    public $showPanel = false;
    public $unreadCount = 0;
    public $readCount = 0;


    // public function togglePanel()
    // {
    //     $this->showPanel = !$this->showPanel;
    // }

    // public function closePanel()
    // {
    //     $this->showPanel = false;
    // }

    public function render()
    {
        return view('livewire.layouts.notification');
    }
}
