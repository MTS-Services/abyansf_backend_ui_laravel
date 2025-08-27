<main class="flex max-w-[1200px] mx-auto ">
    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="{{ route('admin.users') }}">Users</a>
        <a href="{{ route('admin.bookings') }}">Bookings</a>
        <a href="{{ route('admin.listing-list') }}">Listings</a>
        <a href="{{ route('admin.event-list') }}">Event</a>
        <a href="{{ route('admin.attendance') }}">Attendance</a>
    </div>

    <button class="openbtn" onclick="openNav()">☰ </button>

    <nav class="desktop-nav">
        <ul class="nav-links">
            <li><a href="{{ route('admin.users') }}">Users</a></li>
            <li><a href="{{ route('admin.bookings') }}">Bookings</a></li>
            <li><a href="{{ route('admin.listing-list') }}">Listings</a></li>
            <li><a href="{{ route('admin.event-list') }}">Event</a></li>
            <li><a href="{{ route('admin.attendance') }}">Attendance</a></li>
        </ul>
    </nav>

    <div class="main-content">

    </div>
</main>

<script>
    function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main-content").style.marginLeft = "250px";
    }


    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main-content").style.marginLeft = "0";
    }
</script>



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
    <main class=" w-[1200px] mx-auto px-4 ">

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
                        <a href="{{ route('admin.users') }}"
                            class="flex-1 py-3 text-center font-semibold text-gray-800 bg-white rounded-sm shadow-sm focus:outline-none transition-colors duration-200 ease-in-out tab-active">
                            Users
                        </a>

                        <!-- Tab Item for Bookings -->
                        <a href="{{ route('admin.bookings') }}"
                            class="flex-1 py-3 text-center font-semibold text-gray-700 hover:bg-gray-200 rounded-lg focus:outline-none transition-colors duration-200 ease-in-out">
                            Bookings
                        </a>

                        <!-- Tab Item for Listings -->
                        <a href="{{ route('admin.listing-list') }}"
                            class="flex-1 py-3 text-center font-semibold text-gray-700 hover:bg-gray-200 rounded-lg focus:outline-none transition-colors duration-200 ease-in-out">
                            Listings
                        </a>

                        <!-- Tab Item for Events -->
                        <a href="{{ route('admin.event-list') }}"
                            class="flex-1 py-3 text-center font-semibold text-gray-700 hover:bg-gray-200 rounded-lg focus:outline-none transition-colors duration-200 ease-in-out">
                            Event
                        </a>

                        <!-- Tab Item for Attendance -->
                        <a href="{{ route('admin.attendance') }}"
                            class="flex-1 py-3 text-center font-semibold text-gray-700 hover:bg-gray-200 rounded-lg focus:outline-none transition-colors duration-200 ease-in-out">
                            Attendance
                        </a>
                    </div>
                </div>

                <!-- Navigation links -->
                <!-- Use a flex container that wraps and centers items on smaller screens -->
                {{-- <div
                class="w-full flex justify-between flex-col sm:flex-row border rounded-sm items-center pl-14 pr-14 p-1 text-1xl font-bold text-gray-900  tracking-wider bg-[#e7e7e7]">
                <a href="{{ route('admin.users') }}"
                    class="text-gray-900 font-medium text-lg hover:text-blue-600 transition-colors duration-200 text-center navbar_a">Users</a>
                <a href="{{ route('admin.bookings') }}"
                    class="text-gray-900 font-medium text-lg hover:text-blue-600 transition-colors duration-200 text-center">Bookings</a>
                <a href="{{ route('admin.listing-list') }}"
                    class="text-gray-900 font-medium text-lg hover:text-blue-600 transition-colors duration-200 text-center">Listings</a>
                <a href="{{ route('admin.event-list') }}"
                    class="text-gray-900 font-medium text-lg hover:text-blue-600 transition-colors duration-200 text-center">Event</a>
                <a href="{{ route('admin.attendance') }}"
                    class="text-gray-900 font-medium text-lg hover:text-blue-600 transition-colors duration-200 text-center">Attendance</a>
            </div> --}}
            </div>
        </nav>
    </main>
</div>
