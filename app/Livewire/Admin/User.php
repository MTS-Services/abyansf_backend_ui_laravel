<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class User extends Component
{
    public $users = [];

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
            // Handle case where token is missing, e.g., redirect to login
            return;
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

    // You can add other methods here for 'Edit', 'Active', 'Deactivate', etc.
    // public function editUser($userId) { ... }
    // public function activateUser($userId) { ... }
    // public function deactivateUser($userId) { ... }


    public function render()
    {
        return view('livewire.admin.user');
    }
}
