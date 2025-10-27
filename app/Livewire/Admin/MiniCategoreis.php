<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class MiniCategoreis extends Component
{

    public $miniSubCategoreis = [];

    public $currentPage = 1; 

    public $pagination = [];

    public function mount()
    {
        $this->fetchMiniSubCategories();
    }

    public function fetchMiniSubCategories($page = 1) { 
        
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
        
        Log::error('Mini Sub Categories Fetching Error: '. $th->getMessage());
        
       }

    }

    public function MiniCategoryDetail($id){

        $id = Decrypt($id);

        $this->fetchMiniSubCategoriesId($id);
    }

    public function fetchMiniSubCategoriesId($id){
        
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
