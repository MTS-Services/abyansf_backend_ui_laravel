<main class="flex max-w-[1200px] mx-auto">
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
