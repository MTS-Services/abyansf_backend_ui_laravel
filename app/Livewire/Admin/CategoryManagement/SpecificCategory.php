<?php

namespace App\Livewire\Admin\CategoryManagement;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SpecificCategory extends Component
{

    public $addSpacificCategoryModal = false;
    public $editSpacificCategoryModal = false;
    public $sfacificCategories = [];

    public $currentPage = 1;
    public $subCategories = [];
    public $pagination = [];
    public $openActions = null;
    public $specificCategories = [];


    public function switchAddSpacificCategoryModal()
    {
        $this->addSpacificCategoryModal = !$this->addSpacificCategoryModal;
    }

    public function switchEditSpacificCategoryModal()
    {
        $this->editSpacificCategoryModal = !$this->editSpacificCategoryModal;
    }
    public function mount()
    {
        $this->currentPage = request()->query('page', 1);
        $this->fetchSpacificCategory($this->currentPage);
    }

    /**
     * Fetches users from the API.
     * @param int $page The page number to fetch.
     */
    public function fetchSpacificCategory($page = 1)
    {
        $token = Session::get('api_token');

        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get(api_base_url() . '/categories/specific', [
            'page' => $page
        ]);

        if ($response->successful()) {
            $data = $response->json();

            // Correct the variable name here
            $this->specificCategories = $data['data']['specificCategories'] ?? [];

            $this->pagination = $data['data']['pagination'] ?? [];
            $this->currentPage = $page;
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load SubCategory from the API.');

            // And here
            $this->specificCategories = [];

            $this->pagination = [];
            Session::flash('error', 'Failed to load SubCategory from the API.');
        }
    }
    public function toggleActions($sfacificCategoryId)
    {
        if ($this->openActions === $sfacificCategoryId) {
            $this->openActions = null;
        } else {
            $this->openActions = $sfacificCategoryId;
        }
    }
      public function deleteSpacificCategory($sfacificCategoryId)
    {
        $sfacificCategoryId = decrypt($sfacificCategoryId);

        $response = Http::withToken(api_token())
            ->delete(api_base_url() . '/categories/specific/' . $sfacificCategoryId);

        if ($response->successful()) {
            $data = $response->json(); // Optionally, get data to check if deletion was successful on the API side.



            $this->fetchSpacificCategory(); // Fetch the subcategories for the current page.

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
        $pages = $this->getPaginationPages();
        $hasPrevious = $this->currentPage > 1;
        $hasNext = $this->currentPage < ($this->pagination['pages'] ?? 1);
        return view(
            'livewire.admin.category-management.specific-category',
            [
                'pages' => $pages,
                'hasPrevious' => $hasPrevious,
                'hasNext' => $hasNext,
            ]
        );
    }
}
