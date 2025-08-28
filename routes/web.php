<?php

use App\Livewire\Login;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', Login::class)->name('login');

// require __DIR__.'/auth.php';
require __DIR__ . '/admin.php';
