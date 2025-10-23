<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class Listing extends Component
{
    use WithFileUploads;

    public $addListingModal = false;
    public $editListingModal = false;
    public $listingDetailsModal = false;

    // Form properties for the edit modal
    public $listingIdToEdit;
    public $name;
    public $description;
    public $location;
    public $listing_name;
    public $active;
    public $disabled;

    // Image properties
    public $existing_main_image;
    public $existing_menu_images = [];
    public $existing_sub_images = [];
    public $main_image; // This will hold the new uploaded main image file
    public $menu_images = []; // This will hold the new uploaded menu images
    public $sub_images = []; // This will hold the new uploaded sub images
    public $removed_existing_image_ids = []; // To track images to be removed

    // New properties for the Add Listing form
    public $specificCategoryId;
    public $member_privileges_description;
    public $hours;
    public $formName;
    public $venueName;
    public $typeofservice;
    public $contractWhatsapp;
    public $hasForm;
    public $member_privileges;
    public $privileges = [];
    public $isActive;
    public $menuImages = [];
    public $fromName;
    public $listingHours = [];
    public $listingTypeofServices = [];
    public $listingVenueNames = [];
    public $listingMainImage;
    public $listing_sub_images = [];
    public $specificCategories;
    public $bookings = [];

    public $listings = [];
    public $pagination = [];
    public $listingData = [];
    public $openActions = null;
    public $currentPage = 1;

    protected $queryString = [
        'currentPage' => ['as' => 'page', 'except' => 1]
    ];

    /**
     * Rules for validation.
     */
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'specificCategoryId' => 'required|integer',
            'member_privileges_description' => 'nullable|string',
            'hours' => 'nullable|string',
            'formName' => 'nullable|string',
            'venueName' => 'nullable|string',
            'typeofservice' => 'nullable|string',
            'contractWhatsapp' => 'nullable|numeric',
            'hasForm' => 'nullable|boolean',
            'main_image' => 'nullable|image|max:1024',
            'menu_images.*' => 'nullable|image|max:1024',
            'sub_images.*' => 'nullable|image|max:1024',
            'active' => 'nullable|boolean',
            'disabled' => 'nullable|boolean',
        ];
    }

    public function mount()
    {
        $this->currentPage = request()->query('page', 1);
        $this->fetchListings($this->currentPage);
    }

    public function applyFilters(){

       $this->fetchListings($this->currentPage);

    }

    public function specificCategories()  
    {

        $token = api_token();

        $response = Http::withToken($token)->get(api_base_url() . '/categories/specific');

        if ($response->successful()) {

            $data = $response->json();

         return $data['data']['specificCategories'] ?? [];

        }

    }
    public function fetchListings($page = 1)
    {
        $token = Session::get('api_token');

        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get(api_base_url() . '/listings', [
            'page' => $page,
            'specificCategoryId' => $this->specificCategoryId ?? '',
            'listingName' => $this->formName ?? '',
            'location' => $this->location ?? '',

        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->listings = $data['data']['listings'] ?? [];
            $this->pagination = $data['data']['pagination'] ?? [];
            $this->currentPage = $page;
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load listings from the API.');
            $this->listings = [];
            $this->pagination = [];
            Session::flash('error', 'Failed to load listings from the API.');
        }
    }

    public function switchAddListingModal()
    {
        $this->addListingModal = !$this->addListingModal;

        if ($this->addListingModal) {
            $this->resetForm();
        }
    }

    public function switchEditListingModal($listingId)
    {
        $this->editListingModal = true;
        $this->listingIdToEdit = decrypt($listingId);

        $token = api_token();

        try {
            $response = Http::withToken($token)->get(api_base_url() . '/listings/' . $this->listingIdToEdit);

            if ($response->successful()) {
                $this->listingData = $response->json();
                $this->fillFormWithData();
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to fetch listing data.');
            }
        } catch (\Exception $e) {
            $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred while fetching listing data.');
        }
    }

    public function fillFormWithData()
    {
        if ($this->listingData) {
            $data = $this->listingData['data'] ?? [];
            $this->name = $data['name'] ?? '';
            $this->description = $data['description'] ?? '';
            $this->location = $data['location'] ?? '';
            $this->specificCategoryId = $data['specific_category_id'] ?? null;
            $this->member_privileges_description = $data['member_privileges_description'] ?? '';
            $this->hours = $data['hours'] ?? '';
            $this->formName = $data['form_name'] ?? '';
            $this->venueName = $data['venue_name'] ?? '';
            $this->typeofservice = $data['typeofservice'] ?? '';
            $this->contractWhatsapp = $data['contract_whatsapp'] ?? '';
            $this->hasForm = $data['has_form'] ?? false;
            $status = $data['status'] ?? '';
            $this->active = ($status === 'active');
            $this->disabled = ($status === 'disabled');

            // Set existing images
            $this->existing_main_image = $data['main_image'] ?? null;
            $this->existing_menu_images = $data['menu_images'] ?? [];
            $this->existing_sub_images = $data['sub_images'] ?? [];

            // Clear temporary and removed properties
            $this->main_image = null;
            $this->menu_images = [];
            $this->sub_images = [];
            $this->removed_existing_image_ids = [];
        }
    }

    public function saveListing()
    {
        $this->validate([
            'specificCategoryId' => 'required|integer',
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'member_privileges_description' => 'nullable|string',
            'hours' => 'nullable|string',
            'formName' => 'nullable|string',
            'venueName' => 'nullable|string',
            'typeofservice' => 'nullable|string',
            'contractWhatsapp' => 'nullable|numeric',
            'hasForm' => 'nullable|boolean',
            'main_image' => 'required|image|max:1024',
            'menu_images.*' => 'nullable|image|max:1024',
            'sub_images.*' => 'nullable|image|max:1024',
        ]);

        $token = api_token();
        if (!$token) {
            $this->dispatch('sweetalert2', type: 'error', message: 'Authentication token not found.');
            return;
        }

        $payload = [
            'specific_category_id' => $this->specificCategoryId,
            'name' => $this->name,
            'location' => $this->location,
            'description' => $this->description,
            'member_privileges_description' => $this->member_privileges_description,
            'hours' => $this->hours,
            'form_name' => $this->formName,
            'venue_name' => $this->venueName,
            'typeofservice' => $this->typeofservice,
            'contract_whatsapp' => $this->contractWhatsapp,
            'has_form' => $this->hasForm,
        ];

        $request = Http::withToken($token)->asMultipart();

        // Attach files to the multipart request
        if ($this->main_image) {
            $request->attach('main_image', file_get_contents($this->main_image->getRealPath()), $this->main_image->getClientOriginalName());
        }
        foreach ($this->menu_images as $index => $menuImage) {
            $request->attach("menu_images[{$index}]", file_get_contents($menuImage->getRealPath()), $menuImage->getClientOriginalName());
        }
        foreach ($this->sub_images as $index => $subImage) {
            $request->attach("sub_images[{$index}]", file_get_contents($subImage->getRealPath()), $subImage->getClientOriginalName());
        }

        try {
            $response = $request->post(api_base_url() . '/listings', $payload);

            if ($response->successful()) {
                $this->dispatch('sweetalert2', type: 'success', message: 'Listing created successfully!');
                $this->switchAddListingModal(); // Close the modal
                $this->fetchListings(); // Refresh the list
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to create listing.');
            }
        } catch (\Exception $e) {
            $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred while creating the listing.');
        }
    }

    public function updateListing()
    {
        $this->validate();

        $token = api_token();
        if (!$token) {
            $this->dispatch('sweetalert2', type: 'error', message: 'Authentication token not found.');
            return;
        }

        $payload = [
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'specific_category_id' => $this->specificCategoryId,
            'member_privileges_description' => $this->member_privileges_description,
            'hours' => $this->hours,
            'form_name' => $this->formName,
            'venue_name' => $this->venueName,
            'typeofservice' => $this->typeofservice,
            'contract_whatsapp' => $this->contractWhatsapp,
            'has_form' => $this->hasForm,
            'status' => $this->active ? 'active' : 'disabled',
            'removed_existing_image_ids' => json_encode($this->removed_existing_image_ids),
        ];

        try {
            $request = Http::withToken($token)->asMultipart();

            if ($this->main_image) {
                $request->attach('main_image', file_get_contents($this->main_image->getRealPath()), $this->main_image->getClientOriginalName());
            }
            foreach ($this->menu_images as $index => $menuImage) {
                $request->attach("menu_images[{$index}]", file_get_contents($menuImage->getRealPath()), $menuImage->getClientOriginalName());
            }
            foreach ($this->sub_images as $index => $subImage) {
                $request->attach("sub_images[{$index}]", file_get_contents($subImage->getRealPath()), $subImage->getClientOriginalName());
            }

            $response = $request->post(api_base_url() . '/listings/' . $this->listingIdToEdit . '?_method=PUT', $payload);

            if ($response->successful()) {
                $this->dispatch('sweetalert2', type: 'success', message: 'Listing updated successfully!');
                $this->closeEditModal();
                $this->fetchListings($this->currentPage);
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to update listing.');
            }
        } catch (\Exception $e) {
            $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred while updating the listing.');
        }
    }

    public function removeExistingImage($type, $id)
    {
        // Add the image ID to the list of images to be removed
        $this->removed_existing_image_ids[] = $id;

        // Remove the image from the Livewire property to update the UI
        if ($type === 'menu_images') {
            $this->existing_menu_images = collect($this->existing_menu_images)->reject(fn($image) => $image['id'] == $id)->values()->all();
        } elseif ($type === 'sub_images') {
            $this->existing_sub_images = collect($this->existing_sub_images)->reject(fn($image) => $image['id'] == $id)->values()->all();
        } elseif ($type === 'main_image') {
            $this->existing_main_image = null;
        }
    }

    public function removeNewImage($type, $index)
    {
        // Remove the new image from the Livewire property to update the UI
        if ($type === 'menu_images') {
            unset($this->menu_images[$index]);
            $this->menu_images = array_values($this->menu_images);
        } elseif ($type === 'sub_images') {
            unset($this->sub_images[$index]);
            $this->sub_images = array_values($this->sub_images);
        }
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'description',
            'location',
            'active',
            'disabled',
            'listingIdToEdit',
            'specificCategoryId',
            'member_privileges_description',
            'hours',
            'formName',
            'venueName',
            'typeofservice',
            'contractWhatsapp',
            'hasForm',
            'menu_images',
            'sub_images',
            'main_image',
            'existing_main_image',
            'existing_menu_images',
            'existing_sub_images',
            'removed_existing_image_ids'
        ]);
    }

    public function closeEditModal()
    {
        $this->editListingModal = false;
        $this->listingDetailsModal = false;
        $this->resetForm();
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->fetchListings($this->currentPage - 1);
        }
    }

    public function nextPage()
    {
        if ($this->currentPage < ($this->pagination['pages'] ?? 1)) {
            $this->fetchListings($this->currentPage + 1);
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
    public function listingDtls($listingId = null)
    {
        $this->listingDetailsModal = $listingId;
        if ($this->listingDetailsModal && $listingId) {
            $this->listingDetails($listingId);
        }
    }
    public function listingDetails($listingId = null)
    {
        try {
            $decryptedId = decrypt($listingId);
            // Fetch API response
            $response = Http::withToken(api_token())->get(api_base_url() . '/listings/' . $decryptedId);
            // dd($response->json());
            if ($response->successful()) {
                $json = $response->json();
                if (isset($json['data'])) {
                    $listing = $json['data'];
                    $this->name = $listing['name'] ?? '';
                    $this->listingMainImage = $listing['main_image'] ?? '';
                    $this->listing_sub_images = $listing['sub_images'] ?? [];
                    $this->location = $listing['location'] ?? '';
                    $this->privileges = $listing['member_privileges'] ?? [];
                    $this->member_privileges_description = $listing['member_privileges_description'] ?? '';
                    $this->description = $listing['description'] ?? '';
                    $this->listingHours = $listing['hours'] ?? '';
                    $this->specificCategoryId = $listing['specificCategoryId'] ['name'] ?? null;
                    $this->isActive = $listing['isActive'] ?? false;
                    $this->menuImages = $listing['menuImages'] ?? [];
                    $this->listingTypeofServices = $listing['typeofservice'] ?? '';
                    $this->listingVenueNames = $listing['venueName'] ?? [];
                    // $this->contractWhatsapp = $listing['contractWhatsapp'] ?? '';
                    $this->fromName = $listing['fromName'] ?? '';
                    // $this->hasForm = $listing['hasForm'] ?? false;
                    $this->specificCategories = $listing['specificCategory']['name'] ?? '';
                    $this->bookings = $listing['bookings'] ?? [];
                }
            }
        } catch (\Exception $e) {
            Log::error('Error fetching listing details: ' . $e->getMessage());
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to fetch listing details.');
        }
    }
    public function render()
    {
        $pages = $this->getPaginationPages();
        $hasPrevious = $this->currentPage > 1;
        $hasNext = $this->currentPage < ($this->pagination['pages'] ?? 1);

        return view(
            'livewire.admin.listing',
            [
                'pages' => $pages,
                'hasPrevious' => $hasPrevious,
                'hasNext' => $hasNext,
                'categories' => $this->specificCategories(),
            ]
        );
    }
}
