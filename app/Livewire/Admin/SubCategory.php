<?php
namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SubCategory extends Component
{
    public $addSubCategoryModal = false;
    public $editSubCategoryModal = false;
    public $subCategoreis = [];
    public $currentPage = 1;
    public $pagination = [];
    public $SubCategoryDetailsModal = false;
    public $subCategory = [];
    public $categories = [];

    public function switchAddSubCategoryModal()
    {
        $this->addSubCategoryModal = !$this->addSubCategoryModal;
        // Close other modals when opening this one
        if ($this->addSubCategoryModal) {
            $this->SubCategoryDetailsModal = false;
            $this->editSubCategoryModal = false;
        }
    }

    public function mount()
    {
        $this->currentPage = request()->query('page', 1);
        $this->fetchSubCategories($this->currentPage);

        $this->fetchCategories();

       
    }


    public function fetchCategories(){
        $token = session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get(api_base_url() . '/categories/main' );

        if ($response->successful()) {
            $data = $response->json();
            
          return  $this->categories = $data['data']['mainCategories'] ?? [];
           
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load category details.');
            Session::flash('error', 'Failed to load category details.');
        }
    }

    public function SubCategoryDetails($id)
    {
  
        $id = Decrypt($id);

        // Close other modals before opening details
        $this->addSubCategoryModal = false;
        $this->editSubCategoryModal = false;
        
        $this->SubCategoryDetailsModal = true;
      
        $this->fetchCategoryById($id);
    }

    public function closeDetailModal()
    {
        $this->SubCategoryDetailsModal = false;
        $this->reset(['subCategory']);
    }
    
    public function closeAddModal()
    {
        $this->addSubCategoryModal = false;
        
    }

    public function fetchCategoryById($id)
    {
        $token = session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get(api_base_url() . '/categories/sub/' . $id);

        if ($response->successful()) {
            $data = $response->json();
            
            $this->subCategory = $data['data'] ?? [];
           
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load category details.');
            Session::flash('error', 'Failed to load category details.');
        }
    }

    public function fetchSubCategories($page = 1)
    {
        $token = session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get(api_base_url() . '/categories/sub', [
            'page' => $page
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->subCategoreis = $data['data']['subCategories'] ?? [];
            $this->pagination = $data['data']['pagination'] ?? [];
            $this->currentPage = $page;
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load subcategories.');
            $this->subCategoreis = [];
            $this->pagination = [];
            Session::flash('error', 'Failed to load subcategories.');
        }
    }

    public function switchEditSubCategoryModal()
    {
        $this->editSubCategoryModal = !$this->editSubCategoryModal;
        if ($this->editSubCategoryModal) {
            $this->addSubCategoryModal = false;
            $this->SubCategoryDetailsModal = false;
        }
    }

    public function render()
    {
        return view('livewire.admin.sub-category', [
            'subCategoreis' => $this->subCategoreis,
            'subCategory'   => $this->subCategory,
            'categories'    => $this->categories,
        ]);
    }
}