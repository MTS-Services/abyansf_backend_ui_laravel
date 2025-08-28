<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Listing extends Component
{

    public $addListingModal = false;
    public $editListingModal = false;
    

    public function switchAddListingModal()
    {
        $this->addListingModal = !$this->addListingModal;
    }
  




    public function switchEditListingModel()
    {
        $this->editListingModal = !$this->editListingModal;
    }

    
    public function render()
    {
        return view('livewire.admin.listing');
    }
}
