<nav class="flex items-center justify-center gap-4">
    <a href="{{ route('admin.users') }}" wire:navigate>users</a>
    <a href="{{ route('admin.bookings') }}" wire:navigate>bookings</a>
    <a href="{{ route('admin.listings') }}" wire:navigate>listings</a>
    <a href="{{ route('admin.event') }}" wire:navigate>event</a>
    <a href="{{ route('admin.attendance') }}" wire:navigate>attendance</a>
</nav>
