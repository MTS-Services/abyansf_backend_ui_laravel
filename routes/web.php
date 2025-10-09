<?php

use App\Livewire\Forget;
use App\Livewire\Login;
use Illuminate\Support\Facades\Route;

Route::get('/login', Login::class)->name('login');

Route::get('/forget', Forget::class)->name('password.forget');

// require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
