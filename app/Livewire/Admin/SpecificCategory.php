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
    public $editSpecificCategoryModal = false;
    public $addSpecificCategoryModal = false;
    public $specificCategoryId = null;
    public $sub_category_id = null;
    public $name = null;

    public function mount()
    {
        $this->fetchSubCategories();
    }

    public function resetForm()
    {
        $this->reset(
            'name',
            'sub_category_id',
            'specificCategoryId',
            'specificCategory'
        );
    }
    public function fillForm(array $data)
    {

        $this->name = $data['name'];
        $this->sub_category_id = $data['subCategoryId'];
    }
    public function fetchSubCategories($limit = 100)
    {

        $token = session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get(api_base_url() . '/categories/sub',[
            'limit' => $limit
        ]);

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

    public function applyFilters()
    {

        $this->fetchSpecificCategories();
    }

    protected function fetchSpecificCategories()
    {


        $token = session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get(api_base_url() . '/categories/specific', [

            'subCategoryId' => $this->sub_category_id,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->specificCategories = $data['data']['specificCategories'] ?? [];
            // $this->sub_category_id = null;

        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load specific categories.');
            $this->specificCategories = [];
            $this->pagination = [];
            Session::flash('error', 'Failed to load specific categories.');
        }
    }

    public function switchAddSpecificCategoryModal()
    {
        $this->addSpecificCategoryModal = !$this->addSpecificCategoryModal;
    }

    public function closeAddModal()
    {
        $this->resetForm();
        $this->switchAddSpecificCategoryModal();
    }
    public function saveSpecificCategory()
    {

        $this->validate([
            'name' => 'required',
            'sub_category_id' => 'required',
        ]);
        $names = array_map('trim', explode(',', $this->name));

        $data = array_map(function ($name) {
            return ['name' => $name];
        }, $names);

     
        try {

            $token = api_token();
            if (!$token) {
                return $this->redirectRoute('login', navigate: true);
            }

            $response = Http::withToken($token)->post(api_base_url() . '/categories/specific/multiple', [
                'subCategoryId' => $this->sub_category_id,
                'specificCategories' => json_encode($data),
            ]);
            if ($response->successful()) {
                $this->dispatch('sweetalert2', type: 'success', message: 'Specific Category saved successfully.');
                $this->closeAddModal();
                $this->fetchSpecificCategories();
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to save specific category.');
                $this->fetchSpecificCategories();
                $this->closeAddModal();
            }
        } catch (\Throwable $th) {
            Log::error('Specific Category Save Error: ' . $th->getMessage());
        }
    }

    public function SpecificDelete($id)
    {

        $this->specificCategoryId = decrypt($id);

        $this->delete();
    }

    public function delete()
    {

        try {
            $token = api_token();
            if (!$token) {
                return $this->redirectRoute('login', navigate: true);
            }

            $response = Http::withToken($token)->delete(api_base_url() . '/categories/specific/' . $this->specificCategoryId);

            if ($response->successful()) {
                $this->dispatch('sweetalert2', type: 'success', message: 'Specific Category deleted successfully.');
                $this->fetchSpecificCategories();
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to delete specific category.');
                $this->fetchSpecificCategories();
            }
        } catch (\Throwable $th) {
            Log::error('Specific Category Delete Error: ' . $th->getMessage());
        }
    }

    public function SpecificDetails($id)
    {

        $this->SpecificCategoryDetailsModal = true;

        $id = Decrypt($id);

        $this->fetchSpecificCategoriesById($id);
    }

    public function  closeDetailModal()
    {

        $this->SpecificCategoryDetailsModal = false;
    }
    protected function fetchSpecificCategoriesById($id)
    {

        try {
            $token = session()->get('api_token');
            if (!$token) {
                return $this->redirectRoute('login', navigate: true);
            }

            $response = Http::withToken($token)->get(api_base_url() . '/categories/specific/' . $id);

            if ($response->successful()) {
                $data = $response->json();
                $this->specificCategory = $data['data'] ?? [];

                $this->fillForm($this->specificCategory);
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load specific categories.');
                $this->specificCategory = [];
                $this->pagination = [];
                Session::flash('error', 'Failed to load specific categories.');
            }
        } catch (\Exception $e) {

            Log::error('Specific Feteching error: ' . $e->getMessage());
        }
    }

    public function switchEditSepecificCategoryModal($id)
    {

        $id = Decrypt($id);

        $this->specificCategoryId = $id;

        $this->editSpecificCategoryModal = true;

        $this->fetchSpecificCategoriesById($id);
    }

    public function closeEditModal()
    {
        $this->resetForm();
        $this->editSpecificCategoryModal = false;
    }
    public function updateSpecificCategory()
    {
        $this->validate([
            'name' => 'required',
            'sub_category_id' => 'required',
        ]);
        try {
            $token = api_token();

            if (!$token) {
                return $this->redirectRoute('login', navigate: true);
            }

            $response = Http::withToken($token)->put(api_base_url() . '/categories/specific/' . $this->specificCategoryId, [
                'name' => $this->name,
                'subCategoryId' => $this->sub_category_id,
            ]);

            if ($response->successful()) {
                $this->editSpecificCategoryModal = false;
                $this->dispatch('sweetalert2', type: 'success', message: 'Specific Category updated successfully.');
                $this->closeEditModal();
                $this->fetchSpecificCategories();
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to update specific category.');
            }
        } catch (\Throwable $th) {
            Log::error('Specific Category Update Error: ' . $th->getMessage());
        }
    }
    public function render()
    {

        $dropdowns = [
            [
                'name' => 'sub_category_id',
                'default' => 'Sub Category',
                'options' => $this->subCategories,
            ],
        ];

        $buttons = [
            [
                'method' => 'applyFilters',
                'text' => 'Filter',
                'icon' => 'plus',
                'id' => 'filter_button',
            ],
            [
                'method' => 'switchAddSpecificCategoryModal',
                'text' => 'Add',
                'icon' => 'plus',
                'id' => 'add_specificCategory_button',
            ],
        ];

        // DataTable

        $columns = [
            [
                'key' => 'name',
                'label' => 'Specific Category Name',
            ],
            [
                'key' => 'createdAt',
                'label' => 'Created At',
                'format' => fn($item) => format_date_time($item),
            ],
            [
                'key' => 'updatedAt',
                'label' => 'Updated At',
                'format' => fn($item) => format_date_time($item),
            ]
        ];

        $actions = [
            [
                'key' => 'id',
                'label' => 'Details',
                'method' => 'SpecificDetails',
                'icon' => 'eye',
            ],
            [
                'key' => 'id',
                'label' => 'Edit',
                'method' => 'switchEditSepecificCategoryModal',
                'icon' => 'edit',
            ],
            [
                'key' => 'id',
                'label' => 'Delete',
                'method' => 'SpecificDelete',
                'icon' => 'trash',
            ],
        ];

        return view('livewire.admin.specific-category', [
            'dropdowns' => $dropdowns,
            'buttons' => $buttons,


            'items' => !empty($this->specificCategories) ?  $this->specificCategories : $this->fetchSpecificCategories(),
            'columns' => $columns,
            'actions' => $actions,
        ]);
    }
}
