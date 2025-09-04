<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class User extends Component
{
    use WithFileUploads;
    // Livewire properties
    public $users = [];
    public $pagination = [];
    public $openActions = null;
    public $currentPage = 1;

    public $name;
    public $email;
    public $whatsapp;
    public $password;
    public $image;

    public $userEditModal = false;

    // Properties for the new modal
    public $showConfirmationModal = false;
    public $userId;
    public $paymentType;
    public $selectedUser;

    protected $queryString = [
        'currentPage' => ['as' => 'page', 'except' => 1]
    ];

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        $this->currentPage = request()->query('page', 1);
        $this->fetchUsers($this->currentPage);
    }

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
            $this->currentPage = $page;
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load users from the API.');
            $this->users = [];
            $this->pagination = [];
            Session::flash('error', 'Failed to load users from the API.');
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


    public function userEditModall($userId = null)
    {
        $this->userEditModal = true;
        if ($this->userEditModal && $userId) {
            $this->user($userId); // load event data
        }
    }
    public function user($userId)
    {
        $this->userId = $userId;

        $decryptedId = decrypt($userId);
        $response = Http::withToken(api_token())->get(api_base_url() . "/users/search/{$decryptedId}");

        if ($response->successful()) {
            $json = $response->json();

            if (isset($json['data'])) {
                $user = $json['data'];

                $this->name       = $user['name'] ?? '';
                $this->email     = $user['email'] ?? '';
                $this->whatsapp  = $user['whatsapp'] ?? '';
                $this->password  = $user['password'] ?? '';
                $this->image = $user['profile_pic'] ?? null;
            }
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to fetch event details.');
        }
    }
    public function updateUser()
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'whatsapp' => $this->whatsapp,
            'password' => $this->password,
        ];
        $request = Http::withToken(api_token());

        // You MUST re-add the attach part to send the image
        if ($this->image && !filter_var($this->image, FILTER_VALIDATE_URL)) {
            $request->attach(
                'profile_pic',
                file_get_contents($this->image->getRealPath()),
                $this->image->getClientOriginalName()
            );
        }


        // Use post() with the _method field.
        $response = $request->put(api_base_url() . '/users/' . decrypt($this->userId), $data);

        
        if ($response->successful()) {
            $this->reset([
                'name',
                'email',
                'whatsapp',
                'password',
                'profile_pic',
            ]);

            $this->userEditModal = false; // Close the modal();
            $this->dispatch('sweetalert2', type: 'success', message: 'User updated successfully.');
            $this->fetchUsers();
        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to update user. Please try again.');
        }
    }

    public function confirmUserPaid($userId)
    {
        $this->userId = $userId;
        $this->paymentType = null;
        $this->showConfirmationModal = true;
    }

    public function closeModal()
    {
        $this->userEditModal = false;
        $this->showConfirmationModal = false;
        $this->reset(['userId', 'paymentType',]);
    }

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

    public function sendPaymentLink($userId)
    {
        try {
            // Find the user from the current fetched users array
            $user = collect($this->users)->firstWhere('id', $userId);

            if (! $user || ! ($user['is_operational'] ?? false)) {
                $this->dispatch('sweetalert2', type: 'error', message: 'This user is not operational. Payment link not available.');
                return;
            }

            $response = Http::withToken(config('services.payment.token'))
                ->post(api_base_url() . '/send-payment-link', ['userId' => $user['id']]);

            if ($response->successful()) {
                // Assuming you have a way to update the local state without a full reload
                // For a more robust solution, you could refetch the single user or the whole list
                $this->fetchUsers($this->currentPage);
                $this->dispatch('sweetalert2', type: 'success', message: 'Payment link sent successfully!');
            } else {
                $this->dispatch('sweetalert2', type: 'error', message: 'Failed to send payment link. Please try again.');
            }
        } catch (\Exception $e) {
            $this->dispatch('sweetalert2', type: 'error', message: 'An error occurred: ' . $e->getMessage());
        }
    }

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

    public function activateUser($userId)
    {
        $this->dispatch('sweetalert2', type: 'info', message: "Activate action for user ID: {$userId}");
        $this->fetchUsers($this->currentPage);
    }

    public function deactivateUser($userId)
    {
        $this->dispatch('sweetalert2', type: 'info', message: "Deactivate action for user ID: {$userId}");
        $this->fetchUsers($this->currentPage);
    }

    public function gotoPage($page)
    {
        if ($page >= 1 && $page <= ($this->pagination['pages'] ?? 1)) {
            $this->fetchUsers($page);
        }
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->fetchUsers($this->currentPage - 1);
        }
    }

    public function nextPage()
    {
        if ($this->currentPage < ($this->pagination['pages'] ?? 1)) {
            $this->fetchUsers($this->currentPage + 1);
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
