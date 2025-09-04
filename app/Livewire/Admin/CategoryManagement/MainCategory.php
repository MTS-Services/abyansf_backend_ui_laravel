<?php

namespace App\Livewire\Admin\CategoryManagement;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class MainCategory extends Component
{
    public $addCategoryModal = false;
    public $editCategoryModal = false;

    public $category;
    public $mainCategoryId;
    public $title;
    public $name;

    public $mainCategories = [];
    public $pagination = [];
    public $openActions = null;
    public $parentCategory = null;

    // Add this property to sync currentPage with the URL
    public $currentPage = 1;

    protected $queryString = [
        'currentPage' => ['as' => 'page', 'except' => 1]
    ];

    /**
     * Livewire's lifecycle hook that runs once on component initialization.
     */
    public function mount()
    {
        $this->currentPage = request()->query('page', 1);
        $this->fetchMainCategory($this->currentPage);
    }

    /**
     * Fetches users from the API.
     * @param int $page The page number to fetch.
     */
    public function fetchMainCategory($page = 1)
    {
        $token = Session::get('api_token');

        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get(api_base_url() . '/categories/main', [
            'page' => $page
        ]);

        if ($response->successful()) {
            $data = $response->json();
            // $this->dispatch('sweetalert2', type: 'success', message: 'Bookings loaded successfully.');
            $this->mainCategories = $data['data']['mainCategories'] ?? [];
            $this->pagination = $data['data']['pagination'] ?? [];
            $this->currentPage = $page;
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load bookings from the API.');
            $this->mainCategories
                = [];
            $this->pagination = [];
            Session::flash('error', 'Failed to load bookings from the API.');
        }
    }

    public function saveCategory()
    {

        // Validate
        $this->validate([
            'title' => 'required|string',
        ]);

        // Send request
        // $response = Http::withToken(api_token())->post(api_base_url() . '/categories/main', [
        //     'title' => $this->title,
        // ]);
        $response = Http::withToken(api_token())->post(api_base_url() . '/categories/main', [
            'name' => $this->title
        ]);
        // dd($response->json());
        // Response check
        if ($response->successful()) {
            $this->reset(['title']);
            $this->switchAddCategoryModal();
            $this->dispatch('sweetalert2', type: 'success', message: 'Category created successfully.');
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: $response->json()['message']);
            $this->switchAddCategoryModal();
        }
    }


    public function openCategory()
    {
        $this->addCategoryModal = true;
    }

    /**
     * Toggles the action dropdown for a specific user.
     * @param int $userId The ID of the user.
     */
    public function toggleActions($categoryId)
    {
        if ($this->openActions === $categoryId) {
            $this->openActions = null;
        } else {
            $this->openActions = $categoryId;
        }
    }
   public function deleteCategory($categoryId)
{
    $response = Http::withToken(api_token())
        ->delete(api_base_url() . '/categories/main/' . decrypt($categoryId));

    if ($response->successful()) {
        $this->fetchMainCategory($this->currentPage);
        $this->dispatch('sweetalert2', type: 'success', message: 'Category deleted successfully.');
    } else {
        $this->dispatch('sweetalert2', type: 'error', message: 'Failed to delete category.');
    }
}

public function openEditCategory($mainCategoryId)
{
    

 $this->mainCategoryId = $mainCategoryId;

        $decryptedId = decrypt($mainCategoryId);
        $response = Http::withToken(api_token())->get(api_base_url() . "/categories/main/{$decryptedId}");

        if ($response->successful()) {
            $json = $response->json();

            if (isset($json['data'])) {
                $mainCategory = $json['data'];

                $this->name       = $mainCategory['name'] ?? '';
            
            }
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to fetch main category details.');
        }
}

    public function gotoPage($page)
    {
        if ($page >= 1 && $page <= ($this->pagination['pages'] ?? 1)) {
            $this->fetchMainCategory($page);
        }
    }



    /**
     * Navigate to the previous page.
     */
    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->fetchMainCategory($this->currentPage - 1);
        }
    }

    /**
     * Navigate to the next page.
     */
    public function nextPage()
    {
        if ($this->currentPage < ($this->pagination['pages'] ?? 1)) {
            $this->fetchMainCategory($this->currentPage + 1);
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

    public function switchAddCategoryModal()
    {
        $this->addCategoryModal = !$this->addCategoryModal;
    }

    public function openEditCategoryModal()
    {
        $this->editCategoryModal = true;
    }

    // This method will close the modal (and can be used by the 'x' button)
    public function switchEditCategoryModel($mainCategoryId = null)
    {
        $this->editCategoryModal = !$this->editCategoryModal;
       if ($this->editCategoryModal && $mainCategoryId) {
            $this->openEditCategory($mainCategoryId); 
        }
    }

    public function render()
    {
        $pages = $this->getPaginationPages();
        $hasPrevious = $this->currentPage > 1;
        $hasNext = $this->currentPage < ($this->pagination['pages'] ?? 1);
        return view('livewire.admin.category-management.main-category', [
            'pages' => $pages,
            'hasPrevious' => $hasPrevious,
            'hasNext' => $hasNext,
        ]);
    }
}
