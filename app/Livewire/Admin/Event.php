<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Event extends Component
{

 
    public $addEventModal = false;
     public $editEventModal = false;


    public function switchAddEventModal()
    {
        $this->addEventModal = !$this->addEventModal;
    }

    public function switchEditEventModel()
    {
        // Toggle modal
        $this->editEventModal = !$this->editEventModal;
    }



    public function render()
    {
        return view('livewire.admin.event');
    }
}
