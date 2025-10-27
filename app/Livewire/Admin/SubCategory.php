<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubCategory extends Component
{
    use WithFileUploads;
    public $addSubCategoryModal = false;
    public $editSubCategoryModal = false;
    public $subCategoreis = [];
    public $currentPage = 1;
    public $pagination = [];
    public $SubCategoryDetailsModal = false;
    public $subCategory = [];
    public $categories = [];
    public $editCategoryId = '';
    // Due to use  UI component SpecificCategoryId refer to main category id.
    public $specificCategoryId = '';

    // Form Data
    public $name = '';
    public $description = '';
    public $mainCategoryId = '';
    public $hasSpecificCategory = false;

    public $hasForm = false;
    public $hasMiniSubCategory = false;
    public $fromName = '';
    public $heroImage;
    public $image;

    // End Form Data

    public function switchAddSubCategoryModal()
    {
        $this->addSubCategoryModal = !$this->addSubCategoryModal;
        // Close other modals when opening this one
        if ($this->addSubCategoryModal) {
            $this->SubCategoryDetailsModal = false;
            $this->editSubCategoryModal = false;
        }
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'description',
            'mainCategoryId',
            'hasSpecificCategory',
            'hasForm',
            'hasMiniSubCategory',
            'fromName',
            'heroImage',
            'image',
            'specificCategoryId',
            'editCategoryId',
        ]);
    }

    public function mount()
    {
        $this->currentPage = request()->query('page', 1);
        $this->fetchSubCategories($this->currentPage);

        $this->fetchCategories();
    }

    public function applyFilters()
    {
        $this->fetchSubCategories($this->currentPage);
    }


    public function fetchCategories()
    {
        $token = session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get(api_base_url() . '/categories/main');

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
        $this->editSubCategoryModal = false;
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
            'page' => $page,
            'mainCategoryId' => $this->specificCategoryId,
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




    public function switchEditSubCategoryModal($id)
    {
        $this->editSubCategoryModal = !$this->editSubCategoryModal;

        $this->editCategoryId = Decrypt($id);

        if ($this->editSubCategoryModal) {
            $this->addSubCategoryModal = false;
            $this->SubCategoryDetailsModal = false;
        }

        $this->fetchCategoryById($this->editCategoryId);

        $this->fillUpdateForm();
    }

    public function closeEditModal()
    {
        $this->editSubCategoryModal = false;
        $this->resetForm();
    }

    public function fillUpdateForm()
    {
        $this->name = $this->subCategory['name'] ?? '';
        $this->hasSpecificCategory = $this->subCategory['hasSpecificCategory'] ?? false;
        $this->image = $this->subCategory['image'] ?? '';
        $this->heroImage = $this->subCategory['heroImage'] ?? '';

        // $this->description = $this->subCategory['description'] ?? '';
        // $this->mainCategoryId = $this->subCategory['mainCategoryId'] ?? '';
        // $this->hasForm = $this->subCategory['hasForm'] ?? false;
        // $this->hasMiniSubCategory = $this->subCategory['hasMiniSubCategory'] ?? false;
        // $this->fromName = $this->subCategory['fromName'] ?? '';


    }

    public function updateSubCategory()
    {

        $this->validate([
            'name' => 'required',
            'heroImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        try {
            $token = api_token();
            if (!$token) {
                $this->dispatch('sweetalert2', type: 'error', message: 'Authentication token not found.');
                return;
            }

            $payload = [
                'name' => $this->name,
                'hasSpecificCategory' => $this->hasSpecificCategory,
            ];

            $request = Http::withToken($token);

            if ($this->heroImage && !filter_var($this->heroImage, FILTER_VALIDATE_URL)) {
                $request->attach(
                    'heroImage',
                     file_get_contents($this->heroImage->getRealPath()),
                      $this->heroImage->getClientOriginalName());
            }
            if ($this->image && !filter_var($this->image, FILTER_VALIDATE_URL)) {
                $request->attach(
                    'image',
                     file_get_contents($this->image->getRealPath()),
                     $this->image->getClientOriginalName());
            }
            $response = $request->put(api_base_url() . '/categories/sub/' . $this->editCategoryId, $payload);

            if ($response->successful()) {
                $this->dispatch('sweetalert2', type: 'success', message: 'Category updated successfully!');
                $this->closeEditModal();
                $this->fetchSubCategories($this->currentPage);
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to update Sub Cateogry.');
            }

        } catch (\Exception $e) {
            dd('error' . $e->getMessage());
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

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->fetchSubCategories($this->currentPage - 1);
        }
    }

    public function nextPage()
    {
        if ($this->currentPage < ($this->pagination['pages'] ?? 1)) {
            $this->fetchSubCategories($this->currentPage + 1);
        }
    }

    public function gotoPage($page)
    {
        $this->fetchSubCategories($page);
    }

    public function deleteSubCategory($id): void
    {
        $id = Decrypt($id);

        $this->delete($id);
    }

    protected function delete($id): void
    {
        $response = Http::withToken(api_token())->delete(api_base_url() . '/categories/sub/' . $id);

        if ($response->successful()) {
            $this->dispatch('sweetalert2', type: 'success', message: 'SubCategory deleted successfully.');
            $this->fetchSubCategories($this->currentPage);
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to delete SubCategory.');
        }
    }

    public function render()
    {

        // Serach Component
        $dropdowns = [
            [
                'name' => 'main_category_id',
                'default' => 'Category',
                'options' => $this->categories,
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
                'method' => 'switchAddSubCategoryModal',
                'text' => 'Add',
                'icon' => 'plus',
                'id' => 'add_category_button',
            ],
        ];

        // End Serach Component
        $pages = $this->getPaginationPages();
        $hasPrevious = $this->currentPage > 1;
        $hasNext = $this->currentPage < ($this->pagination['pages'] ?? 1);

        return view('livewire.admin.sub-category', [
            'pages' => $pages,
            'hasPrevious' => $hasPrevious,
            'hasNext' => $hasNext,
            'subCategoreis' => $this->subCategoreis,
            'subCategory'   => $this->subCategory,
            'dropdowns' => $dropdowns,
            'buttons' => $buttons

        ]);
    }
}
