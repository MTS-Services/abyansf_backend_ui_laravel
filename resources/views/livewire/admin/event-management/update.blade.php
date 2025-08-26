<div class="container max-w-[1200px] mx-auto bg-white rounded-lg    mt-4">
    <!-- Header -->
    <div class="flex items-center justify-between p-6  border-gray-200">
        <h1 class="text-xl font-semibold text-gray-900">Edit Event</h1>

    </div>

    <!-- Form Content -->
    <div class="p-6 space-y-6">
        <!-- Photo Upload Area -->
        <div
            class="h-56 sm:h-72 md:h-[457px] bg-gray-200 rounded-lg flex items-center justify-center border-2 border-dashed transition-colors cursor-pointer">
            <div class="text-center px-2">
                <p class="text-gray-500 font-bold text-sm sm:text-base md:text-lg">Change Image</p>
            </div>
        </div>


        <!-- Title and Max Person Row -->
        <div class="  grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" placeholder="Title text"
                    class="w-full px-3 py-2 h-[50px] border border-gray-300 rounded-md bg-[#F8F6EE] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-custom-beige">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2 ">Max person</label>
                <input type="number" placeholder="Max person"
                    class="w-full px-3 py-2 h-[50px] border border-gray-300 bg-[#F8F6EE] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <!-- Description -->
        <div class="">
            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea rows="6" placeholder="Enter description"
                class="w-full px-3 py-2 h-[264] border border-gray-300  bg-[#F8F6EE] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-custom-beige resize-none"></textarea>
        </div>


        <!-- Location, Time, and Date Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Left Side (Location) -->
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                <input type="text" placeholder="Location"
                    class="w-full px-3 py-2 h-[50px] border border-gray-300 bg-[#F8F6EE] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-custom-beige">
            </div>

            <!-- Right Side (Time + Date combined) -->
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">Time & Date</label>
                <input type="datetime-local" placeholder="Select time & date"
                    class="w-full px-3 py-2 h-[50px] border border-gray-300 bg-[#F8F6EE] rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none">
            </div>
        </div>





        <!-- Checkboxes -->
        <div class=" mx-auto top-[1177px] left-[50px] opacity-100 gap-[30px] flex ">
            <label class="flex items-center">
                <input type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Active</span>
            </label>
            <label class="flex items-center">
                <input type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Disable</span>
            </label>
        </div>

        <!-- Save Button -->
        <div class="flex justify-center md:justify-start  mx-auto mt-6">
            <button
                class="px-6 py-2 bg-[#C7AE6A] text-white rounded-md hover:bg-opacity-90 transition-colors font-medium">
                Save
            </button>
        </div>


    </div>
</div>

<script>
    // Add some basic interactivity
    document.querySelector('.cursor-pointer').addEventListener('click', function() {
        // Create a file input for photo upload
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = 'image/*';
        fileInput.multiple = true;
        fileInput.click();
    });
</script>
