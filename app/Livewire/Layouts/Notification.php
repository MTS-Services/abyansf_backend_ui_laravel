<?php

namespace App\Livewire\Layouts;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Notification extends Component
{

    public $showPanel = false;
    public $unreadCount = 0;
    public $readCount = 0;

    public $allNotifications = [];
    
    public function mount()
    {
        $this->fetchNotifications();
    }

    public function fetchNotifications()
    {
        $response = Http::withToken(api_token())->get(api_base_url() . '/notifications/admin');

        if ($response->successful()) {
            $data = $response->json();

            $notifications = $data['data']['notifications'] ?? [];

            // Sort by created_at DESC (if exists) then take 5
            $this->allNotifications = collect($notifications)
                ->sortByDesc('created_at')
                ->take(6)
                ->values()
                ->toArray();

        } else {
            $this->dispatch('sweetalert2', type: 'error', message: 'Failed to load Notifications from the API.');
            $this->allNotifications = [];
            Session::flash('error', 'Failed to load Notifications from the API.');
        }
    }

    public function render()
    {
        return view('livewire.layouts.notification', [
            'notifications' => $this->allNotifications,
        ]);
    }
}
