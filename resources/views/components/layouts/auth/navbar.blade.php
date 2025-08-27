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

<main class="p-4 sm:p-8">

    <nav class="w-full max-w-[1200px] mx-auto mt-4 sm:mt-12 p-4">
        <!-- Main heading for the dashboard -->
        <h1 class="navbar_h1 text-2xl sm:text-3xl font-semibold pb-4 sm:pb-8 text-center">
            Admin Dashboard
        </h1>

        <!-- Navigation links container -->
        <div class="w-full flex justify-between font-bold text-gray-900  tracking-wider bg-[#e7e7e7]">

            <!-- Navigation links -->
            <!-- Use a flex container that wraps and centers items on smaller screens -->
            <div
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
            </div>
        </div>
    </nav>

</main>
