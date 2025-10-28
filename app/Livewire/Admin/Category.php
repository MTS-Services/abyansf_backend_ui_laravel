<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Category extends Component
{
    public $addCategoryModal = false;
    public $editCategoryModal = false;

    public $category;

    public $name;

    public $mainCategories = [];

    public $pagination = [];
    public $openActions = null;
    public $parentCategory = null;
    public $editCategoryId = null;


    // Category Form Field
    public $category_title = '';
    public $old_category_title = '';
    // End Category Form Field




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
        $this->fetchCategories($this->currentPage);
    }

    public function resetFrom()
    {
       $this->reset('category_title', 'old_category_title' , 'editCategoryId');
    }

    public function fetchCategories($page = 1)
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

    /**
     * Toggles the action dropdown for a specific user.
     * @param int $userId The ID of the user.
     */
    public function toggleActions($userId)
    {
        if ($this->openActions === $userId) {
            $this->openActions = null;
        } else {
            $this->openActions = $userId;
        }
    }
    public function deleteCategory($categoryId)
    {
        $response = Http::withToken(api_token())->delete(api_base_url() . '/categories/main/' . decrypt($categoryId));

        if ($response->successful()) {
            $this->dispatch('sweetalert2', type: 'success', message: 'Category deleted successfully.');
            $this->fetchCategories($this->currentPage);
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to delete user.');
        }
    }
    public function gotoPage($page)
    {
        if ($page >= 1 && $page <= ($this->pagination['pages'] ?? 1)) {
            $this->fetchCategories($page);
        }
    }



    /**
     * Navigate to the previous page.
     */
    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->fetchCategories($this->currentPage - 1);
        }
    }

    /**
     * Navigate to the next page.
     */
    public function nextPage()
    {
        if ($this->currentPage < ($this->pagination['pages'] ?? 1)) {
            $this->fetchCategories($this->currentPage + 1);
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

    public function openEditCategoryModal($id)
    {
        $this->editCategoryId = decrypt($id);
        $this->editCategoryModal = true;

        $this->fetchCategoryById($this->editCategoryId);
    }


    public function updateCategory(){

        if($this->category_title == $this->old_category_title){
             $this->editCategoryModal = false;
             $this->resetFrom();
             return ;
        }

        try {
          
            $token = session()->get('api_token');
            if (!$token) {
                return $this->redirectRoute('login', navigate: true);
            }
            $response = Http::withToken($token)->put(api_base_url() . '/categories/main/' . $this->editCategoryId, [
                'name' => $this->category_title
            ]);
            if ($response->successful()) {
                $this->dispatch('sweetalert2', type: 'success', message: 'Main category updated successfully.');
                $this->fetchCategories();
                $this->resetFrom();
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to update main category.');
            }
        } catch (\Throwable $th) {
           Log::error('Main category update Error: '. $th->getMessage());
        }
        $this->editCategoryModal = false;

    }

    protected function fetchCategoryById($id)
    {
        try {
            $token = session()->get('api_token');
            if (!$token) {
                return $this->redirectRoute('login', navigate: true);
            }
            $response = Http::withToken($token)->get(api_base_url() . "/categories/main/{$id}");

            if ($response->successful()) {
                $data = $response->json();
                $this->category_title = $data['data']['name'] ?? [];
                $this->old_category_title = $data['data']['name'] ?? [];
            }else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Something went wrong.');
            }
        } catch (\Exception $e) {
            Log::error('error', $e->getMessage());
        }
    }


    public function saveCategory()
    {
     
        $this->validate(
            [
                'category_title' => 'required',
            ]
        );

        $data = [
            'name' => $this->category_title
        ];

       try {
            $response = Http::withToken(api_token())->post(api_base_url() . '/categories/main', $data);

            if ($response->successful()) {
                $this->dispatch('sweetalert2', type: 'success', message: 'Category created successfully.');
                $this->category_title = '';
                $this->fetchCategories();
                $this->switchAddCategoryModal();
                $this->resetFrom();
            }else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to create category. Please try again.');
            }

       } catch (\Throwable $th) {

        Log::error('Error in creating category', $th->getMessage());

       }
    }
    // This method will close the modal (and can be used by the 'x' button)
    public function switchEditCategoryModel()
    {

        $this->editCategoryModal = !$this->editCategoryModal;
    }

// Modal Actions Status

public function closeAddModal(){
    $this->addCategoryModal = false;
    $this->resetFrom();
}




    public function render()
    {

    


        // Data Table

        $columns = [
            [    
                'key' => 'name',
                'label' => 'Category Name',
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
                'label' => 'Edit',
                'method' => 'openEditCategoryModal',
                'icon' => 'pencil',
            ],
            [
                'key' => 'id',
                'label' => 'Delete',
                'method' => 'deleteCategory',
                'icon' => 'trash',
            ],
        ];

        //End Data Table

        $pages = $this->getPaginationPages();
        $hasPrevious = $this->currentPage > 1;
        $hasNext = $this->currentPage < ($this->pagination['pages'] ?? 1);
        return view('livewire.admin.category', [
            'pages' => $pages,
            'hasPrevious' => $hasPrevious,
            'hasNext' => $hasNext,


            // if you need data table then only pass this

            'columns' => $columns,
            'actions' => $actions,
            'items' => $this->mainCategories,
        ]);
    }
}
