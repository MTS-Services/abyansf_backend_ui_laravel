<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Booking extends Component
{
    public $bookings = [];
    public $pagination = [];
    public $openActions = null;
    public $listingBookingId = null;

    public $listingId;
    public $bookingDate;
    public $bookingTime;
    public $typeofservice;
    public $venueName;
    public $numberofguest_adult;
    public $numberofguest_child;
    public $status;


    public $listingbookingEditModal = false;

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
        $this->fetchBookinss($this->currentPage);
    }

    /**
     * Fetches users from the API.
     * @param int $page The page number to fetch.
     */
    public function fetchBookinss($page = 1)
    {
        $token = Session::get('api_token');

        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get(api_base_url() . '/sub-category-bookings/admin/all-users/grouped', [
            'page' => $page
        ]);
        // dd($response->json());

        // dd($response ['data']['bookings']['listing']['name']);

        if ($response->successful()) {
            $data = $response->json();
            // $this->dispatch('sweetalert2', type: 'success', message: 'Bookings loaded successfully.');
            $booking = $data['data']['bookings'] ?? [];
            $this->pagination = $data['data']['pagination'] ?? [];
            $this->currentPage = $page;

            $this->bookings = collect($booking)
                ->whereIn('type', ['listing', 'subcategory'])
                ->values()
                ->toArray();
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load bookings from the API.');
            $this->bookings = [];
            $this->pagination = [];
            Session::flash('error', 'Failed to load bookings from the API.');
        }
    }

    /**
     * Toggles the action dropdown for a specific user.
     * @param int $bookingId The ID of the user.
     */
    public function toggleActions($userId)
    {
        if ($this->openActions === $userId) {
            $this->openActions = null;
        } else {
            $this->openActions = $userId;
        }
    }
    public function deleteListingBooking($listingBookingId)
    {
        // dd($listingBookingId);
        $response = Http::withToken(api_token())->delete(api_base_url() . '/bookings/' . decrypt($listingBookingId));
        // dd($response->json());
        if ($response->successful()) {
            $this->dispatch('sweetalert2', type: 'success', message: 'booking deleted successfully.');
            $this->fetchBookinss($this->currentPage);
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to delete user.');
        }
    }
    public function deleteSubcategoryBooking($listingBookingId)
    {
        // dd($listingBookingId);
        $response = Http::withToken(api_token())->delete(api_base_url() . '/sub-category-bookings/' . decrypt($listingBookingId));
        // dd($response->json());
        if ($response->successful()) {
            $this->dispatch('sweetalert2', type: 'success', message: 'booking deleted successfully.');
            $this->fetchBookinss($this->currentPage);
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to delete user.');
        }
    }
    public function closeModal()
    {
        $this->listingbookingEditModal = false;
        reset($this->bookings);
    }
    public function editListingBooking($listingBookingId)
    {
        $this->listingbookingEditModal = true;
        if ($this->listingbookingEditModal && $listingBookingId) {
            $this->listingBooking($listingBookingId); // load event data
        }
    }

    public function listingBooking($listingBookingId)
    {
        $this->listingBookingId = $listingBookingId;

        // Decrypt the ID and make the API call
        $decryptedId = decrypt($listingBookingId);
        $response = Http::withToken(api_token())->get(api_base_url() . "/bookings/{$decryptedId}");


        if ($response->successful()) {
            $json = $response->json();
            if (isset($json['data'])) {
                $booking = $json['data'];

                // Assign fetched data to public properties
                $this->listingId = $booking['listingId'] ?? '';
                $this->typeofservice = $booking['typeofservice'] ?? '';
                $this->venueName = $booking['venueName'] ?? '';
                $this->numberofguest_adult = $booking['numberofguest_adult'] ?? 0;
                $this->numberofguest_child = $booking['numberofguest_child'] ?? 0;
                $this->status = $booking['status'] ?? '';

                // Format and assign date and time
                if (isset($booking['bookingDate'])) {
                    try {
                        // Carbon is used to ensure the date is in the YYYY-MM-DD format
                        $this->bookingDate = Carbon::parse($booking['bookingDate'])->format('Y-m-d');
                    } catch (\Exception $e) {
                        $this->bookingDate = null;
                    }
                }

                if (isset($booking['bookingTime'])) {
                    try {
                        // Carbon is used to ensure the time is in the H:i:s format (or similar)
                        $this->bookingTime = Carbon::parse($booking['bookingTime'])->format('H:i');
                    } catch (\Exception $e) {
                        $this->bookingTime = null;
                    }
                }
            }
        } else {
            // Dispatch a sweet alert error if the API call fails
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to fetch event details.');
        }
    }
    public function updateListingBooking()
    {
        $data = [
            'listingId'            => $this->listingId,
            'bookingDate'          => $this->bookingDate,
            'bookingTime'          => $this->bookingTime,
            'typeofservice'        => $this->typeofservice,
            'venueName'            => $this->venueName,
            'numberofguest_adult'  => $this->numberofguest_adult,
            'numberofguest_child'  => $this->numberofguest_child,
            'status'               => $this->status,
        ];

        // dd($data);

        // 🔹 Assuming bookingId is already set (encrypted like userId)
        $response = Http::withToken(api_token())->put(api_base_url() . '/bookings/' . decrypt($this->listingBookingId), $data);
        
        if ($response->successful()) {

            dd($response->json());
            $this->reset([
                'listingId',
                'bookingDate',
                'bookingTime',
                'typeofservice',
                'venueName',
                'numberofguest_adult',
                'numberofguest_child',
                'status',
            ]);

            $this->listingbookingEditModal = false; // Close modal
            $this->dispatch('sweetalert2', type: 'success', message: 'Booking updated successfully.');
            $this->fetchBookings();
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to update booking. Please try again.');
        }
    }



    public function gotoPage($page)
    {
        if ($page >= 1 && $page <= ($this->pagination['pages'] ?? 1)) {
            $this->fetchBookinss($page);
        }
    }

    public function statesBooking($listingBookingId)
    {
        $response = Http::withToken(api_token())->get(api_base_url() . '/bookings/' . decrypt($listingBookingId));
        Session::flash('info', "Status action for booking ID: {$listingBookingId}");
        $this->dispatch('sweetalert2', type: 'info', message: "Status action for booking ID: {$listingBookingId}");
    }

    /**
     * Navigate to the previous page.
     */
    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->fetchBookinss($this->currentPage - 1);
        }
    }

    /**
     * Navigate to the next page.
     */
    public function nextPage()
    {
        if ($this->currentPage < ($this->pagination['pages'] ?? 1)) {
            $this->fetchBookinss($this->currentPage + 1);
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

        return view('livewire.admin.booking', [
            'pages' => $pages,
            'hasPrevious' => $hasPrevious,
            'hasNext' => $hasNext,
        ]);
    }
}
