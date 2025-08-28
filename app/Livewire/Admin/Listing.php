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
  

public function closeAddListingModal()
{
    $this->addListingModal = false;
}


    public function editListingModel()
    {
        $this->editListingModal = true;
    }

    public function closeEditListingModal()
    {
        $this->editListingModal = false;
    }
    public function render()
    {
        return view('livewire.admin.listing');
    }
}
