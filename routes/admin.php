<?php

use App\Livewire\Admin\AllNotification;
use App\Livewire\Admin\Attendance;
use App\Livewire\Admin\Booking;
use App\Livewire\Admin\Category;
use App\Livewire\Admin\CategoryManagement\MiniCategory;
use App\Livewire\Admin\Event;
use App\Livewire\Admin\EventManagement\Index as EventIndex;
use App\Livewire\Admin\EventManagement\Create as EventCreate;
use App\Livewire\Admin\EventManagement\Update as EventUpdate;
use App\Livewire\Admin\Listing;
use App\Livewire\Admin\ListingManagement\Index as ListingIndex;
use App\Livewire\Admin\ListingManagement\Create as ListingCreate;
use App\Livewire\Admin\ListingManagement\Update as ListingUpdate;
use App\Livewire\Admin\User;
use App\Livewire\Admin\Notification;
use App\Livewire\Admin\SubCategory;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->middleware(['api.auth'])->group(function () {
    Route::get('users', User::class)->name('users');
    Route::get('notifications', AllNotification::class)->name('all-notifications');
    Route::get('bookings', Booking::class)->name('bookings');

    Route::get('category', Category::class)->name('category');
    Route::get('sub-category', SubCategory::class)->name('sub-category');
    Route::get('mini-category', MiniCategory::class)->name('mini-category');
   



    Route::get('listings', ListingIndex::class)->name('listings');
    Route::get('listings/create', ListingCreate::class)->name('listings.create');
    Route::get('listings/{id}/update', ListingUpdate::class)->name('listings.update');

    Route::get('event', EventIndex::class)->name('event');
    Route::get('event/create', EventCreate::class)->name('event.create');
    Route::get('event/{id}/update', EventUpdate::class)->name('event.update');

    Route::get('attendance', Attendance::class)->name('attendance');
    Route::get('events', Event::class)->name('event-list');
    Route::get('listings', Listing::class)->name('listing-list');
});
