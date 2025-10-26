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
    public $specificCategoriesss;
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


    // Add this method to fetch specific categories
    public function fetchSpecificCategories()
    {
        $token = api_token();

        if (!$token) {
            return;
        }

        try {
            $response = Http::withToken($token)->get(api_base_url() . '/categories/specific');

            if ($response->successful()) {
                $data = $response->json();
                $this->specificCategories = $data['data']['specificCategories'] ?? [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching specific categories: ' . $e->getMessage());
        }
    }

    // Update your mount method
    public function mount()
    {
        $this->currentPage = request()->query('page', 1);
        $this->fetchListings($this->currentPage);
        $this->fetchSpecificCategories(); // Add this line
    }

    // Update switchAddListingModal
    public function switchAddListingModal()
    {
        $this->addListingModal = !$this->addListingModal;

        if ($this->addListingModal) {
            $this->resetForm();
            $this->fetchSpecificCategories();
        }
    }

    // Update switchEditListingModal
    public function switchEditListingModal($listingId)
    {
        $this->editListingModal = true;
        $this->listingIdToEdit = decrypt($listingId);
        $this->fetchSpecificCategories();

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

    public function applyFilters()
    {

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
            'name' => $this->formName ?? '',
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

    public function fillFormWithData()
    {
        if ($this->listingData) {
            $data = $this->listingData['data'] ?? [];

            // Basic fields - same as create form
            $this->name = $data['name'] ?? '';
            $this->description = $data['description'] ?? '';
            $this->location = $data['location'] ?? '';
            $this->specificCategoryId = $data['specific_category_id'] ?? null;

            // Hours field
            $hours = $data['hours'] ?? [];
            if (is_array($hours) && !empty($hours)) {
                $this->hours = $hours[0] ?? '';
            } else {
                $this->hours = is_string($hours) ? $hours : '';
            }

            // Contract WhatsApp field
            $this->contractWhatsapp = isset($data['contract_whatsapp'])
                ? ($data['contract_whatsapp'] ? 'true' : 'false')
                : 'true';

            // Conditional fields - only load if contractWhatsapp is false
            $this->fromName = $data['from_name'] ?? '';
            $this->hasForm = isset($data['has_form'])
                ? ($data['has_form'] ? 'true' : 'false')
                : 'false';

            // Set existing images
            $this->existing_main_image = $data['main_image'] ?? null;

            // Menu images - check both 'menu_images' and 'menuImages' keys
            $this->existing_menu_images = $data['menu_images'] ?? $data['menuImages'] ?? [];

            $this->existing_sub_images = $data['sub_images'] ?? [];

            // Clear temporary properties - SET TO NULL
            $this->main_image = null;
            $this->menu_images = [];
            $this->sub_images = [];
            $this->removed_existing_image_ids = [];
        }
    }

    public function saveListing()
    {
        // Dynamic validation rules based on contractWhatsapp value
        $rules = [
            'specificCategoryId' => 'required|integer',
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'hours' => 'nullable|string',
            'contractWhatsapp' => 'required|in:true,false',
            'main_image' => 'required|image|max:2048',
            'menu_images.*' => 'nullable|image|max:2048',
            'sub_images.*' => 'nullable|image|max:2048',
        ];

        // Add conditional validation when contractWhatsapp is false (No)
        if ($this->contractWhatsapp == 'false') {
            $rules['fromName'] = 'nullable|string|max:255';
            $rules['hasForm'] = 'required|in:true,false';
        }

        $this->validate($rules);

        $token = api_token();
        if (!$token) {
            $this->dispatch('sweetalert2', type: 'error', message: 'Authentication token not found.');
            return;
        }

        // Build base payload with required fields
        $payload = [
            'specificCategoryId' => $this->specificCategoryId,
            'name' => $this->name,
            'location' => $this->location,
            'contractWhatsapp' => $this->contractWhatsapp,
        ];

        // Add optional fields if they exist
        if (!empty($this->description)) {
            $payload['description'] = $this->description;
        }

        // Add hours as JSON array format if provided
        if (!empty($this->hours)) {
            $payload['hours'] = json_encode([$this->hours]);
        }

        // Add conditional fields only when contractWhatsapp is false (No)
        if ($this->contractWhatsapp == 'false') {
            if (!empty($this->fromName)) {
                $payload['fromName'] = $this->fromName;
            }

            // hasForm is required when contractWhatsapp is false
            $payload['hasForm'] = $this->hasForm ? 'true' : 'false';
        }

        try {
            // Initialize multipart request
            $request = Http::withToken($token)->asMultipart();

            // Attach main image (required)
            if ($this->main_image) {
                $request->attach(
                    'main_image',
                    file_get_contents($this->main_image->getRealPath()),
                    $this->main_image->getClientOriginalName()
                );
            }

            // Attach menu images (optional) - Use 'menuImages' without array notation
            if (!empty($this->menu_images)) {
                // Ensure it's an array and filter out null values
                $menuImagesArray = is_array($this->menu_images) ? $this->menu_images : [$this->menu_images];

                foreach ($menuImagesArray as $menuImage) {
                    if ($menuImage && is_object($menuImage) && method_exists($menuImage, 'getRealPath')) {
                        $request->attach(
                            'menuImages',
                            file_get_contents($menuImage->getRealPath()),
                            $menuImage->getClientOriginalName()
                        );
                    }
                }
            }

            // Attach sub images (optional) - Use 'sub_images' without array notation
            if (!empty($this->sub_images)) {
                // Ensure it's an array and filter out null values
                $subImagesArray = is_array($this->sub_images) ? $this->sub_images : [$this->sub_images];

                foreach ($subImagesArray as $subImage) {
                    if ($subImage && is_object($subImage) && method_exists($subImage, 'getRealPath')) {
                        $request->attach(
                            'sub_images',
                            file_get_contents($subImage->getRealPath()),
                            $subImage->getClientOriginalName()
                        );
                    }
                }
            }

            // Log the request for debugging
            Log::info('Sending listing data', [
                'payload' => $payload,
                'has_main_image' => !empty($this->main_image),
                'menu_images_count' => !empty($this->menu_images) ? count($this->menu_images) : 0,
                'sub_images_count' => !empty($this->sub_images) ? count($this->sub_images) : 0
            ]);

            // REMOVE THE dd() STATEMENT - it stops execution!
            $response = $request->post(api_base_url() . '/listings', $payload);

            if ($response->successful()) {
                $this->dispatch('sweetalert2', type: 'success', message: 'Listing created successfully!');

                // Reset all form fields
                $this->reset([
                    'specificCategoryId',
                    'name',
                    'location',
                    'description',
                    'hours',
                    'fromName',
                    'contractWhatsapp',
                    'hasForm',
                    'main_image',
                    'menu_images',
                    'sub_images'
                ]);

                $this->switchAddListingModal();
                $this->fetchListings();
            } else {
                $errorMessage = $response->json()['message'] ?? 'Failed to create listing.';
                $errors = $response->json()['errors'] ?? [];

                // Log detailed error for debugging
                Log::error('API Error Response: ' . $response->body());

                // Show user-friendly error message
                if (!empty($errors)) {
                    $errorList = collect($errors)->flatten()->implode(', ');
                    $this->dispatch('sweetalert2', type: 'error', message: $errorMessage . ': ' . $errorList);
                } else {
                    $this->dispatch('sweetalert2', type: 'error', message: $errorMessage);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error creating listing: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updateListing()
    {
        // Dynamic validation rules - same as create
        $rules = [
            'specificCategoryId' => 'required|integer',
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'hours' => 'nullable|string',
            'contractWhatsapp' => 'required|in:true,false',
            'main_image' => 'nullable|image|max:2048',
            'menu_images.*' => 'nullable|image|max:2048',
            'sub_images.*' => 'nullable|image|max:2048',
        ];

        // Add conditional validation when contractWhatsapp is false (No)
        if ($this->contractWhatsapp == 'false') {
            $rules['fromName'] = 'nullable|string|max:255';
            $rules['hasForm'] = 'required|in:true,false';
        }

        $this->validate($rules);

        $token = api_token();
        if (!$token) {
            $this->dispatch('sweetalert2', type: 'error', message: 'Authentication token not found.');
            return;
        }

        // Build base payload - exactly same as create
        $payload = [
            'specificCategoryId' => $this->specificCategoryId,
            'name' => $this->name,
            'location' => $this->location,
            'contractWhatsapp' => $this->contractWhatsapp,
        ];

        // Add optional fields if they exist
        if (!empty($this->description)) {
            $payload['description'] = $this->description;
        }

        // Add hours as JSON array format if provided
        if (!empty($this->hours)) {
            $payload['hours'] = json_encode([$this->hours]);
        }

        // Add conditional fields only when contractWhatsapp is false (No)
        if ($this->contractWhatsapp == 'false') {
            if (!empty($this->fromName)) {
                $payload['fromName'] = $this->fromName;
            }

            // hasForm is required when contractWhatsapp is false
            $payload['hasForm'] = $this->hasForm ? 'true' : 'false';
        }

        // Add removed image IDs if any
        if (!empty($this->removed_existing_image_ids)) {
            $payload['removed_existing_image_ids'] = json_encode($this->removed_existing_image_ids);
        }

        try {
            // Initialize multipart request
            $request = Http::withToken($token)->asMultipart();

            // Attach main image if uploaded (optional for update)
            if ($this->main_image) {
                $request->attach(
                    'main_image',
                    file_get_contents($this->main_image->getRealPath()),
                    $this->main_image->getClientOriginalName()
                );
            }

            // Attach menu images (optional) - Use 'menuImages' without array notation
            if (!empty($this->menu_images)) {
                $menuImagesArray = is_array($this->menu_images) ? $this->menu_images : [$this->menu_images];

                foreach ($menuImagesArray as $menuImage) {
                    if ($menuImage && is_object($menuImage) && method_exists($menuImage, 'getRealPath')) {
                        $request->attach(
                            'menuImages',
                            file_get_contents($menuImage->getRealPath()),
                            $menuImage->getClientOriginalName()
                        );
                    }
                }
            }

            // Attach sub images (optional) - Use 'sub_images' without array notation
            if (!empty($this->sub_images)) {
                $subImagesArray = is_array($this->sub_images) ? $this->sub_images : [$this->sub_images];

                foreach ($subImagesArray as $subImage) {
                    if ($subImage && is_object($subImage) && method_exists($subImage, 'getRealPath')) {
                        $request->attach(
                            'sub_images',
                            file_get_contents($subImage->getRealPath()),
                            $subImage->getClientOriginalName()
                        );
                    }
                }
            }

            // Log the request for debugging
            Log::info('Updating listing data', [
                'listing_id' => $this->listingIdToEdit,
                'payload' => $payload,
                'has_main_image' => !empty($this->main_image),
                'menu_images_count' => !empty($this->menu_images) ? count($this->menu_images) : 0,
                'sub_images_count' => !empty($this->sub_images) ? count($this->sub_images) : 0,
                'removed_image_ids' => $this->removed_existing_image_ids
            ]);

            // Send PUT request
            $response = $request->post(api_base_url() . '/listings/' . $this->listingIdToEdit . '?_method=PUT', $payload);

            if ($response->successful()) {
                $this->dispatch('sweetalert2', type: 'success', message: 'Listing updated successfully!');
                $this->closeEditModal();
                $this->fetchListings($this->currentPage);
            } else {
                $errorMessage = $response->json()['message'] ?? 'Failed to update listing.';
                $errors = $response->json()['errors'] ?? [];

                // Log detailed error for debugging
                Log::error('API Error Response: ' . $response->body());

                // Show user-friendly error message
                if (!empty($errors)) {
                    $errorList = collect($errors)->flatten()->implode(', ');
                    $this->dispatch('sweetalert2', type: 'error', message: $errorMessage . ': ' . $errorList);
                } else {
                    $this->dispatch('sweetalert2', type: 'error', message: $errorMessage);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error updating listing: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred: ' . $e->getMessage());
        }
    }
    public function removeExistingImage($type, $id)
    {
        if ($type === 'menu_images') {
            $this->existing_menu_images = collect($this->existing_menu_images)
                ->reject(function ($image) use ($id) {
                    if (is_array($image)) {
                        return $image['id'] == $id;
                    }
                    return false;
                })
                ->values()
                ->all();

            if (!empty($id)) {
                $this->removed_existing_image_ids[] = $id;
            }
        } elseif ($type === 'sub_images') {
            $this->existing_sub_images = collect($this->existing_sub_images)
                ->reject(function ($image) use ($id) {
                    if (is_array($image)) {
                        return $image['id'] == $id;
                    }
                    return false;
                })
                ->values()
                ->all();

            if (!empty($id)) {
                $this->removed_existing_image_ids[] = $id;
            }
        } elseif ($type === 'main_image') {
            $this->existing_main_image = null;
        }
    }

    public function removeNewImage($type, $index)
    {
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
                    $this->description = $listing['description'] ?? '';
                    $this->listingHours = $listing['hours'] ?? '';
                    $this->specificCategoryId = $listing['specificCategoryId']['name'] ?? null;
                    $this->isActive = $listing['isActive'] ?? false;
                    $this->menuImages = $listing['menuImages'] ?? [];
                    $this->listingTypeofServices = $listing['typeofservice'] ?? '';
                    $this->listingVenueNames = $listing['venueName'] ?? [];
                    $this->fromName = $listing['fromName'] ?? '';
                    $this->specificCategoriesss = $listing['specificCategory']['name'] ?? '';
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
