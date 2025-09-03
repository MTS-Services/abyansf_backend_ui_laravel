<?php

namespace App\Livewire\Admin;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SubCategory extends Component
{

    public $addSubCategoryModal = false;
    public $editSubCategoryModal = false;
    public function switchAddSubCategoryModal()
    {
        $this->addSubCategoryModal = !$this->addSubCategoryModal;
    }

    //  public function mount()
    // {
    //     $this->currentPage = request()->query('page', 1);
    //     $this->fetchSubCategories($this->currentPage);
    // }
    // public function fetchEvents($page = 1)
    // {
    //     $token = session()->get('api_token');
    //     if (!$token) {
    //         return $this->redirectRoute('login', navigate: true);
    //     }
    //     $response = Http::withToken($token)->get(api_base_url() . '/events', [
    //         'page' => $page
    //     ]);
    //     if ($response->successful()) {
    //         $data = $response->json();
    //         $this->eveSubCategoriesnts = $data['data']['events'] ?? [];
    //         $this->pagination = $data['data']['pagination'] ?? [];
    //         $this->currentPage = $page;
    //     } else {
    //         $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load events from the API.');
    //         $this->SubCategories = [];
    //         $this->pagination = [];
    //         Session::flash('error', 'Failed to load events from the API.');
    //     }
    // }
    public function switchEditSubCategoryModal()
    {
        $this->editSubCategoryModal = !$this->editSubCategoryModal;
    }
    public function render()
    {
        return view('livewire.admin.sub-category');
    }
}
