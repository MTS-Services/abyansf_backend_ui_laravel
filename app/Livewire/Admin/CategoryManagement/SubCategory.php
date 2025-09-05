<?php

namespace App\Livewire\Admin\CategoryManagement;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class SubCategory extends Component
{
    use WithFileUploads;



    public $contractWhatsappSubCategory = false;


    public $addSubCategoryModal = false;
    public $editSubCategoryModal = false;

    public $subCategories = [];
    public $pagination = [];
    public $currentPage = 1;
    public $openActions = null;


    public $name;
    public $mainCategoryId;
    public $hasSpecificCategory = false; // default false
    public $description;
    public $contractWhatsapp;
    public $hasMiniSubCategory = false; // default false
    public $image; // Temporary image
    public $heroImage; // Temporary hero image
    public $mainCategories = [];
    public $subCategoryId; // Added to fix undefined property error


    public function switchAddSubCategoryModal()
    {
        $this->addSubCategoryModal = !$this->addSubCategoryModal;
    }

    public function switchEditSubCategoryModal($subCategoryId = null)
    {
        $this->editSubCategoryModal = !$this->editSubCategoryModal;
        if ($this->editSubCategoryModal && $subCategoryId) {
            $this->fetchMainCategory($subCategoryId);
        }
    }

    public function mount()
    {
        $this->currentPage = request()->query('page', 1);
        $this->fetchSubCategory($this->currentPage);
        $this->fetchMainCategory();
    }

    /**
     * Fetches users from the API.
     * @param int $page The page number to fetch.
     */
    public function fetchSubCategory($page = 1)
    {
        $token = Session::get('api_token');

        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get(api_base_url() . '/categories/sub', [
            'page' => $page
        ]);
        // dd($response->json());

        if ($response->successful()) {
            $data = $response->json();
            // $this->dispatch('sweetalert2', type: 'success', message: 'Bookings loaded successfully.');
            $this->subCategories = $data['data']['subCategories'] ?? [];
            $this->pagination = $data['data']['pagination'] ?? [];
            $this->currentPage = $page;
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load SubCategory from the API.');
            $this->subCategories
                = [];
            $this->pagination = [];
            Session::flash('error', 'Failed to load SubCategory from the API.');
        }
    }

    //main category
      public function fetchMainCategory()
    {
        $token = Session::get('api_token');

        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        try {
            $response = Http::withToken($token)->get(api_base_url() . '/categories/main');

            if ($response->successful()) {
                $this->mainCategories = $response->json()['data'] ?? [];
            } else {
                $this->mainCategories = [];
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load main categories.');
            }
        } catch (\Exception $e) {
            $this->mainCategories = [];
            $this->dispatch('sweetalert2', type: 'error', message: 'API connection failed: ' . $e->getMessage());
        }
    }

    public function toggleActions($subCategoryId)
    {
        if ($this->openActions === $subCategoryId) {
            $this->openActions = null;
        } else {
            $this->openActions = $subCategoryId;
        }
    }

    public function saveSubCategory()
    {
        $this->validate([
            'name' => 'required|string',
            'mainCategoryId' => 'required',
            'hasSpecificCategory' => 'nullable|boolean',
            'description' => 'nullable|string',
            'contractWhatsapp' => 'nullable|numeric',
            'hasMiniSubCategory' => 'nullable|boolean',
        ]);

        $imagePath = $this->image ? $this->image->store('images/subcategories', 'public') : null;
        $heroImagePath = $this->heroImage ? $this->heroImage->store('images/subcategories/hero', 'public') : null;

        // Send request to the correct subcategory endpoint
        $response = Http::withToken(api_token())->post(api_base_url() . '/categories/sub', [
            'name' => $this->name,
            'mainCategoryId' => $this->mainCategoryId,
            'hasSpecificCategory' => $this->hasSpecificCategory,
            'description' => $this->description,
            'contractWhatsapp' => $this->contractWhatsapp,
            'hasMiniSubCategory' => $this->hasMiniSubCategory,
            'image' => $imagePath,
            'heroImage' => $heroImagePath,
        ]);

        // Response check
        if ($response->successful()) {
            $this->reset(['name', 'mainCategoryId', 'hasSpecificCategory', 'description', 'contractWhatsapp', 'hasMiniSubCategory', 'image', 'heroImage']);
            $this->switchAddSubCategoryModal();
            $this->dispatch('sweetalert2', type: 'success', message: 'Category created successfully.');
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to create category: ' . $response->json()['message']);
            // If you want to keep the modal open on error, remove this line:
            $this->switchAddSubCategoryModal();
        }
    }

    // app/Livewire/Admin/CategoryManagement/SubCategory.php

    public function openEditSubCategory($subCategoryId)
    {
        $this->subCategoryId = $subCategoryId;

        // Correcting the API call to use the decrypted ID
        $decryptedId = decrypt($subCategoryId);
        $response = Http::withToken(api_token())->get(api_base_url() . "/categories/sub/{$decryptedId}");
       
         dd($response->json());

        if ($response->successful()) {
            
            $data = $response->json()['data'] ?? null;

            if ($data) {
                // Assign the fetched data to the public properties
                $this->name = $data['name'] ?? '';
                $this->mainCategoryId = $data['mainCategoryId'] ?? '';
                $this->hasSpecificCategory = $data['hasSpecificCategory'] ?? false;
                $this->description = $data['description'] ?? '';
                $this->contractWhatsapp = $data['contractWhatsapp'] ?? '';
                $this->hasMiniSubCategory = $data['hasMiniSubCategory'] ?? false;

                // For images, you might need a different approach. For now, we'll just store the path.
                $this->image = $data['image'] ?? '';
                $this->heroImage = $data['heroImage'] ?? '';

                // Open the modal after data is loaded
                $this->editSubCategoryModal = true;
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Sub Category data not found.');
            }
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to fetch sub category details.');
        }
    }
    public function deleteSubCategory($subCategoryId)
    {
        $subCategoryId = decrypt($subCategoryId);

        $response = Http::withToken(api_token())
            ->delete(api_base_url() . '/categories/sub/' . $subCategoryId);

        if ($response->successful()) {
            $data = $response->json(); // Optionally, get data to check if deletion was successful on the API side.



            $this->fetchSubCategory(); // Fetch the subcategories for the current page.

            $this->dispatch('sweetalert2', type: 'success', message: 'Sub Category deleted successfully.');
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to delete sub category.');
        }
    }
    public function gotoPage($page)
    {
        if ($page >= 1 && $page <= ($this->pagination['pages'] ?? 1)) {
            $this->fetchSubCategory($page);
        }
    }



    /**
     * Navigate to the previous page.
     */
    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->fetchSubCategory($this->currentPage - 1);
        }
    }

    /**
     * Navigate to the next page.
     */
    public function nextPage()
    {
        if ($this->currentPage < ($this->pagination['pages'] ?? 1)) {
            $this->fetchSubCategory($this->currentPage + 1);
        }
    }

    /**
     * Get the pagination pages to display based on your custom logic.
     * This matches the design pattern shown in your image.
     */
    public function getPaginationPages()
    {
        $pages = [];
        $current = $this->currentPage;
        $total = $this->pagination['pages'] ?? 1;

        // If only 1 page, show just that page
        if ($total == 1) {
            return [1];
        }

        // If 2-4 pages, show all pages
        if ($total <= 4) {
            for ($i = 1; $i <= $total; $i++) {
                $pages[] = $i;
            }
            return $pages;
        }

        // For 5+ pages, implement the custom logic from your design
        if ($current == 1) {
            // Current page is 1: show [1, 2, ..., last]
            $pages = [1, 2, '...', $total];
        } elseif ($current == 2) {
            // Current page is 2: show [1, 2, 3, ..., last]
            $pages = [1, 2, 3, '...', $total];
        } elseif ($current == 3) {
            // Current page is 3: show [1, 2, 3, 4, ..., last]
            $pages = [1, 2, 3, 4, '...', $total];
        } elseif ($current == $total) {
            // Current page is last: show [1, ..., last-1, last]
            $pages = [1, '...', $total - 1, $total];
        } elseif ($current == $total - 1) {
            // Current page is second to last: show [1, ..., last-2, last-1, last]
            $pages = [1, '...', $total - 2, $total - 1, $total];
        } elseif ($current == $total - 2) {
            // Current page is third from last: show [1, ..., total-3, total-2, total-1, total]
            $pages = [1, '...', $total - 3, $total - 2, $total - 1, $total];
        } else {
            // Middle pages: show [1, ..., current-1, current, current+1, ..., last]
            $pages = [1, '...', $current - 1, $current, $current + 1, '...', $total];
        }

        return $pages;
    }
    public function render()
    {
        $response = Http::withToken(api_token())->get(api_base_url() . '/categories/main');

        if ($response->successful()) {
            $data = $response->json();
            // $this->dispatch('sweetalert2', type: 'success', message: 'Bookings loaded successfully.');
            $this->mainCategories = $data['data']['mainCategories'] ?? [];
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load bookings from the API.');
            $this->mainCategories
                = [];
        }

        $pages = $this->getPaginationPages();
        $hasPrevious = $this->currentPage > 1;
        $hasNext = $this->currentPage < ($this->pagination['pages'] ?? 1);
        return view('livewire.admin.category-management.sub-category', [
            'mainCategories' => $this->mainCategories,
            'pages' => $pages,
            'hasPrevious' => $hasPrevious,
            'hasNext' => $hasNext,
        ]);
    }
}
