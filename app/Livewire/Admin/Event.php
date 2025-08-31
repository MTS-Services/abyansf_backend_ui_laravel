<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Event extends Component
{

 
    public $addEventModal = false;
     public $editEventModal = false;

     public $events = [];
    public $pagination = [];
    public $openActions = null;

    public $currentPage = 1;

    protected $queryString = [
        'currentPage' => ['as' => 'page', 'except' => 1]
    ];

    public function mount()
    {
        $this->currentPage = request()->query('page', 1);
        $this->fetchUsers($this->currentPage);
    }
    public function fetchUsers($page = 1)
    {
        $token=session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }
        $response = Http::withToken($token)->get(api_base_url() . '/events', [
            'page' => $page
        ]);
        if ($response->successful()) {
            $data = $response->json();
            $this->dispatch('sweetalert2', type: 'success', message: 'Events loaded successfully.');
            $this->events = $data['data']['events'] ?? [];
            $this->pagination = $data['data']['pagination'] ?? [];
            $this->currentPage = $page;
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load events from the API.');
            $this->events = [];
            $this->pagination = [];
            Session::flash('error', 'Failed to load events from the API.');
        }

    
       
    }

     public function toggleActions($userId)
    {
        if ($this->openActions === $userId) {
            $this->openActions = null;
        } else {
            $this->openActions = $userId;
        }
    }

    public function deleteEvent($eventId)
    {
        
        $response = Http::withToken(api_token())->delete(api_base_url() . '/events/' . decrypt($eventId));
        if ($response->successful()) {
            $this->dispatch('sweetalert2', type: 'success', message: 'Event deleted successfully.');
            $this->fetchUsers($this->currentPage);
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to delete event.');
        }
    }

     public function activateUser($eventId)
    {
        // Session::flash('info', "Activate action for user ID: {$userId}");
        $this->dispatch('sweetalert2', type: 'info', message: "Activate action for user ID: {$eventId}");
        $this->fetchUsers($this->currentPage);
    }

    /**
     * Handles the deactivate action.
     * @param int $userId The ID of the user to deactivate.
     */
    public function deactivateUser($eventId)
    {
        // Session::flash('info', "Deactivate action for user ID: {$userId}");
        $this->dispatch('sweetalert2', type: 'info', message: "Deactivate action for user ID: {$eventId}");
        $this->fetchUsers($this->currentPage);
    }
      public function gotoPage($page)
    {
        if ($page >= 1 && $page <= ($this->pagination['pages'] ?? 1)) {
            $this->fetchUsers($page);
        }
    }

    /**
     * Navigate to the previous page.
     */
    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->fetchUsers($this->currentPage - 1);
        }
    }

    /**
     * Navigate to the next page.
     */
    public function nextPage()
    {
        if ($this->currentPage < ($this->pagination['pages'] ?? 1)) {
            $this->fetchUsers($this->currentPage + 1);
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

    public function switchAddEventModal()
    {
        $this->addEventModal = !$this->addEventModal;
    }

    public function switchEditEventModel()
    {
        // Toggle modal
        $this->editEventModal = !$this->editEventModal;
    }



    public function render()
    {
       $pages = $this->getPaginationPages();
        $hasPrevious = $this->currentPage > 1;
        $hasNext = $this->currentPage < ($this->pagination['pages'] ?? 1);
        return view(
            'livewire.admin.event',
            [
                'pages' => $pages,
                'hasPrevious' => $hasPrevious,
                'hasNext' => $hasNext,
            ]
        );
    }
}
