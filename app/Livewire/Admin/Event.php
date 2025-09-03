<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Event extends Component
{
    use WithFileUploads;

    public $addEventModal = false;
    public $editEventModal = false;

    // Form data properties
    public $eventId;
    public $title;
    public $max_person;
    public $description;
    public $location;
    public $time;
    public $date;
    public $status;
    public $is_active; // Added these properties
    public $is_disabled; // Added these properties
    public $image = [];
    public $existing_image = [];

    public $event = [];
    public $updateEventModal = false;
    public $events = [];
    public $pagination = [];
    public $openActions = null;

    public $currentPage = 1;

    protected $queryString = [
        'currentPage' => ['as' => 'page', 'except' => 1]
    ];

    public function switchAddEventModal()
    {
        $this->addEventModal = !$this->addEventModal;
    }


    /**
     * Livewire's lifecycle hook that runs once on component initialization.
     */
    public function mount()
    {
        $this->currentPage = request()->query('page', 1);
        $this->fetchEvents($this->currentPage);
    }
    public function fetchEvents($page = 1)
    {
        $token = session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }
        $response = Http::withToken($token)->get(api_base_url() . '/events', [
            'page' => $page
        ]);
        if ($response->successful()) {
            $data = $response->json();
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

    //  create event
    public function saveEvent()
    {
        // Validate
        $data = $this->validate([
            'title' => 'required|string|max:255',
            'max_person' => 'required|integer|min:1',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'time' => 'required',
            'date' => 'required|date',
            'image.*' => 'nullable|image|max:1024',
        ]);

        // Token
        $token = Session::get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        // Prepare request
        $request = Http::withToken($token);

        // Attach image
        if (!empty($this->image)) {
            foreach ($this->image as $image) {
                $request->attach(
                    'event_img',
                    file_get_contents($image->getRealPath()),
                    $image->getClientOriginalName()
                );
            }
        }

        // Send request (normal fields)
        $response = $request->post(api_base_url() . '/events', [
            'title' => $this->title,
            'max_person' => $this->max_person,
            'description' => $this->description,
            'location' => $this->location,
            'time' => $this->time,
            'date' => $this->date,
        ]);

        // Response check
        if ($response->successful()) {
            $this->reset([
                'title',
                'max_person',
                'description',
                'location',
                'time',
                'date',
                'image'
            ]);

            $this->switchAddEventModal();

            $this->dispatch('sweetalert2', type: 'success', message: 'Event created successfully.');

            $this->fetchEvents();
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to create event. Please try again.');
        }
    }
    //  edit event

    public function switchEditEventModal($eventId = null)
    {
        $this->editEventModal = !$this->editEventModal;

        if ($this->editEventModal && $eventId) {
            $this->event($eventId); // load event data
        }
    }

    public function event($eventId)
    {
        $this->eventId = $eventId;

        $token = Session::get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $decryptedId = decrypt($eventId);
        $response = Http::withToken($token)->get(api_base_url() . "/events/{$decryptedId}");


        if ($response->successful()) {
            $json = $response->json();

            if (isset($json['data'])) {
                $event = $json['data'];

                $this->title       = $event['title'] ?? '';
                $this->max_person  = $event['max_person'] ?? '';
                $this->description = $event['description'] ?? '';
                $this->location    = $event['location'] ?? '';
                $this->time        = $event['time'] ?? '';
                $this->date        = $event['date'] ?? '';

                // Convert single image string to array for AlpineJS
                $this->image = $event['event_img'] ? [$event['event_img']] : [];
            }
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to fetch event details.');
        }
    }

    public function updateEvent()
    {
        // Send the POST request to the API
        $imageAttachment = null;
        if (is_object($this->image)) {
            $imageAttachment = [
                'event_img' => [
                    'contents' => file_get_contents($this->image->getRealPath()),
                    'filename' => $this->image->getClientOriginalName(),
                ],
            ];
        }
        $response = Http::withToken(api_token())->put(api_base_url() . '/events/' . decrypt($this->eventId), [
            'title' => $this->title,
            'max_person' => $this->max_person,
            'description' => $this->description,
            'location' => $this->location,

            'date' => $this->date,
            'time' => $this->time,



        ], $imageAttachment);
        // dd($response->json());
        // Response check
        if ($response->successful()) {
            $this->reset([
                'title',
                'max_person',
                'description',
                'location',
                'date',
                'time',
                'image',
                'eventId',
            ]);

            $this->switchEditEventModal();
            $this->dispatch('sweetalert2', type: 'success', message: 'Event updated successfully.');
            $this->fetchEvents();
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to update event. Please try again.');
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
            $this->fetchEvents($this->currentPage);
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to delete event.');
        }
    }

    public function activateUser($eventId)
    {
        $this->dispatch('sweetalert2', type: 'info', message: "Activate action for user ID: {$eventId}");
        $this->fetchEvents($this->currentPage);
    }

    /**
     * Handles the deactivate action.
     * @param int $userId The ID of the user to deactivate.
     */
    public function deactivateUser($eventId)
    {
        $this->dispatch('sweetalert2', type: 'info', message: "Deactivate action for user ID: {$eventId}");
        $this->fetchEvents($this->currentPage);
    }
    public function gotoPage($page)
    {
        if ($page >= 1 && $page <= ($this->pagination['pages'] ?? 1)) {
            $this->fetchEvents($page);
        }
    }

    /**
     * Navigate to the previous page.
     */
    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->fetchEvents($this->currentPage - 1);
        }
    }

    /**
     * Navigate to the next page.
     */
    public function nextPage()
    {
        if ($this->currentPage < ($this->pagination['pages'] ?? 1)) {
            $this->fetchEvents($this->currentPage + 1);
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
            'livewire.admin.event',
            [
                'pages' => $pages,
                'hasPrevious' => $hasPrevious,
                'hasNext' => $hasNext,
            ]
        );
    }
}
