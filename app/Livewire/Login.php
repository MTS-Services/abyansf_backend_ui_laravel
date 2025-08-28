<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
// Don't need to import ValidationException if you're not throwing it for this case

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $rememberMe = false;
    public $errorMessage = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function mount()
    {
        if (api_is_authenticated()) {
            $this->redirect(route('admin.users'));
        }
    }

    public function login()
    {
        $this->validate();
        $this->reset('errorMessage');

        try {
            $response = Http::post('https://backend-ab.mtscorporate.com/api/users/login', [
                'email' => $this->email,
                'password' => $this->password,
                'rememberMe' => $this->rememberMe,
            ]);

            if ($response->successful()) {
                $accessToken = $response->json('token');
                Session::put('api_token', $accessToken);
                $this->redirect(route('admin.users'));
            } else {
                // Set the error message directly without throwing an exception.
                $this->errorMessage = $response->json('message') ?? 'Login failed. Please check your credentials.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'An unexpected error occurred. Please try again later.';
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
