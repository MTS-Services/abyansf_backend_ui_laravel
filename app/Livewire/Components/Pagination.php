<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Pagination extends Component
{
    public $currentPage = 1;
    public $totalPages = 1;
    public $showPagination = true;

    public function mount($currentPage = 1, $totalPages = 1)
    {
        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
        $this->showPagination = $totalPages > 1;
    }

    /**
     * Navigate to a specific page
     */
    public function gotoPage($page)
    {
        if ($page >= 1 && $page <= $this->totalPages) {
            $this->currentPage = $page;
            $this->dispatch('page-changed', page: $page);
        }
    }

    /**
     * Navigate to previous page
     */
    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->gotoPage($this->currentPage - 1);
        }
    }

    /**
     * Navigate to next page
     */
    public function nextPage()
    {
        if ($this->currentPage < $this->totalPages) {
            $this->gotoPage($this->currentPage + 1);
        }
    }

    /**
     * Get the pagination pages to display
     */
    public function getPaginationPages()
    {
        $pages = [];
        $current = $this->currentPage;
        $total = $this->totalPages;

        if ($total <= 3) {
            // Show all pages if total pages <= 3
            for ($i = 1; $i <= $total; $i++) {
                $pages[] = $i;
            }
        } else {
            if ($current <= 3) {
                // For pages 1, 2, 3
                if ($current == 1) {
                    // Page 1: [1 active] [2] ... [last]
                    $pages = [1, 2, '...', $total];
                } elseif ($current == 2) {
                    // Page 2: [1] [2 active] [3] ... [last]
                    $pages = [1, 2, 3, '...', $total];
                } else { // current == 3
                    // Page 3: [1] [2] [3 active] ... [last]
                    $pages = [1, 2, 3, '...', $total];
                }
            } elseif ($current >= $total - 2) {
                // For last 3 pages
                if ($current == $total) {
                    // Last page: [1] ... [last-1] [last active]
                    $pages = [1, '...', $total - 1, $total];
                } elseif ($current == $total - 1) {
                    // Last 2nd: [1] ... [last-2] [last-1 active] [last]
                    $pages = [1, '...', $total - 2, $total - 1, $total];
                } else { // current == $total - 2
                    // Last 3rd: [1] ... [last-3] [last-2 active] [last-1] [last]
                    $pages = [1, '...', $total - 2, $total - 1, $total];
                }
            } else {
                // Middle pages: [1] ... [current-1] [current active] [current+1] ... [last]
                $pages = [1, '...', $current - 1, $current, $current + 1, '...', $total];
            }
        }

        return $pages;
    }

    public function render()
    {
        return view('livewire.components.pagination', [
            'pages' => $this->getPaginationPages(),
            'hasPrevious' => $this->currentPage > 1,
            'hasNext' => $this->currentPage < $this->totalPages,
        ]);
    }
}