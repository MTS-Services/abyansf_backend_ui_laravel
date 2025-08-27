{{-- <nav class="w-[1200px] mx-auto mt-12">
    <h1 class="navbar_h1 font-semibold pb-8  ">
        Admin Dashboard</h1>
    <div
        class="min-w-full flex justify-between flex-col sm:flex-row border rounded-sm items-center pl-14 pr-14 p-2 text-1xl font-bold text-gray-900  tracking-wider bg-[#e7e7e7]">
        <a href="{{ route('admin.users') }}" class=" navbar_a">Users</a>
        <a href="{{ route('admin.bookings') }}" class="#">Bookings</a>
        <a href="#" class="#">Listings</a>
        <a href="#" class="#">Event</a>
        <a href="#" class="#">Attendance</a>
    </div>

</nav> --}}


{{-- <nav x-data="{ activeTab: 'users' }" class="container mx-auto ">
    <h1 class="font-semibold mb-8 float-left">Admin Dashboard</h1>

    <div
        class="min-w-full flex justify-between border items-center p-2 text-sm font-semibold text-gray-900 uppercase tracking-wider">
        <!-- Users -->
        <a href="{{ route('admin.users') }}" @click.prevent="activeTab = 'users'"
            :class="activeTab === 'users' ? 'ml-8 btn text-blue-600 font-bold border-b-2 border-blue-600' : 'ml-8 btn'">
            Users
        </a>

        <!-- Bookings -->
        <a href="{{ route('admin.bookings') }}" @click.prevent="activeTab = 'bookings'"
            :class="activeTab === 'bookings' ? 'text-blue-600 font-bold border-b-2 border-blue-600' : ''">
            Bookings
        </a>

        <!-- Listings -->
        <a href="#" @click.prevent="activeTab = 'listings'"
            :class="activeTab === 'listings' ? 'text-blue-600 font-bold border-b-2 border-blue-600' : ''">
            Listings
        </a>

        <!-- Event -->
        <a href="#" @click.prevent="activeTab = 'event'"
            :class="activeTab === 'event' ? 'text-blue-600 font-bold border-b-2 border-blue-600' : ''">
            Event
        </a>

        <!-- Attendance -->
         <a href="#" @click.prevent="activeTab = 'attendance'"
            :class="activeTab === 'attendance' ? 'mr-8 text-blue-600 font-bold border-b-2 border-blue-600' : 'mr-8'">
            Attendance
        </a>
    </div>
</nav> --}}



 
<div class="flex items-center justify-center font-poppins">
    <!--
        Step 1: Make the main container responsive.
        - We remove the fixed `w-[1200px]` and use a flexible container.
        - `max-w-7xl` sets a maximum width, but the container will be smaller on mobile.
        - `w-full` ensures it always takes up 100% of the available width up to that max.
        - `mx-auto` keeps it centered.
        - `px-4` adds default horizontal padding on small screens.
        - `sm:px-6` and `lg:px-8` add more padding on larger screens for better spacing.
    -->
    <main class=" w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Main navigation container -->
        <nav class="mt-8 sm:mt-12">
            <!-- Main heading for the dashboard -->
            <h1 class="navbar_h1 text-3xl md:text-4xl font-bold pb-4 sm:pb-8 text-left text-gray-800">
                Admin Dashboard
            </h1>

            <!-- Navigation links container -->
            <div class="flex items-center justify-center">
                <!-- Tabs Container -->
                <div class="w-full">
                    <!--
                        Step 2: Improve the tab styling.
                        - `flex-col` on small screens makes the tabs stack vertically.
                        - `sm:flex-row` makes them display horizontally on small screens and up.
                        - `space-y-2` on mobile adds vertical spacing between stacked tabs.
                        - `sm:space-y-0` removes that spacing on larger screens.
                        - `space-x-1` adds a small gap between the horizontal tabs.
                    -->
                    <div
                        class="flex flex-col sm:flex-row bg-[#E7E7E7] rounded-md overflow-hidden shadow-sm p-1 space-y-2 sm:space-y-0 sm:space-x-1">

                        <!-- Tab Item for Users -->
                        <!--
                            Step 3: Refine individual tab styles.
                            - We apply common button styles to all tabs.
                            - `flex-1` ensures they share the space equally.
                            - `p-3` for consistent padding.
                            - `font-semibold` and `text-gray-700` for consistent text styling.
                            - `hover:bg-gray-200` for a clear hover state.
                            - `rounded-lg` for rounded corners on all buttons.
                            - The active tab gets a different background and text color to stand out,
                              plus the custom `tab-active` class for the underline effect.
                        -->
                        <button
                            class="flex-1 py-3 text-center font-semibold text-gray-800 bg-white rounded-sm shadow-sm focus:outline-none transition-colors duration-200 ease-in-out tab-active">
                            Users
                        </button>

                        <!-- Tab Item for Bookings -->
                        <button
                            class="flex-1 py-3 text-center font-semibold text-gray-700 hover:bg-gray-200 rounded-lg focus:outline-none transition-colors duration-200 ease-in-out">
                            Bookings
                        </button>

                        <!-- Tab Item for Listings -->
                        <button
                            class="flex-1 py-3 text-center font-semibold text-gray-700 hover:bg-gray-200 rounded-lg focus:outline-none transition-colors duration-200 ease-in-out">
                            Listings
                        </button>

                        <!-- Tab Item for Events -->
                        <button
                            class="flex-1 py-3 text-center font-semibold text-gray-700 hover:bg-gray-200 rounded-lg focus:outline-none transition-colors duration-200 ease-in-out">
                            Event
                        </button>

                        <!-- Tab Item for Attendance -->
                        <button
                            class="flex-1 py-3 text-center font-semibold text-gray-700 hover:bg-gray-200 rounded-lg focus:outline-none transition-colors duration-200 ease-in-out">
                            Attendance
                        </button>
                    </div>
                </div>

            <!-- Navigation links -->
            <!-- Use a flex container that wraps and centers items on smaller screens -->

        </nav>
    </main>
</div>
