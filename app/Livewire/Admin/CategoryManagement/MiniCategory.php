<?php

namespace App\Livewire\Admin\CategoryManagement;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class MiniCategory extends Component
{
    use WithFileUploads;
    public $addMiniCategoryModal = false;
    public $editMiniCategoryModal = false;
    public $miniSubCategories = [];
    public $pagination = [];
    public $currentPage = 1;
    public $openActions;
    public $subCategories;


    public $name;
    public $formName; // Add this missing public property
    public $description;
    public $mainCategoryId;
    public $subCategoryId;
    public $image;
    public $hasForm = false;

    public function switchAddMiniCategoryModal()
    {
        $this->addMiniCategoryModal = !$this->addMiniCategoryModal;
    }

    public function switchEditMiniCategoryModal()
    {
        $this->editMiniCategoryModal = !$this->editMiniCategoryModal;
    }

    public function mount()
    {

        $this->currentPage = request()->query('page', 1);
        $this->fetchMiniSubCategories($this->currentPage);

        $response = Http::withToken(api_token())->get(api_base_url() . '/categories/sub');
        if ($response->successful()) {
            $this->subCategories = $response->json()['data'];
        }


        // $this->fetchMainCategory();

    }

    /**
     * Fetches users from the API.
     * @param int $page The page number to fetch.
     */
    public function fetchMiniSubCategories($page = 1)
    {
        $token = Session::get('api_token');

        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get(api_base_url() . '/categories/mini-sub', [
            'page' => $page
        ]);
        // dd($response->json());

        if ($response->successful()) {
            $data = $response->json();
            // $this->dispatch('sweetalert2', type: 'success', message: 'Bookings loaded successfully.');
            $this->miniSubCategories = $data['data']['miniSubCategories'] ?? [];
            $this->pagination = $data['data']['pagination'] ?? [];
            $this->currentPage = $page;
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load Mini SubCategory from the API.');
            $this->miniSubCategories
                = [];
            $this->pagination = [];
            Session::flash('error', 'Failed to load Mini SubCategory from the API.');
        }
    }

    // Inside your Livewire component

    public function saveMiniSubCategories()
    {
        // Run validation
        $this->validate([
            'name' => 'required|string|min:3',
            'formName' => 'required|string',
            'hasForm' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'subCategoryId' => 'required|integer',
        ]);

        $request = Http::withToken(api_token())->asMultipart();

        if ($this->image && is_object($this->image)) {
            $request->attach('image', file_get_contents($this->image->getRealPath()), $this->image->getClientOriginalName());
        }

        // Pass the sub_category_id in the request body
        $response = $request->post(api_base_url() . '/categories/mini-sub', [
            // Update these keys to match what your API expects
            'mini_sub_category_name' => $this->name, // Changed `name` to `mini_sub_category_name`
            'parent_sub_category_id' => $this->subCategoryId, // Changed `sub_category_id` to `parent_sub_category_id`
            'formName' => $this->formName,
            'hasForm' => $this->hasForm,
        ]);

        if ($response->successful()) {
            $this->reset(['name', 'formName', 'hasForm', 'image', 'subCategoryId']);
            $this->switchAddMiniCategoryModal();
            $this->dispatch('sweetalert2', type: 'success', message: 'Mini Category created successfully.');
            $this->fetchMiniSubCategories();
        } else {
            $message = $response->json()['message'] ?? 'An unknown error occurred.';
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to create Mini category: ' . $message);
        }
    }


    public function deleteMiniSubCategory($miniSubCategoryId)
    {
        $miniSubCategoryId = decrypt($miniSubCategoryId);

        $response = Http::withToken(api_token())
            ->delete(api_base_url() . '/categories/mini-sub/' . $miniSubCategoryId);

        if ($response->successful()) {
            $data = $response->json(); // Optionally, get data to check if deletion was successful on the API side.



            $this->fetchMiniSubCategory(); // Fetch the subcategories for the current page.

            $this->dispatch('sweetalert2', type: 'success', message: 'Sub Category deleted successfully.');
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to delete sub category.');
        }
    }
    public function toggleActions($miniSubCategoryId)
    {
        if ($this->openActions === $miniSubCategoryId) {
            $this->openActions = null;
        } else {
            $this->openActions = $miniSubCategoryId;
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
        $response = Http::withToken(api_token())->get(api_base_url() . '/categories/sub');
        if ($response->successful()) {
            $data = $response->json();
            // $this->dispatch('sweetalert2', type: 'success', message: 'Bookings loaded successfully.');
            $this->subCategories = $data['data']['subCategories'] ?? [];
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load bookings from the API.');
            $this->subCategories
                = [];
        }
        $pages = $this->getPaginationPages();
        $hasPrevious = $this->currentPage > 1;
        $hasNext = $this->currentPage < ($this->pagination['pages'] ?? 1);
        return view('livewire.admin.category-management.mini-category', [
            'subCategories' => $this->subCategories,
            'pages' => $pages,
            'hasPrevious' => $hasPrevious,
            'hasNext' => $hasNext,
        ]);
    }
}
