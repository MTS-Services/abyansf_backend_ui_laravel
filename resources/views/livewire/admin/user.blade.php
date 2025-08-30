<main>
    <div>
        <div class="max-w-[1200px] w-full mx-auto p-4 mt-5">
            <h2 class="font-medium text-3xl text-black mb-4">User Management</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal table">
                    <thead>
                        <tr class="bg-[#e7e7e7] text-black font-medium">
                            <th class="p-4 text-left font-medium text-base">ID</th>
                            <th class="p-4 text-left font-medium text-base">Name</th>
                            <th class="p-4 text-left font-medium text-base">Email</th>
                            <th class="p-4 text-left font-medium text-base">Number</th>
                            <th class="p-4 text-left font-medium text-base">Join Date</th>
                            <th class="p-4 text-left font-medium text-base">Password</th>
                            <th class="p-4 text-left font-medium text-base">Status</th>
                            <th class="p-4 text-left font-medium text-base">Payment Link</th>
                            <th class="p-4 text-center font-medium text-base">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-balck text-sm">
                        @forelse ($users as $user)
                            <tr wire:key="user-{{ $user['id'] }}">
                                <td class="p-4 text-left whitespace-nowrap font-normal">{{ $loop->iteration }}</td>
                                <td class="p-4 text-left font-normal text-base">{{ $user['name'] }}</td>
                                <td class="p-4 text-left font-normal text-base">{{ $user['email'] }}</td>
                                <td class="p-4 text-left font-normal text-base">{{ $user['whatsapp'] }}</td>
                                <td class="p-4 text-left font-normal text-base">
                                    {{ \Carbon\Carbon::parse($user['createdAt'])->format('d/m/Y') }}</td>
                                <td class="p-4 text-left font-normal text-base">
                                    {{ $user['password'] == null ? 'N/A' : '********' }}</td>
                                <td class="p-4 text-left font-normal text-base">
                                    {{ $user['isActive'] ? 'Active' : 'Inactive' }}</td>
                                <td class="p-4 text-left font-normal text-base">
                                    <a href="#"
                                        class="text-[#AD8945]">{{ $user['send_payment_link'] ? 'Sent' : 'Not Sent' }}</a>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="relative inline-block text-left" x-data="{ open: false }"
                                        x-on:click.outside="open = false">
                                        <button x-on:click="open = ! open"
                                            class="-mt-1 text-[#AD8945] rounded-full focus:outline-none"
                                            title="Settings">
                                            <flux:icon name="cog-6-tooth" class="text-[#C7AE6A]" />
                                        </button>

                                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="absolute right-3 -mt-1 p-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-20">

                                            <button wire:click="editUser({{ $user['id'] }})"
                                                class="w-full flex items-center px-3 text-sm hover:bg-gray-100 cursor-pointer">
                                                <flux:icon name="pencil-square" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                                Edit
                                            </button>

                                            <button wire:click="activateUser({{ $user['id'] }})"
                                                class="w-full flex items-center px-3 py-2 text-sm hover:bg-gray-100 cursor-pointer">
                                                <flux:icon name="check" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                                Active
                                            </button>

                                            <button wire:click="deactivateUser({{ $user['id'] }})"
                                                class="w-full flex items-center px-3 py-2 text-sm hover:bg-gray-100 cursor-pointer">
                                                <flux:icon name="x-circle" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                                Deactivate
                                            </button>

                                            <button wire:click="deleteUser({{ $user['id'] }})"
                                                class="w-full flex items-center px-3 py-2 text-sm hover:bg-red-50 cursor-pointer">
                                                <flux:icon name="trash" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="p-4 text-left whitespace-nowrap font-normal" colspan="9">No users
                                    found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
