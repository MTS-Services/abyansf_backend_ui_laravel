<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Category extends Component
{
    public $addCategoryModal = false;
    public $editCategoryModal = false;

    public function switchAddCategoryModal()
    {
        $this->addCategoryModal = !$this->addCategoryModal;
    }

    public function switchEditCategoryModel()
    {
        $this->editCategoryModal = !$this->editCategoryModal;
    }

    public function render()
    {
        return view('livewire.admin.category');
    }
}
