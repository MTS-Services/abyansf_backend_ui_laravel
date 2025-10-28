<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class MiniCategoreis extends Component
{

    use WithFileUploads;

    public $miniSubCategoreis = [];

    public $miniSubCategory = [];

    public $subCategories = [];

    public $currentPage = 1;

    public $pagination = [];

    public $MiniSubCategoryDetailsModal = false;

    public $editMiniSubCategoryModal = false;

    public $editMiniSubCategoryId = null;

    public $addMiniSubCategoryModal = false;


    // Form Data

    public $name = null;
    public $subCategoryId = null;
    public $hasForm = null;
    public $fromName = null;
    public  $image = null;
    // End Form Data

    public function resetForm()
    {

        $this->reset(
            'name',
            'subCategoryId',
            'hasForm',
            'fromName',
            'image',
            'subCategories'
        );
    }
    public function mount()
    {
        $this->fetchMiniSubCategories();
    }

    public function fetchMiniSubCategories($page = null)
    {

        $token = session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        try {

            $response = Http::withToken($token)->get(api_base_url() . '/categories/mini-sub', [
                
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $this->miniSubCategoreis = $data['data']['miniSubCategories'] ?? [];
                $this->pagination = $data['data']['pagination'] ?? [];
                $this->currentPage = $page;
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load mini subcategories.');
                $this->miniSubCategoreis = [];
                $this->pagination = [];
                Session::flash('error', 'Failed to load mini subcategories.');
            }
        } catch (\Throwable $th) {

            Log::error('Mini Sub Categories Fetching Error: ' . $th->getMessage());
        }
    }

    public function switchDetailModal()
    {

        $this->MiniSubCategoryDetailsModal = !$this->MiniSubCategoryDetailsModal;
    }

    public function switchAddCategoryModal()
    {

        $this->addMiniSubCategoryModal = !$this->addMiniSubCategoryModal;
        $this->fetchSubCategoreis();
    }


    public function closeAddModal()
    {

        $this->addMiniSubCategoryModal = false;

        $this->resetForm();
    }


    public function SaveMiniCategory()
    {
        $this->validate(
            [
                'name' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'subCategoryId' => 'required',
            ]
        );


        try {
            $token = api_token();
            if (!$token) {
                return $this->redirectRoute('login', navigate: true);
            }
            $payload = [
                'name' => $this->name,
                'subCategoryId' => $this->subCategoryId,
                'hasForm' => $this->hasForm
            ];

            if ($this->hasForm) $payload['fromName'] = $this->fromName;

            $request = Http::withToken($token);

            if ($this->image && !filter_var($this->image, FILTER_VALIDATE_URL)) {
                $request->attach(
                    'image',
                    file_get_contents($this->image->getRealPath()),
                    $this->image->getClientOriginalName()
                );
            }

            $response = Http::withToken($token)->post(api_base_url() . '/categories/mini-sub/' , $payload);

            if ($response->successful()) {

                $this->closeAddModal();
                $this->fetchMiniSubCategories();
                $this->dispatch('sweetalert2', type: 'success', message: 'Mini Sub Category created successfully.');
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to create Mini Sub Category.');
                // Log::error('Mini Sub Category Update Error: ' . $response->body());
            }
        } catch (\Throwable $th) {
            Log::error('Mini Sub Category create Error: ' . $th->getMessage());
        }
    }
    public function switchEditMiniSubCategoryModal($id)
    {

        $this->openEditModal();

        $id = Decrypt($id);

        $this->editMiniSubCategoryId = $id;

        $this->fetchMiniSubCategoryById($this->editMiniSubCategoryId);

        $this->fetchSubCategoreis();
    }
    public function closeDetailModal()
    {
        $this->switchDetailModal();
        $this->miniSubCategory = [];
    }

    public function openEditModal()
    {

        $this->editMiniSubCategoryModal = !$this->editMiniSubCategoryModal;
    }
    public function closeEditModal()
    {

        $this->resetForm();
        $this->openEditModal();
    }

    public function updateMiniCategory()
    {

        $this->validate(
            [
                'name' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'subCategoryId' => 'required',
            ]
        );


        try {
            $token = api_token();
            if (!$token) {
                return $this->redirectRoute('login', navigate: true);
            }
            $payload = [
                'name' => $this->name,
                'subCategoryId' => $this->subCategoryId,
                'hasForm' => $this->hasForm
            ];

            if ($this->hasForm) $payload['fromName'] = $this->fromName;

            $request = Http::withToken($token);

            if ($this->image && !filter_var($this->image, FILTER_VALIDATE_URL)) {
                $request->attach(
                    'image',
                    file_get_contents($this->image->getRealPath()),
                    $this->image->getClientOriginalName()
                );
            }

            $response = Http::withToken($token)->put(api_base_url() . '/categories/mini-sub/' . $this->editMiniSubCategoryId, $payload);

            if ($response->successful()) {

                $this->closeEditModal();
                $this->fetchMiniSubCategories();
                $this->dispatch('sweetalert2', type: 'success', message: 'Mini Sub Category updated successfully.');
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to update Mini Sub Category.');
                // Log::error('Mini Sub Category Update Error: ' . $response->body());
            }
        } catch (\Throwable $th) {
            Log::error('Mini Sub Category Update Error: ' . $th->getMessage());
        }
    }

    public function MiniCategoryDetail($id)
    {

        $this->switchDetailModal();

        $id = Decrypt($id);

        $this->fetchMiniSubCategoriesId($id);
    }


    public function deleteMiniSubCategory($id)
    {

        $this->delete(decrypt($id));
    }

    public function delete($id)
    {

        try {
            $token = api_token();

            if (!$token) {
                return $this->redirectRoute('login', navigate: true);
            }

            $response = Http::withToken($token)->delete(api_base_url() . '/categories/mini-sub/' . $id);

            if ($response->successful()) {
                $this->fetchMiniSubCategories();
                $this->dispatch('sweetalert2', type: 'success', message: 'Mini Sub Category deleted successfully.');
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to delete Mini Sub Category.');
            }
        } catch (\Throwable $th) {
            Log::error('Delete Mini Sub Category Error: ' . $th->getMessage());
        }
    }
    public function fillForm()
    {

        $this->name = $this->miniSubCategory['name'] ?? null;
        $this->hasForm = $this->miniSubCategory['hasForm'] ?? null;
        $this->fromName = $this->miniSubCategory['fromName'] ?? null;
        $this->subCategoryId = $this->miniSubCategory['subCategory']['id'] ?? null;
    }

    public function fetchSubCategoreis()
    {

        $token = session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        try {

            $response  = Http::withToken($token)->get(api_base_url() . '/categories/sub');

            if ($response->successful()) {

                $data = $response->json();

                $this->subCategories = $data['data']['subCategories'] ?? [];
            } else {
                $this->switchDetailModal();
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load mini subcategories.');
                Session::flash('error', 'Failed to load mini subcategories.');
            }
        } catch (\Throwable $th) {

            Log::error('Fetching Mini Sub Categoriy by Id Error: ' . $th->getMessage());
        }
    }
    public function fetchMiniSubCategoryById($id)
    {

        $token = session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        try {

            $response  = Http::withToken($token)->get(api_base_url() . '/categories/mini-sub/' . $id);

            if ($response->successful()) {

                $data = $response->json();

                $this->miniSubCategory = $data['data'] ?? [];

                $this->fillForm($this->miniSubCategory);
            } else {
                $this->switchDetailModal();
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load mini subcategories.');
                Session::flash('error', 'Failed to load mini subcategories.');
            }
        } catch (\Throwable $th) {

            Log::error('Fetching Mini Sub Categoriy by Id Error: ' . $th->getMessage());
        }
    }
    public function getPaginationPages()
    {
        $pages = [];
        $current = $this->currentPage;
        $total = $this->pagination['pages'] ?? 1;

        if ($total == 1) {
            return [1];
        }

        if ($total <= 4) {
            for ($i = 1; $i <= $total; $i++) {
                $pages[] = $i;
            }
            return $pages;
        }

        if ($current == 1) {
            $pages = [1, 2, '...', $total];
        } elseif ($current == 2) {
            $pages = [1, 2, 3, '...', $total];
        } elseif ($current == 3) {
            $pages = [1, 2, 3, 4, '...', $total];
        } elseif ($current == $total) {
            $pages = [1, '...', $total - 1, $total];
        } elseif ($current == $total - 1) {
            $pages = [1, '...', $total - 2, $total - 1, $total];
        } elseif ($current == $total - 2) {
            $pages = [1, '...', $total - 3, $total - 2, $total - 1, $total];
        } else {
            $pages = [1, '...', $current - 1, $current, $current + 1, '...', $total];
        }

        return $pages;
    }

    public function nextPage(){
        $this->currentPage = $this->currentPage + 1;
        $this->fetchMiniSubCategories($this->currentPage);
    } 
    public function previousPage(){
        $this->currentPage = $this->currentPage + 1;
        $this->fetchMiniSubCategories($this->currentPage);
    }

    public function gotoPage($page){
        $this->currentPage = $page;
        $this->fetchMiniSubCategories($this->currentPage);
    }
    public function render()
    {
        // Data Table
        $columns = [
            [
                'key' => 'name',
                'label' => 'Mini Category Name',
            ],
            [
                'key' => 'subCategory',
                'label' => 'Sub Category name',
                'format' => fn($item) => $item['name'],
            ],
            [
                'key' => 'createdAt',
                'label' => 'Created At',
                'format' => fn($item) => format_date_time($item),
            ]
        ];

        $actions = [
            [
                'key' => 'id',
                'label' => 'Details',
                'method' => 'MiniCategoryDetail',
                'icon' => 'eye',
            ],
            [
                'key' => 'id',
                'label' => 'Edit',
                'method' => 'switchEditMiniSubCategoryModal',
                'icon' => 'pencil-square',
            ],
            [
                'key' => 'id',
                'label' => 'Delete',
                'method' => 'deleteMiniSubCategory',
                'icon' => 'trash',
            ],
        ];


        $pages = $this->getPaginationPages();
        $hasPrevious = $this->currentPage > 1;
        $hasNext = $this->currentPage < ($this->pagination['pages'] ?? 1);



        return view('livewire.admin.mini-categoreis', [
            'pages' => $pages,
            'hasPrevious' => $hasPrevious,
            'hasNext' => $hasNext,

            // DataTable

            'items' => $this->miniSubCategoreis,
            'columns' => $columns,
            'actions' => $actions
        ]);
    }
}
