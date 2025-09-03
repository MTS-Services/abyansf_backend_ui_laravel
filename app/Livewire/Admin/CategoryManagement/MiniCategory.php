<?php

namespace App\Livewire\Admin\CategoryManagement;

use Livewire\Component;

class MiniCategory extends Component
{
      public $addMiniCategoryModal = false;
      public $editMiniCategoryModal = false;
    public function switchAddMiniCategoryModal()
    {
        $this->addMiniCategoryModal = !$this->addMiniCategoryModal;
    }

    public function switchEditMiniCategoryModal()
    {
        $this->editMiniCategoryModal = !$this->editMiniCategoryModal;
    }
    public function render()
    {
        return view('livewire.admin.category-management.mini-category');
    }
}
