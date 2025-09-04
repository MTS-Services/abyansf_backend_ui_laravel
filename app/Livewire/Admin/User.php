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

    // Properties for the new modal
    public $showConfirmationModal = false;
    public $userId;
    public $paymentType;

    protected $queryString = [
        'currentPage' => ['as' => 'page', 'except' => 1]
    ];

    protected $listeners = ['refreshComponent' => '$refresh'];


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

        $response = Http::withToken($token)->get(api_base_url() . '/users', [
            'page' => $page
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->users = $data['data']['users'] ?? [];
            $this->pagination = $data['data']['pagination'] ?? [];
            // Update the property after a successful fetch to avoid URL issues on failure
            $this->currentPage = $page;
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load users from the API.');
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

    // --- New Modal and SweetAlert methods ---
    /**
     * Opens the confirmation modal.
     * @param int $userId The ID of the user.
     */
    public function confirmUserPaid($userId)
    {
        $this->userId = $userId;
        $this->paymentType = null; // Reset the payment type
        $this->showConfirmationModal = true;
    }

    /**
     * Closes the confirmation modal.
     */
    public function closeModal()
    {
        $this->showConfirmationModal = false;
        $this->reset(['userId', 'paymentType']);
    }

    /**
     * Handles the payment confirmation and dispatches SweetAlert events.
     */
    public function processConfirmation()
    {
        if (!$this->paymentType) {
            $this->dispatch('sweetalert2', type: 'warning', message: 'Please select a payment type.');
            return;
        }
        try {
            $response = Http::withToken(api_token())->post(
                api_base_url() . "/users/{$this->userId}/confirm-payment",
                [
                    'packageInfo' => $this->paymentType,
                ]
            );
            if ($response->successful()) {
                $this->reset([
                    'showConfirmationModal',
                    'userId',
                    'paymentType',
                ]);
                $this->fetchUsers($this->currentPage);
                $this->dispatch('sweetalert2', type: 'success', message: 'Payment confirmed successfully!');
            } else {
                $errorMessage = $response->json('message') ?? 'Failed to confirm payment.';
                $this->dispatch('sweetalert2', type: 'error', message: $errorMessage);
            }
        } catch (\Exception $e) {
            $this->dispatch('sweetalert2', type: 'error', message: 'An unexpected error occurred: ' . $e->getMessage());
        }

        $this->closeModal();
    }

    // --- End of new methods ---


    public function sendPaymentLink($userId)
    {
        try {
            $user = User::findOrFail($userId);

            if (! $user->is_operational) {
                $this->dispatch('sweetalert2', type: 'error', message: 'This user is not operational. Payment link not available.');
                return;
            }

            $response = Http::withToken(config('services.payment.token'))
                ->post(api_base_url() . '/send-payment-link', ['userId' => $user->id]);

            if ($response->successful()) {
                Session::put('payment_link_' . $user->id, $response->json('data.link'));
                $user->update(['send_payment_link' => true]);
                $this->dispatch('sweetalert2', type: 'success', message: 'Payment link sent successfully!');
                $this->dispatch('refreshComponent');
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to send payment link. Please try again.');
            }
        } catch (\Exception $e) {
            $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred: ' . $e->getMessage());
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
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->delete(api_base_url() . '/users/' . $userId);

        if ($response->successful()) {
            $this->dispatch('sweetalert2', type: 'success', message: 'User deleted successfully.');
            $this->fetchUsers($this->currentPage);
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to delete user.');
        }
    }

    /**
     * Handles the edit action.
     * @param int $userId The ID of the user to edit.
     */
    public function editUser($userId)
    {
        $this->dispatch('sweetalert2', type: 'info', message: "Edit action for user ID: {$userId}");
    }

    /**
     * Handles the activate action.
     * @param int $userId The ID of the user to activate.
     */
    public function activateUser($userId)
    {
        $this->dispatch('sweetalert2', type: 'info', message: "Activate action for user ID: {$userId}");
        $this->fetchUsers($this->currentPage);
    }

    /**
     * Handles the deactivate action.
     * @param int $userId The ID of the user to deactivate.
     */
    public function deactivateUser($userId)
    {
        $this->dispatch('sweetalert2', type: 'info', message: "Deactivate action for user ID: {$userId}");
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
