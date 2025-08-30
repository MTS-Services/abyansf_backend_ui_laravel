<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;

class User extends Component
{
    public $users = [];
    public $pagination = [];
    public $currentPage = 1;
    public $openActions = null;

    /**
     * Livewire's lifecycle hook that runs once on component initialization.
     */
    public function mount()
    {
        $this->fetchUsers();
    }

    /**
     * Listen for page changes from the pagination component
     */
    #[On('page-changed')]
    public function handlePageChange($page)
    {
        $this->fetchUsers($page);
    }

    /**
     * Direct pagination method for the User component
     * This is needed because the pagination component calls this method
     */
    public function gotoPage($page)
    {
        if ($page >= 1 && $page <= ($this->pagination['pages'] ?? 1)) {
            $this->fetchUsers($page);
        }
    }

    /**
     * Fetches users from the API.
     * @param int $page The page number to fetch.
     */
    public function fetchUsers($page = 1)
    {
        $this->currentPage = $page;
        $token = Session::get('api_token');

        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get('https://backend-ab.mtscorporate.com/api/users', [
            'page' => $this->currentPage
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->users = $data['data']['users'] ?? [];
            $this->pagination = $data['data']['pagination'] ?? [];
        } else {
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

    /**
     * Handles the delete action.
     * @param int $userId The ID of the user to delete.
     */
    public function deleteUser($userId)
    {
        $token = Session::get('api_token');
        if (!$token) {
            return;
        }

        $response = Http::withToken($token)->delete('https://backend-ab.mtscorporate.com/api/users/' . $userId);

        if ($response->successful()) {
            Session::flash('message', 'User deleted successfully.');
            $this->fetchUsers($this->currentPage); // Refresh the list
        } else {
            Session::flash('error', 'Failed to delete user.');
        }
    }

    /**
     * Handles the edit action.
     * @param int $userId The ID of the user to edit.
     */
    public function editUser($userId)
    {
        Session::flash('info', "Edit action for user ID: {$userId}");
    }

    /**
     * Handles the activate action.
     * @param int $userId The ID of the user to activate.
     */
    public function activateUser($userId)
    {
        Session::flash('info', "Activate action for user ID: {$userId}");
        $this->fetchUsers($this->currentPage);
    }

    /**
     * Handles the deactivate action.
     * @param int $userId The ID of the user to deactivate.
     */
    public function deactivateUser($userId)
    {
        Session::flash('info', "Deactivate action for user ID: {$userId}");
        $this->fetchUsers($this->currentPage);
    }

    /**
     * Handles sending the payment link.
     * @param int $userId The ID of the user to send the link to.
     */
    public function sendPaymentLink($userId)
    {
        Session::flash('info', "Sending payment link to user ID: {$userId}");
        $this->fetchUsers($this->currentPage);
    }

    public function render()
    {
        return view('livewire.admin.user');
    }
}