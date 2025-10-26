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
    public $deleteConfirmModal = false;
    public $listingIdToDelete = null;

    // Form properties
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

    // Additional properties
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
    public $specificCategories = [];
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

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'specificCategoryId' => 'required|integer',
            'hours' => 'nullable|string',
            'contractWhatsapp' => 'nullable|in:true,false',
            'hasForm' => 'nullable|in:true,false',
            'fromName' => 'nullable|string|max:255',
            'main_image' => 'nullable|image|max:2048',
            'menu_images.*' => 'nullable|image|max:2048',
            'sub_images.*' => 'nullable|image|max:2048',
        ];
    }

    public function mount()
    {
        $this->currentPage = request()->query('page', 1);
        $this->fetchListings($this->currentPage);
        $this->fetchSpecificCategories();
    }

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
            Log::error('Error fetching categories: ' . $e->getMessage());
        }
    }

    public function fetchListings($page = 1)
    {
        $token = Session::get('api_token');

        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        try {
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
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load listings.');
                $this->listings = [];
                $this->pagination = [];
            }
        } catch (\Exception $e) {
            Log::error('Error fetching listings: ' . $e->getMessage());
            $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred while loading listings.');
        }
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
            $this->fetchSpecificCategories();

            $token = api_token();

            if (!$token) {
                throw new \Exception('API token not found');
            }

            $response = Http::withToken($token)->get(api_base_url() . '/listings/' . $this->listingIdToEdit);

            if ($response->successful()) {
                $this->listingData = $response->json();
                $this->fillFormWithData();
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to fetch listing data.');
            }
        } catch (\Exception $e) {
            Log::error('Error opening edit modal: ' . $e->getMessage());
            $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred.');
        }
    }

    public function fillFormWithData()
    {
        try {
            if (!$this->listingData) {
                return;
            }

            $data = $this->listingData['data'] ?? [];

            $this->name = $data['name'] ?? '';
            $this->description = $data['description'] ?? '';
            $this->location = $data['location'] ?? '';

            // Get category ID from multiple possible keys
            if (isset($data['specific_category_id'])) {
                $this->specificCategoryId = $data['specific_category_id'];
            } elseif (isset($data['specificCategoryId'])) {
                $this->specificCategoryId = $data['specificCategoryId'];
            } elseif (isset($data['specificCategory']['id'])) {
                $this->specificCategoryId = $data['specificCategory']['id'];
            }

            // Hours
            $hours = $data['hours'] ?? [];
            if (is_array($hours) && !empty($hours)) {
                $this->hours = $hours[0] ?? '';
            } else {
                $this->hours = is_string($hours) ? $hours : '';
            }

            // Convert boolean to string for radio buttons
            $this->contractWhatsapp = isset($data['contract_whatsapp'])
                ? ($data['contract_whatsapp'] ? 'true' : 'false')
                : 'true';

            $this->fromName = $data['from_name'] ?? '';

            $this->hasForm = isset($data['has_form'])
                ? ($data['has_form'] ? 'true' : 'false')
                : 'false';

            // Images
            $this->existing_main_image = $data['main_image'] ?? null;
            $this->existing_menu_images = $data['menu_images'] ?? $data['menuImages'] ?? [];
            $this->existing_sub_images = $data['sub_images'] ?? [];

            // Clear temporary uploads
            $this->main_image = null;
            $this->menu_images = [];
            $this->sub_images = [];
            $this->removed_existing_image_ids = [];
        } catch (\Exception $e) {
            Log::error('Error filling form: ' . $e->getMessage());
        }
    }

    public function saveListing()
    {
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

                if (!empty($errors)) {
                    $errorList = collect($errors)->flatten()->implode(', ');
                    $this->dispatch('sweetalert2', type: 'error', message: $errorMessage . ': ' . $errorList);
                } else {
                    $this->dispatch('sweetalert2', type: 'error', message: $errorMessage);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error creating listing: ' . $e->getMessage());
            $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred: ' . $e->getMessage());
        }
    }

    public function updateListing()
    {
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

        if (!empty($this->removed_existing_image_ids)) {
            $payload['removed_existing_image_ids'] = json_encode($this->removed_existing_image_ids);
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

            $url = api_base_url() . '/listings/' . $this->listingIdToEdit;
            $response = $request->put($url, $payload);

            if ($response->successful()) {
                $this->dispatch('sweetalert2', type: 'success', message: 'Listing updated successfully!');
                $this->closeEditModal();
                $this->fetchListings($this->currentPage);
            } else {
                $errorMessage = $response->json()['message'] ?? 'Failed to update listing.';
                $errors = $response->json()['errors'] ?? [];

                if (!empty($errors)) {
                    $errorList = collect($errors)->flatten()->implode(', ');
                    $this->dispatch('sweetalert2', type: 'error', message: $errorMessage . ': ' . $errorList);
                } else {
                    $this->dispatch('sweetalert2', type: 'error', message: $errorMessage);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error updating listing: ' . $e->getMessage());
            $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred: ' . $e->getMessage());
        }
    }

    public function confirmDelete($listingId)
    {
        $this->listingIdToDelete = decrypt($listingId);
        $this->deleteConfirmModal = true;
    }

    public function deleteListing()
    {
        if (!$this->listingIdToDelete) {
            $this->dispatch('sweetalert2', type: 'error', message: 'No listing selected for deletion.');
            return;
        }

        $token = api_token();
        if (!$token) {
            $this->dispatch('sweetalert2', type: 'error', message: 'Authentication token not found.');
            return;
        }

        try {
            $url = api_base_url() . '/listings/' . $this->listingIdToDelete;
            $response = Http::withToken($token)->delete($url);

            if ($response->successful()) {
                $this->dispatch('sweetalert2', type: 'success', message: 'Listing deleted successfully!');
                $this->deleteConfirmModal = false;
                $this->listingIdToDelete = null;
                $this->fetchListings($this->currentPage);
            } else {
                $errorMessage = $response->json()['message'] ?? 'Failed to delete listing.';
                $this->dispatch('sweetalert2', type: 'error', message: $errorMessage);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting listing: ' . $e->getMessage());
            $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred: ' . $e->getMessage());
        }
    }

    public function cancelDelete()
    {
        $this->deleteConfirmModal = false;
        $this->listingIdToDelete = null;
    }

    public function removeExistingImage($type, $imageUrl)
    {

        if ($type === 'menu_images') {
            // Remove from UI
            $this->existing_menu_images = collect($this->existing_menu_images)
                ->reject(function ($image) use ($imageUrl) {
                    $url = is_array($image) ? ($image['url'] ?? $image['image'] ?? '') : $image;
                    return $url === $imageUrl;
                })
                ->values()
                ->all();

            // Delete from backend
            if (!empty($imageUrl)) {
                try {
                    $response = Http::withToken(api_token())
                        ->post(api_base_url() . '/listings/delete-image', [
                            'listingId' => $this->listingIdToEdit,
                            'imageUrl' => $imageUrl
                        ]);

                    if ($response->successful()) {
                        $this->dispatch('sweetalert2', type: 'success', message: 'Menu image deleted successfully!');
                    } else {
                        $errorMessage = $response->json()['message'] ?? 'Failed to delete menu image.';
                        $this->dispatch('sweetalert2', type: 'error', message: $errorMessage);
                    }
                } catch (\Exception $e) {
                    Log::error('Error deleting menu image: ' . $e->getMessage());
                    $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred while deleting the image.');
                }
            }
        } elseif ($type === 'sub_images') {
            // Remove from UI
            $this->existing_sub_images = collect($this->existing_sub_images)
                ->reject(function ($image) use ($imageUrl) {
                    $url = is_array($image) ? ($image['url'] ?? $image['image'] ?? '') : $image;
                    return $url === $imageUrl;
                })
                ->values()
                ->all();

            // Delete from backend
            if (!empty($imageUrl)) {
                try {
                    $response = Http::withToken(api_token())
                        ->post(api_base_url() . '/listings/delete-image', [
                            'listingId' => $this->listingIdToEdit,
                            'imageUrl' => $imageUrl
                        ]);

                    if ($response->successful()) {
                        $this->dispatch('sweetalert2', type: 'success', message: 'Sub image deleted successfully!');
                    } else {
                        $errorMessage = $response->json()['message'] ?? 'Failed to delete sub image.';
                        $this->dispatch('sweetalert2', type: 'error', message: $errorMessage);
                    }
                } catch (\Exception $e) {
                    Log::error('Error deleting sub image: ' . $e->getMessage());
                    $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred while deleting the image.');
                }
            }
        } elseif ($type === 'main_image') {
            $imageUrl = $this->existing_main_image;

            $this->existing_main_image = null;

            if (!empty($imageUrl)) {
                try {
                    $response = Http::withToken(api_token())
                        ->post(api_base_url() . '/listings/delete-image', [
                            'listingId' => $this->listingIdToEdit,
                            'imageUrl' => $imageUrl
                        ]);

                    if ($response->successful()) {
                        $this->dispatch('sweetalert2', type: 'success', message: 'Main image deleted successfully!');
                    } else {
                        $errorMessage = $response->json()['message'] ?? 'Failed to delete main image.';
                        $this->dispatch('sweetalert2', type: 'error', message: $errorMessage);
                    }
                } catch (\Exception $e) {
                    Log::error('Error deleting main image: ' . $e->getMessage());
                    $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred while deleting the image.');
                }
            }
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

    public function applyFilters()
    {
        $this->fetchListings(1);
    }

    // Pagination methods
    public function gotoPage($page)
    {
        if ($page !== '...') {
            $this->fetchListings($page);
        }
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

    public function specificCategories()
    {
        return $this->specificCategories;
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
                'categories' => $this->specificCategories,
            ]
        );
    }
}
