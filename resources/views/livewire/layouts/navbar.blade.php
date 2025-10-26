<div class="flex items-center justify-center font-poppins">

    <main class="max-w-[1200px] w-full mx-auto px-4">

        <!-- Main navigation container -->
        <nav class=" sm:mt-8 ">
            <!-- Main heading for the dashboard -->
            <h1 class="navbar_h1 text-4xl md:text-4xl pb-4 font-playfair font-semibold text-left text-gray-800">
                Admin Dashboard
            </h1>

            <!-- Navigation links container -->
            <div class="items-center justify-center hidden sm:flex">
                <!-- Tabs Container -->
                <div class="w-full">

                    <div
                        class="flex flex-col sm:flex-row bg-[#E7E7E7] rounded-md overflow-hidden shadow-sm p-1 space-y-2 sm:space-y-0 sm:space-x-1">

                        <a href="{{ route('admin.users') }}" wire:navigate
                            class="font-medium flex-1 py-3 text-center   {{ request()->routeIs('admin.users') ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-700 hover:bg-gray-200' }} rounded-sm focus:outline-none transition-colors duration-200 ease-in-out tab-active">
                            Users
                        </a>


                        <!-- Tab Item for Bookings -->
                        <a href="{{ route('admin.bookings') }}" wire:navigate
                            class=" flex-1 py-3 text-center font-medium  {{ request()->routeIs('admin.bookings') ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-700 hover:bg-gray-200' }} rounded-lg focus:outline-none transition-colors duration-200 ease-in-out">
                            Bookings
                        </a>
                        <!-- Tab Item for category -->
                        <a href="{{ route('admin.category') }}" wire:navigate
                            class=" flex-1 py-3 text-center font-medium  {{ request()->routeIs('admin.category') ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-700 hover:bg-gray-200' }} rounded-lg focus:outline-none transition-colors duration-200 ease-in-out">
                            Category
                        </a>

                        <!-- Tab Item for Listings -->
                        <a href="{{ route('admin.listing-list') }}" wire:navigate
                            class="flex-1 py-3 text-center font-medium {{ request()->routeIs('admin.listing-list') ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-700 hover:bg-gray-200' }} rounded-lg focus:outline-none transition-colors duration-200 ease-in-out">
                            Listings
                        </a>

                        <!-- Tab Item for Events -->
                        <a href="{{ route('admin.event-list') }}" wire:navigate
                            class="flex-1 py-3 text-center font-medium  {{ request()->routeIs('admin.event-list') ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-700 hover:bg-gray-200' }} rounded-lg focus:outline-none transition-colors duration-200 ease-in-out">
                            Event
                        </a>

                        <!-- Tab Item for Attendance -->
                        <a href="{{ route('admin.event-booking') }}" wire:navigate
                            class="flex-1 py-3 text-center font-medium rounded-sm focus:outline-none transition-colors duration-200 ease-in-out
                           {{ request()->routeIs('admin.event-booking') ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-700 hover:bg-gray-200' }}">
                            Event Booking
                        </a>
                    </div>
                </div>
            </div>
        </nav>

    </main>
</div>
