<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class User extends Component
{
    public $users = [];
    public $pagination = [];
    public $openActions = null;

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
        $this->fetchUsers($this->currentPage);
    }
    
    /**
     * Fetches users from the API.
     * @param int $page The page number to fetch.
     */
    public function fetchUsers($page = 1)
    {
        $token = Session::get('api_token');

        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get('https://backend-ab.mtscorporate.com/api/users', [
            'page' => $page
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->users = $data['data']['users'] ?? [];
            $this->pagination = $data['data']['pagination'] ?? [];
            // Update the property after a successful fetch to avoid URL issues on failure
            $this->currentPage = $page;
        } else {
            $this->users = [];
            $this->pagination = [];
            Session::flash('error', 'Failed to load users from the API.');
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

    /**
     * Handles the delete action.
     * @param int $userId The ID of the user to delete.
     */
    public function deleteUser($userId)
    {
        $token = Session::get('api_token');
        if (!$token) {
            return;
        }

        $response = Http::withToken($token)->delete('https://backend-ab.mtscorporate.com/api/users/' . $userId);

        if ($response->successful()) {
            Session::flash('message', 'User deleted successfully.');
            $this->fetchUsers($this->currentPage); // Refresh the list
        } else {
            Session::flash('error', 'Failed to delete user.');
        }
    }

    /**
     * Handles the edit action.
     * @param int $userId The ID of the user to edit.
     */
    public function editUser($userId)
    {
        Session::flash('info', "Edit action for user ID: {$userId}");
    }

    /**
     * Handles the activate action.
     * @param int $userId The ID of the user to activate.
     */
    public function activateUser($userId)
    {
        Session::flash('info', "Activate action for user ID: {$userId}");
        $this->fetchUsers($this->currentPage);
    }

    /**
     * Handles the deactivate action.
     * @param int $userId The ID of the user to deactivate.
     */
    public function deactivateUser($userId)
    {
        Session::flash('info', "Deactivate action for user ID: {$userId}");
        $this->fetchUsers($this->currentPage);
    }

    /**
     * Handles sending the payment link.
     * @param int $userId The ID of the user to send the link to.
     */
    public function sendPaymentLink($userId)
    {
        Session::flash('info', "Sending payment link to user ID: {$userId}");
        $this->fetchUsers($this->currentPage);
    }

    /**
     * Navigate to a specific page.
     * @param int $page The page number to go to.
     */
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

    public function render()
    {
        $pages = $this->getPaginationPages();
        $hasPrevious = $this->currentPage > 1;
        $hasNext = $this->currentPage < ($this->pagination['pages'] ?? 1);

        return view('livewire.admin.user', [
            'pages' => $pages,
            'hasPrevious' => $hasPrevious,
            'hasNext' => $hasNext,
        ]);
    }
}