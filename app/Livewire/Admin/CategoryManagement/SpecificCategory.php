<?php

namespace App\Livewire\Admin\CategoryManagement;

use Livewire\Component;

class SpecificCategory extends Component
{

    public $addSpacificCategoryModal = false;
    public $editSpacificCategoryModal = false;


    public function switchAddSpacificCategoryModal()
    {
           $this->addSpacificCategoryModal = !$this->addSpacificCategoryModal;
    }

    public function switchEditSpacificCategoryModal()
    {
        $this->editSpacificCategoryModal = !$this->editSpacificCategoryModal;
    }
    public function render()
    {
        return view('livewire.admin.category-management.specific-category');
    }
}
