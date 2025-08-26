{{-- <nav class="container mx-auto">
    <h1 class="font-semibold mb-8 float-left ">Admin Dashboard</h1>
    <div
        class="min-w-full flex justify-between border items-center p-2 text-sm font-semibold text-gray-900 uppercase tracking-wider ">
        <a href="{{ route('admin.users') }}" class="ml-8 btn">Users</a>
        <a href="{{ route('admin.bookings') }}" class="#">Bookings</a>
        <a href="#" class="">Listings</a>
        <a href="#" class="">Event</a>
        <a href="#" class="mr-8">Attendance</a>
    </div>

</nav> --}}


<nav x-data="{ activeTab: 'users' }" class="container mx-auto ">
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
</nav>
