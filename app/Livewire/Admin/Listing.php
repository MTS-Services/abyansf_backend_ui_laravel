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
    public $main_image;
    public $menu_images = [];
    public $sub_images = [];
    public $removed_existing_image_ids = [];

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

    public function fetchSpecificCategories()
    {
        $token = api_token();

        if (!$token) {
            Log::error('No API token found');
            return;
        }

        try {
            $response = Http::withToken($token)->get(api_base_url() . '/categories/specific');

            Log::info('Fetching specific categories', [
                'status' => $response->status(),
                'response' => $response->json()
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $this->specificCategories = $data['data']['specificCategories'] ?? [];
                
                Log::info('Categories loaded', [
                    'count' => count($this->specificCategories)
                ]);
            } else {
                Log::error('Failed to fetch categories', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching specific categories', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function mount()
    {
        $this->currentPage = request()->query('page', 1);
        $this->fetchListings($this->currentPage);
        $this->fetchSpecificCategories();
    }

    public function switchAddListingModal()
    {
        $this->addListingModal = !$this->addListingModal;

        if ($this->addListingModal) {
            $this->resetForm();
            $this->fetchSpecificCategories();
        }
    }

    public function switchEditListingModal($listingId)
    {
        try {
            $this->editListingModal = true;
            $this->listingIdToEdit = decrypt($listingId);
            
            Log::info('Opening edit modal', [
                'encrypted_id' => $listingId,
                'decrypted_id' => $this->listingIdToEdit
            ]);

            // Fetch categories first
            $this->fetchSpecificCategories();

            $token = api_token();

            if (!$token) {
                throw new \Exception('API token not found');
            }

            $url = api_base_url() . '/listings/' . $this->listingIdToEdit;
            
            Log::info('Fetching listing data', [
                'url' => $url,
                'listing_id' => $this->listingIdToEdit
            ]);

            $response = Http::withToken($token)->get($url);

            Log::info('API Response', [
                'status' => $response->status(),
                'body' => $response->json()
            ]);

            if ($response->successful()) {
                $this->listingData = $response->json();
                $this->fillFormWithData();
                
                Log::info('Form filled with data', [
                    'name' => $this->name,
                    'specificCategoryId' => $this->specificCategoryId,
                    'contractWhatsapp' => $this->contractWhatsapp
                ]);
            } else {
                Log::error('Failed to fetch listing', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to fetch listing data.');
            }
        } catch (\Exception $e) {
            Log::error('Error in switchEditListingModal', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred: ' . $e->getMessage());
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
        
        return [];
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

        $payload = [
            'specificCategoryId' => $this->specificCategoryId,
            'name' => $this->name,
            'location' => $this->location,
            'contractWhatsapp' => $this->contractWhatsapp,
        ];

        if (!empty($this->description)) {
            $payload['description'] = $this->description;
        }

        if (!empty($this->hours)) {
            $payload['hours'] = json_encode([$this->hours]);
        }

        if ($this->contractWhatsapp == 'false') {
            if (!empty($this->fromName)) {
                $payload['fromName'] = $this->fromName;
            }
            $payload['hasForm'] = $this->hasForm ? 'true' : 'false';
        }

        try {
            $request = Http::withToken($token)->asMultipart();

            if ($this->main_image) {
                $request->attach(
                    'main_image',
                    file_get_contents($this->main_image->getRealPath()),
                    $this->main_image->getClientOriginalName()
                );
            }

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

            Log::info('Sending listing data', [
                'payload' => $payload,
                'has_main_image' => !empty($this->main_image),
                'menu_images_count' => !empty($this->menu_images) ? count($this->menu_images) : 0,
                'sub_images_count' => !empty($this->sub_images) ? count($this->sub_images) : 0
            ]);

            $response = $request->post(api_base_url() . '/listings', $payload);

            if ($response->successful()) {
                $this->dispatch('sweetalert2', type: 'success', message: 'Listing created successfully!');

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

                Log::error('API Error Response: ' . $response->body());

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

    public function fillFormWithData()
    {
        try {
            if (!$this->listingData) {
                Log::error('No listing data to fill form');
                return;
            }

            $data = $this->listingData['data'] ?? [];

            Log::info('Filling form with data', [
                'raw_data' => $data
            ]);

            // Basic fields
            $this->name = $data['name'] ?? '';
            $this->description = $data['description'] ?? '';
            $this->location = $data['location'] ?? '';
            
            // FIXED: Get specific_category_id correctly - check multiple possible keys
            if (isset($data['specific_category_id'])) {
                $this->specificCategoryId = $data['specific_category_id'];
            } elseif (isset($data['specificCategoryId'])) {
                $this->specificCategoryId = $data['specificCategoryId'];
            } elseif (isset($data['specificCategory']['id'])) {
                $this->specificCategoryId = $data['specificCategory']['id'];
            } else {
                $this->specificCategoryId = null;
            }
            
            Log::info('Category ID set', [
                'specificCategoryId' => $this->specificCategoryId
            ]);

            // Hours field
            $hours = $data['hours'] ?? [];
            if (is_array($hours) && !empty($hours)) {
                $this->hours = $hours[0] ?? '';
            } else {
                $this->hours = is_string($hours) ? $hours : '';
            }

            // Contract WhatsApp field - FIXED: Convert boolean/int to string
            if (isset($data['contract_whatsapp'])) {
                $this->contractWhatsapp = $data['contract_whatsapp'] ? 'true' : 'false';
            } else {
                $this->contractWhatsapp = 'true';
            }

            // Conditional fields
            $this->fromName = $data['from_name'] ?? '';
            
            // FIXED: Convert boolean/int to string for hasForm
            if (isset($data['has_form'])) {
                $this->hasForm = $data['has_form'] ? 'true' : 'false';
            } else {
                $this->hasForm = 'false';
            }

            // Set existing images
            $this->existing_main_image = $data['main_image'] ?? null;
            $this->existing_menu_images = $data['menu_images'] ?? $data['menuImages'] ?? [];
            $this->existing_sub_images = $data['sub_images'] ?? [];

            // Clear temporary properties
            $this->main_image = null;
            $this->menu_images = [];
            $this->sub_images = [];
            $this->removed_existing_image_ids = [];

            Log::info('Form filled successfully', [
                'name' => $this->name,
                'specificCategoryId' => $this->specificCategoryId,
                'contractWhatsapp' => $this->contractWhatsapp,
                'hasForm' => $this->hasForm,
                'fromName' => $this->fromName
            ]);
        } catch (\Exception $e) {
            Log::error('Error filling form', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function updateListing()
    {
        try {
            Log::info('Starting update listing', [
                'listing_id' => $this->listingIdToEdit,
                'specificCategoryId' => $this->specificCategoryId,
                'name' => $this->name,
                'contractWhatsapp' => $this->contractWhatsapp
            ]);

            // Dynamic validation rules
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

            if ($this->contractWhatsapp == 'false') {
                $rules['fromName'] = 'nullable|string|max:255';
                $rules['hasForm'] = 'required|in:true,false';
            }

            $this->validate($rules);

            $token = api_token();
            if (!$token) {
                throw new \Exception('Authentication token not found.');
            }

            // Build payload
            $payload = [
                'specificCategoryId' => $this->specificCategoryId,
                'name' => $this->name,
                'location' => $this->location,
                'contractWhatsapp' => $this->contractWhatsapp,
            ];

            if (!empty($this->description)) {
                $payload['description'] = $this->description;
            }

            if (!empty($this->hours)) {
                $payload['hours'] = json_encode([$this->hours]);
            }

            if ($this->contractWhatsapp == 'false') {
                if (!empty($this->fromName)) {
                    $payload['fromName'] = $this->fromName;
                }
                $payload['hasForm'] = $this->hasForm ? 'true' : 'false';
            }

            if (!empty($this->removed_existing_image_ids)) {
                $payload['removed_existing_image_ids'] = json_encode($this->removed_existing_image_ids);
            }

            // Initialize multipart request
            $request = Http::withToken($token)->asMultipart();

            // Attach images
            if ($this->main_image) {
                $request->attach(
                    'main_image',
                    file_get_contents($this->main_image->getRealPath()),
                    $this->main_image->getClientOriginalName()
                );
            }

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

            // FIXED: Correct URL format for PUT request
            $url = api_base_url() . '/listings/' . $this->listingIdToEdit;

            Log::info('Sending update request', [
                'url' => $url,
                'payload' => $payload,
                'has_main_image' => !empty($this->main_image),
                'menu_images_count' => !empty($this->menu_images) ? count($this->menu_images) : 0,
                'sub_images_count' => !empty($this->sub_images) ? count($this->sub_images) : 0,
                'removed_image_ids' => $this->removed_existing_image_ids
            ]);

            // FIXED: Use PUT method correctly
            $response = $request->put($url, $payload);

            Log::info('Update response received', [
                'status' => $response->status(),
                'body' => $response->json()
            ]);

            if ($response->successful()) {
                Log::info('Listing updated successfully');
                $this->dispatch('sweetalert2', type: 'success', message: 'Listing updated successfully!');
                $this->closeEditModal();
                $this->fetchListings($this->currentPage);
            } else {
                $errorMessage = $response->json()['message'] ?? 'Failed to update listing.';
                $errors = $response->json()['errors'] ?? [];

                Log::error('API Error Response', [
                    'status' => $response->status(),
                    'message' => $errorMessage,
                    'errors' => $errors,
                    'body' => $response->body()
                ]);

                if (!empty($errors)) {
                    $errorList = collect($errors)->flatten()->implode(', ');
                    $this->dispatch('sweetalert2', type: 'error', message: $errorMessage . ': ' . $errorList);
                } else {
                    $this->dispatch('sweetalert2', type: 'error', message: $errorMessage);
                }
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', [
                'errors' => $e->errors()
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error updating listing', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
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
            'removed_existing_image_ids',
            'fromName'
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
            $response = Http::withToken(api_token())->get(api_base_url() . '/listings/' . $decryptedId);

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