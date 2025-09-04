<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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
            return $this->redirectRoute('admin.users',  navigate: true);
        }
    }

    public function login()
    {
        $this->validate();
        $this->reset('errorMessage');

        try {
            // dd($this->email, $this->password, $this->rememberMe);
            $response = Http::post('https://backend-ab.mtscorporate.com/api/users/login', [
                'email' => $this->email,
                'password' => $this->password,
                'rememberMe' => $this->rememberMe,
            ]);
            // dd($response->json());
            if ($response->successful()) {
                $accessToken = $response->json('token');
                Session::put('api_token', $accessToken);
                return $this->redirectRoute('admin.users',  navigate: true);
            } else {
                // Set the error message directly without throwing an exception.
                $this->errorMessage = $response->json('message') ?? 'Login failed. Please check your credentials.';
            }
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            $this->errorMessage = 'An unexpected error occurred. Please try again later.';
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
