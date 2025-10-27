<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class EventBooking extends Component
{

    public $events = [];

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

        $response = Http::withToken($token)->get(api_base_url() . '/events/booking/admin', [
            'page' => $page
        ]);

        if ($response->successful()) {
            $data = $response->json();
            // $this->dispatch('sweetalert2', type: 'success', message: 'attendances loaded successfully.');
            $this->events = $data['data']['bookings'] ?? [];
            $this->pagination = $data['data']['pagination'] ?? [];
            $this->currentPage = $page;
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load attendances from the API.');
            $this->events = [];
            $this->pagination = [];
            Session::flash('error', 'Failed to load attendances from the API.');
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
     * Activate event booking (set status to Approved/Confirmed)
     */
    public function activateEvent($bookingId)
    {
        
        $token = Session::get('api_token');

        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->put(api_base_url() . '/events/update/' . decrypt($bookingId), [
            'status' => 'Confirmed'
        ]);

        if ($response->successful()) {
            $this->dispatch('sweetalert2', type: 'success', message: 'Booking confirmed successfully.');
            $this->fetchUsers($this->currentPage);
        } else {
            $errorMessage = $response->json()['message'] ?? 'Failed to confirm booking.';
            $this->dispatch('sweetalert2', type: 'error', message: $errorMessage);
        }
    }

    /**
     * Deactivate event booking (set status to Pending)
     */
    public function deactivateEvent($bookingId)
    {
        $token = Session::get('api_token');

        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->put(api_base_url() . '/events/update/' . decrypt($bookingId), [
            'status' => 'Pending'
        ]);

        if ($response->successful()) {
            $this->dispatch('sweetalert2', type: 'success', message: 'Booking marked as pending.');
            $this->fetchUsers($this->currentPage);
        } else {
            $errorMessage = $response->json()['message'] ?? 'Failed to update booking status.';
            $this->dispatch('sweetalert2', type: 'error', message: $errorMessage);
        }
    }
    public function rejectEvent($bookingId)
    {
        $token = Session::get('api_token');

        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->put(api_base_url() . '/events/update/' . decrypt($bookingId), [
            'status' => 'Rejected'
        ]);

        if ($response->successful()) {
            $this->dispatch('sweetalert2', type: 'success', message: 'Booking marked as pending.');
            $this->fetchUsers($this->currentPage);
        } else {
            $errorMessage = $response->json()['message'] ?? 'Failed to update booking status.';
            $this->dispatch('sweetalert2', type: 'error', message: $errorMessage);
        }
    }

    public function deleteEvent($eventId)
    {
        $response = Http::withToken(api_token())->delete(api_base_url() . '/events/booking/' . decrypt($eventId));

        if ($response->successful()) {
            $this->dispatch('sweetalert2', type: 'success', message: 'booking deleted successfully.');
            $this->fetchUsers($this->currentPage);
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to delete user.');
        }
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

    public function editEvent($id)
    {
        dd($id);
    }

    public function render()
    {
        $pages = $this->getPaginationPages();
        $hasPrevious = $this->currentPage > 1;
        $hasNext = $this->currentPage < ($this->pagination['pages'] ?? 1);
        return view('livewire.admin.event-booking', [
            'pages' => $pages,
            'hasPrevious' => $hasPrevious,
            'hasNext' => $hasNext,
        ]);
    }
}