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
    public $contactWhatsapp = false;
    public $hasForm = false;
    public $fromName = null;
    public $image = null;
    public $existingImage = null;
    // End Form Data

    public function resetForm()
    {
        $this->reset([
            'name',
            'subCategoryId',
            'contactWhatsapp',
            'hasForm',
            'fromName',
            'image',
            'existingImage',
            'editMiniSubCategoryId'
        ]);
        
        // Reset validation errors
        $this->resetValidation();
    }

    public function mount()
    {
        $this->fetchMiniSubCategories();
    }

    public function fetchMiniSubCategories($page = 1)
    {
        $token = session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        try {
            $response = Http::withToken($token)->get(api_base_url() . '/categories/mini-sub', [
                'page' => $page,
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
        if ($this->addMiniSubCategoryModal) {
            // Modal is about to close, reset the form
            $this->resetForm();
            $this->subCategories = [];
        }

        $this->addMiniSubCategoryModal = !$this->addMiniSubCategoryModal;

        if ($this->addMiniSubCategoryModal) {
            // Modal is opening, fetch subcategories
            $this->fetchSubCategoreis();
        }
    }

    public function closeAddModal()
    {
        $this->addMiniSubCategoryModal = false;
        $this->resetForm();
        $this->subCategories = [];
    }

    public function SaveMiniCategory()
    {
        // Validate form data
        try {
            $this->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'subCategoryId' => 'required',
                'contactWhatsapp' => 'nullable|boolean',
                'hasForm' => 'nullable|boolean',
                'fromName' => 'nullable|string|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Keep modal open on validation error
            throw $e;
        }

        try {
            $token = api_token();
            if (!$token) {
                return $this->redirectRoute('login', navigate: true);
            }

            $payload = [
                'name' => $this->name,
                'subCategoryId' => $this->subCategoryId,
                'contractWhatsapp' => $this->contactWhatsapp ? 'true' : 'false',
                'hasForm' => $this->hasForm ? 'true' : 'false',
            ];

            // Only add fromName if hasForm is true
            if ($this->hasForm && $this->fromName) {
                $payload['fromName'] = $this->fromName;
            }

            $request = Http::withToken($token);

            if ($this->image && !filter_var($this->image, FILTER_VALIDATE_URL)) {
                $request->attach(
                    'image',
                    file_get_contents($this->image->getRealPath()),
                    $this->image->getClientOriginalName()
                );
            }

            $response = $request->post(api_base_url() . '/categories/mini-sub/', $payload);

            if ($response->successful()) {
                $this->closeAddModal();
                $this->fetchMiniSubCategories();
                $this->dispatch('sweetalert2', type: 'success', message: 'Mini Sub Category created successfully.');
            } else {
                $errorMessage = $response->json()['message'] ?? 'Failed to create Mini Sub Category.';
                Log::error('Mini Sub Category Create Error:', $response->json());
                $this->dispatch('sweetalert2', type: 'error', message: $errorMessage);
            }
        } catch (\Throwable $th) {
            Log::error('Mini Sub Category create Error: ' . $th->getMessage());
            $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred while creating mini category.');
        }
    }

    public function switchEditMiniSubCategoryModal($id)
    {
        $this->resetForm();
        $id = Decrypt($id);
        $this->editMiniSubCategoryId = $id;
        $this->fetchMiniSubCategoryById($this->editMiniSubCategoryId);
        $this->fetchSubCategoreis();
        $this->openEditModal();
    }

    public function closeDetailModal()
    {
        $this->MiniSubCategoryDetailsModal = false;
        $this->miniSubCategory = [];
    }

    public function openEditModal()
    {
        $this->editMiniSubCategoryModal = true;
    }

    public function closeEditModal()
    {
        $this->editMiniSubCategoryModal = false;
        $this->resetForm();
        $this->subCategories = [];
    }

    public function updateMiniCategory()
    {
        // Validate form data
        try {
            $this->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'subCategoryId' => 'required',
                'contactWhatsapp' => 'nullable|boolean',
                'hasForm' => 'nullable|boolean',
                'fromName' => 'nullable|string|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Keep modal open on validation error
            throw $e;
        }

        try {
            $token = api_token();
            if (!$token) {
                return $this->redirectRoute('login', navigate: true);
            }

            $payload = [
                'name' => $this->name,
                'subCategoryId' => $this->subCategoryId,
                'contractWhatsapp' => $this->contactWhatsapp ? 'true' : 'false',
                'hasForm' => $this->hasForm ? 'true' : 'false',
            ];

            // Only add fromName if hasForm is true
            if ($this->hasForm && $this->fromName) {
                $payload['fromName'] = $this->fromName;
            }

            $request = Http::withToken($token);

            // Only attach new image if user uploaded one
            if ($this->image && is_object($this->image)) {
                $request->attach(
                    'image',
                    file_get_contents($this->image->getRealPath()),
                    $this->image->getClientOriginalName()
                );
            }

            $response = $request->put(api_base_url() . '/categories/mini-sub/' . $this->editMiniSubCategoryId, $payload);

            if ($response->successful()) {
                $this->closeEditModal();
                $this->fetchMiniSubCategories();
                $this->dispatch('sweetalert2', type: 'success', message: 'Mini Sub Category updated successfully.');
            } else {
                $errorMessage = $response->json()['message'] ?? 'Failed to update Mini Sub Category.';
                Log::error('Mini Sub Category Update Error:', $response->json());
                $this->dispatch('sweetalert2', type: 'error', message: $errorMessage);
            }
        } catch (\Throwable $th) {
            Log::error('Mini Sub Category Update Error: ' . $th->getMessage());
            $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred while updating mini category.');
        }
    }

    public function MiniCategoryDetail($id)
    {
        $this->switchDetailModal();
        $id = Decrypt($id);
        $this->fetchMiniSubCategoryById($id);
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

        // Properly convert boolean values
        $this->contactWhatsapp = ($this->miniSubCategory['contractWhatsapp'] ?? false) === true ||
            ($this->miniSubCategory['contractWhatsapp'] ?? '') === 'true';

        $this->hasForm = ($this->miniSubCategory['hasForm'] ?? false) === true ||
            ($this->miniSubCategory['hasForm'] ?? '') === 'true';

        $this->fromName = $this->miniSubCategory['fromName'] ?? null;
        $this->subCategoryId = $this->miniSubCategory['subCategory']['id'] ?? null;
        
        // Set existing image URL for display - check img field from API
        $this->existingImage = $this->miniSubCategory['img'] ?? null;
        
        // Clear any new image upload
        $this->image = null;

        // Debug log to check what we're getting
        Log::info('Fill Form Values:', [
            'name' => $this->name,
            'contactWhatsapp' => $this->contactWhatsapp,
            'hasForm' => $this->hasForm,
            'fromName' => $this->fromName,
            'subCategoryId' => $this->subCategoryId,
            'existingImage' => $this->existingImage,
            'raw_img' => $this->miniSubCategory['img'] ?? 'not found',
        ]);
    }
    
    public function removeExistingImage()
    {
        $this->existingImage = null;
    }

    public function fetchSubCategoreis($limit = 100)
    {
        $token = session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        try {
            $response = Http::withToken($token)->get(api_base_url() . '/categories/sub', [
                'limit' => $limit,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $this->subCategories = $data['data']['subCategories'] ?? [];
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load subcategories.');
                Session::flash('error', 'Failed to load subcategories.');
            }
        } catch (\Throwable $th) {
            Log::error('Fetching Sub Categories Error: ' . $th->getMessage());
        }
    }

    public function fetchMiniSubCategoryById($id)
    {
        $token = session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        try {
            $response = Http::withToken($token)->get(api_base_url() . '/categories/mini-sub/' . $id);

            if ($response->successful()) {
                $data = $response->json();
                $this->miniSubCategory = $data['data'] ?? [];
                $this->fillForm();
            } else {
                if ($this->editMiniSubCategoryModal) {
                    $this->closeEditModal();
                } else {
                    $this->switchDetailModal();
                }
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load mini subcategory details.');
                Session::flash('error', 'Failed to load mini subcategory details.');
            }
        } catch (\Throwable $th) {
            Log::error('Fetching Mini Sub Category by Id Error: ' . $th->getMessage());
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

    public function nextPage()
    {
        if ($this->currentPage < ($this->pagination['pages'] ?? 1)) {
            $this->fetchMiniSubCategories($this->currentPage + 1);
        }
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->fetchMiniSubCategories($this->currentPage - 1);
        }
    }

    public function gotoPage($page)
    {
        $this->fetchMiniSubCategories($page);
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
            'items' => $this->miniSubCategoreis,
            'columns' => $columns,
            'actions' => $actions
        ]);
    }
}