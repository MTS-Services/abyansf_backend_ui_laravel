<?php

use App\Livewire\Admin\Attendance;
use App\Livewire\Admin\Booking;
use App\Livewire\Admin\Event;
use App\Livewire\Admin\EventManagement\Index as EventIndex;
use App\Livewire\Admin\EventManagement\Create as EventCreate;
use App\Livewire\Admin\EventManagement\Update as EventUpdate;
use App\Livewire\Admin\ListingManagement\Index as ListingIndex;
use App\Livewire\Admin\ListingManagement\Create as ListingCreate;
use App\Livewire\Admin\ListingManagement\Update as ListingUpdate;
use App\Livewire\Admin\User;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->group(function () {
    Route::get('users', User::class)->name('users');

    Route::get('bookings', Booking::class)->name('bookings');

    Route::get('listings', ListingIndex::class)->name('listings');
    Route::get('listings/create', ListingCreate::class)->name('listings.create');
    Route::get('listings/{id}/update', ListingUpdate::class)->name('listings.update');

    Route::get('event', EventIndex::class)->name('event');
    Route::get('event/create', EventCreate::class)->name('event.create');
    Route::get('event/{id}/update', EventUpdate::class)->name('event.update');

    Route::get('attendance', Attendance::class)->name('attendance');
    Route::get('event', Event::class)->name('event-list');
});
