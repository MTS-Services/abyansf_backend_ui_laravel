<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Event extends Component
{
    use WithFileUploads;

    public $addEventModal = false;
    public $editEventModal = false;
    public $eventDetailsModal = false;

    // Form data properties
    public $eventId;
    public $title;
    public $max_person;
    public $description;
    public $location;
    public $time;
    public $date;
    public $status;
    public $image; // Holds the temporary UploadedFile object for a new file
    public $existing_image; // Stores the URL of the existing image for display

    // Form properties for the deatils modal
    public $detailTitle;
    public $detailImage;
    public $detailMaxPerson;
    public $detailLocation;
    public $detailDate;
    public $detailTime;
    public $detailStatus;
    public $detailDescription;
    public $detailBookings = [];

    public $events = [];
    public $pagination = [];
    public $openActions = null;
    public $currentPage = 1;

    public string $eventName = '';

    public string $eventLocation = '';

    public string $eventStatus = '';

    protected $queryString = [
        'currentPage' => ['as' => 'page', 'except' => 1]
    ];

    // public function mount()
    // {
    //     $this->currentPage = request()->query('page', 1);
    //     $this->fetchEvents($this->currentPage);
    // }

    public function applyFilters()
    {
       
       $response =  $this->fetchEvents($this->currentPage);
 
    }

    public function fetchEvents($page = 1)
    {
        $token = session()->get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }
        $response = Http::withToken($token)->get(api_base_url() . '/events',[
            'page' => $page,
            'name' => $this->eventName,
            'location' => $this->eventLocation,
            'status' => $this->eventStatus,
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

    public function switchAddEventModal()
    {
        $this->addEventModal = !$this->addEventModal;
        if (!$this->addEventModal) {
            $this->reset(['title', 'max_person', 'description', 'location', 'time', 'date', 'image', 'existing_image']);
        }
    }

    public function saveEvent()
    {
        $data = $this->validate([
            'title' => 'required|string|max:255',
            'max_person' => 'required|integer|min:1',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'time' => 'required',
            'date' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $token = Session::get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $request = Http::withToken($token);

        if ($this->image) {
            $request->asMultipart()->attach(
                'event_img',
                file_get_contents($this->image->getRealPath()),
                $this->image->getClientOriginalName()
            );
        }

        $response = $request->post(api_base_url() . '/events', $data);
        // dd($response->json());

        if ($response->successful()) {
            $this->switchAddEventModal();
            $this->dispatch('sweetalert2', type: 'success', message: 'Event created successfully.');
            $this->fetchEvents($this->currentPage);
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to create event. Please try again.');
        }
    }

    public function switchEditEventModal($eventId = null)
    {
       
        $this->editEventModal = !$this->editEventModal;
        if ($this->editEventModal && $eventId) {
            $this->event($eventId);
        } else {
            $this->reset(['eventId', 'title', 'max_person', 'description', 'location', 'time', 'date', 'image', 'existing_image']);
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
            $event = $response->json()['data'];
            $this->title = $event['title'] ?? '';
            $this->max_person = $event['max_person'] ?? '';
            $this->description = $event['description'] ?? '';
            $this->location = $event['location'] ?? '';
            $this->time = $event['time'] ?? '';
            $this->date = $event['date'] ?? '';
            $this->status = $event['status'] ?? '';
            $this->existing_image = $event['event_img'] ?? null;
            $this->image = $event['event_img'] ?? null; // Clear the temporary image property
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to fetch event details.');
        }
    }

    public function updateEvent()
    {
        // Prepare the regular form data
        $data = [
            'title' => $this->title,
            'max_person' => $this->max_person,
            'description' => $this->description,
            'location' => $this->location,
            'time' => $this->time,
            'date' => $this->date,
            'status' => $this->status,
        ];

        $token = Session::get('api_token');
        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        // dd($this->image);

        $request = Http::withToken($token);

        // You MUST re-add the attach part to send the image
        if ($this->image && !filter_var($this->image, FILTER_VALIDATE_URL)) {
            $request->attach(
                'event_img',
                file_get_contents($this->image->getRealPath()),
                $this->image->getClientOriginalName()
            );
        }


        // Use post() with the _method field.
        $response = $request->put(api_base_url() . '/events/' . decrypt($this->eventId), $data);
        // dd($response->json());


        // Check if a new image file has been selected (it's an UploadedFile object, not a URL string)
        // if ($this->image && is_object($this->image)) {
        //     $response = $request
        //         ->asMultipart() 
        //         ->post(api_base_url() . '/events/' . decrypt($this->eventId), array_merge($data, [
        //             'event_img' => file_get_contents($this->image->getRealPath()), // Attach the image file
        //             '_method' => 'PUT' // Emulate a PUT request
        //         ]));
        // } else {
        //     $response = $request->put(api_base_url() . '/events/' . decrypt($this->eventId), $data);
        // }

        // Handle the response
        if ($response->successful()) {
            $this->reset([
                'title',
                'max_person',
                'description',
                'location',
                'date',
                'status',
                'time',
                'image', // Reset the new image property
                'existing_image', // Reset if you want to ensure the old URL is removed too if a new image was uploaded
                'eventId'
            ]);
            $this->switchEditEventModal();
            $this->dispatch('sweetalert2', type: 'success', message: 'Event updated successfully.');
            $this->fetchEvents($this->currentPage); // Refresh the list
        } else {
            // Log the error for debugging if needed
            // \Log::error('Event update failed: ' . $response->body());
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to update event. Please try again.');
        }
    }

    public function toggleActions($userId)
    {
        $this->openActions = ($this->openActions === $userId) ? null : $userId;
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

    public function gotoPage($page)
    {
        if ($page >= 1 && $page <= ($this->pagination['pages'] ?? 1)) {
            $this->fetchEvents($page);
        }
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->fetchEvents($this->currentPage - 1);
        }
    }

    public function nextPage()
    {
        if ($this->currentPage < ($this->pagination['pages'] ?? 1)) {
            $this->fetchEvents($this->currentPage + 1);
        }
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
        } elseif ($current == $total) {
            $pages = [1, '...', $total - 1, $total];
        } elseif ($current == $total - 1) {
            $pages = [1, '...', $total - 2, $total - 1, $total];
        } else {
            $pages = [1, '...', $current - 1, $current, $current + 1, '...', $total];
        }
        return $pages;
    }

    public function closeModal()
    {
        $this->eventDetailsModal = false;
        // $this->resetForm();
    }
    public function eventDtls($eventId = null)
    {
        $this->eventDetailsModal = $eventId;
        if ($this->eventDetailsModal && $eventId) {
            $this->eventDetails($eventId);
        }
    }


    public function eventDetails($eventId = null)
    {
        try {

            // // Fetch API response
            $decryptedId = decrypt($eventId);
            $response = Http::withToken(api_token())->get(api_base_url() . '/events/' . ($decryptedId));
            // dd($response->json());
            if ($response->successful()) {
                $json = $response->json();
                if (isset($json['data'])) {
                    $event = $json['data'];
                    $this->detailTitle = $event['title'] ?? '';
                    $this->detailImage = $event['event_img'] ?? '';
                    $this->detailDate = $event['date'] ?? '';
                    $this->detailTime = $event['time'] ?? '';
                    $this->detailDescription = $event['description'] ?? '';
                    $this->detailMaxPerson = $event['max_person'] ?? '';
                    $this->detailLocation = $event['location'] ?? '';
                    $this->detailStatus = $event['status'] ?? '';
                    $this->detailBookings = $event['bookings'] ?? [];

                }
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to fetch event details.');
            }
        } catch (\Exception $e) {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to fetch event details.');
        }
    }

    public function render()
    {
        $this->currentPage = request()->query('page', 1);
        $this->fetchEvents($this->currentPage);
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
