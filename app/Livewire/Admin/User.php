<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class User extends Component
{
    public $users = [];
    public $openActions = null; // Tracks the ID of the user whose dropdown is open

    /**
     * Livewire's lifecycle hook that runs once on component initialization.
     */
    public function mount()
    {
        $this->fetchUsers();
    }

    /**
     * Fetches users from the API.
     */
    public function fetchUsers()
    {
        $token = Session::get('api_token');

        if (!$token) {
            return $this->redirectRoute('login', navigate: true);
        }

        $response = Http::withToken($token)->get('https://backend-ab.mtscorporate.com/api/users');

        if ($response->successful()) {
            $data = $response->json();
            $this->users = $data['data']['users'] ?? [];
        } else {
            $this->users = [];
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
            $this->fetchUsers(); // Refresh the list
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
        // Placeholder for edit logic.
        // You might redirect to an edit page or open a modal.
        // E.g., return $this->redirectRoute('users.edit', ['user' => $userId]);
        Session::flash('info', "Edit action for user ID: {$userId}");
    }

    /**
     * Handles the activate action.
     * @param int $userId The ID of the user to activate.
     */
    public function activateUser($userId)
    {
        // Placeholder for activate logic.
        // You would make an API call to activate the user.
        // E.g., Http::withToken($token)->post('.../activate/' . $userId);
        Session::flash('info', "Activate action for user ID: {$userId}");
        $this->fetchUsers(); // Refresh the list
    }

    /**
     * Handles the deactivate action.
     * @param int $userId The ID of the user to deactivate.
     */
    public function deactivateUser($userId)
    {
        // Placeholder for deactivate logic.
        // You would make an API call to deactivate the user.
        // E.g., Http::withToken($token)->post('.../deactivate/' . $userId);
        Session::flash('info', "Deactivate action for user ID: {$userId}");
        $this->fetchUsers(); // Refresh the list
    }

    /**
     * Handles sending the payment link.
     * @param int $userId The ID of the user to send the link to.
     */
    public function sendPaymentLink($userId)
    {
        Session::flash('info', "Sending payment link to user ID: {$userId}");
        $this->fetchUsers(); // Refresh the list
    }

    public function render()
    {
        return view('livewire.admin.user');
    }
}
