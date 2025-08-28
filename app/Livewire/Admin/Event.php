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

    public function editEventModel()
    {
        // Toggle modal
        $this->editEventModal = true;
    }

    public function closeEditEventModal()
    {
        $this->editEventModal = false;
    }

    public function render()
    {
        return view('livewire.admin.event');
    }
}
