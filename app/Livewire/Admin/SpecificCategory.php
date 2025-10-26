<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Component;


class SpecificCategory extends Component
{
    public $subCategories = [];
    public $pagination = [];
    public $currentPage = 1;
    public $specificCategories  = [];
    public $specificCategory = [];
    public $SpecificCategoryDetailsModal = false;
    // Due to using components, Specific Category id refer to Sub Category id

    public $specificCategoryId = null;
    public function mount() {
        $this->fetchSubCategories($this->currentPage);
    }

    public function fetchSubCategories() {

                $token = session()->get('api_token');
                if (!$token) {
                    return $this->redirectRoute('login', navigate: true);
                }

                $response = Http::withToken($token)->get(api_base_url() . '/categories/sub');

                if ($response->successful()) {
                    $data = $response->json();
                    $this->subCategories = $data['data']['subCategories'] ?? [];
                } else {
                    $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load subcategories.');
                    $this->subCategories = [];
                    $this->pagination = [];
                    Session::flash('error', 'Failed to load subcategories.');
                }

    }

    public function applyFilters(){

        $this->fetchSpecificCategories();

    }

    protected function fetchSpecificCategories(){

        $token = session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get(api_base_url() . '/categories/specific?subCategoryId=' . $this->specificCategoryId);

        if ($response->successful()) {
            $data = $response->json();
            $this->specificCategories = $data['data']['specificCategories'] ?? [];
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load specific categories.');
            $this->specificCategories = [];
            $this->pagination = [];
            Session::flash('error', 'Failed to load specific categories.');
        }

    }

    public function SpecificDetails($id){

        $this->SpecificCategoryDetailsModal = true;

        $id = Decrypt($id);

        $this->fetchSpecificCategoriesById($id);
    }

    public function  closeDetailModal(){

        $this->SpecificCategoryDetailsModal = false;
    }
    protected function fetchSpecificCategoriesById($id){

        try{
                 $token = session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get(api_base_url() . '/categories/specific/' . $id);

        if ($response->successful()) {
            $data = $response->json();
            $this->specificCategory = $data['data'] ?? [];
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load specific categories.');
            $this->specificCategory = [];
            $this->pagination = [];
            Session::flash('error', 'Failed to load specific categories.');
        }
        }catch (\Exception $e) {

            Log::error( $e->getMessage());
            dd('error', $e->getMessage());
        }

    }
    public function render()
    {
       
        return view('livewire.admin.specific-category',[
            'categories' => $this->subCategories,
            'specificCategories' => $this->specificCategories,
            'specificCategory' => $this->specificCategory,
        ]);
    }
}
