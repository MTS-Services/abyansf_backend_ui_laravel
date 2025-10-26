 <div class="items-center justify-center hidden sm:flex">
     <!-- Tabs Container -->
     <div class="w-full">

         <div
             class="flex flex-col sm:flex-row bg-[#E7E7E7] rounded-md overflow-hidden shadow-sm p-1 space-y-2 sm:space-y-0 sm:space-x-1">

             <a href="{{ route('admin.category') }}" wire:navigate
                 class="font-medium flex-1 py-3 text-center  {{ request()->routeIs('admin.category') ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-700 hover:bg-gray-200' }} rounded-sm focus:outline-none transition-colors duration-200 ease-in-out tab-active">
                 Main Category
             </a>


             <!-- Tab Item for Bookings -->
             <a href="{{ route('admin.sub-category') }}" wire:navigate
                 class=" flex-1 py-3 text-center font-medium  {{ request()->routeIs('admin.sub-category') ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-700 hover:bg-gray-200' }} rounded-lg focus:outline-none transition-colors duration-200 ease-in-out">
                 Sub Category
             </a>
             <!-- Tab Item for category -->
             <a href="" wire:navigate
                 class=" flex-1 py-3 text-center font-medium   rounded-lg focus:outline-none transition-colors duration-200 ease-in-out">
                 Mini Category
             </a>

             <!-- Tab Item for Listings -->
             <a href="{{ route('admin.specific-category') }}" wire:navigate
                 class="flex-1 py-3 text-center font-medium {{ request()->routeIs('admin.specific-category') ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-700 hover:bg-gray-200' }} rounded-lg focus:outline-none transition-colors duration-200 ease-in-out">
                 Specific Category
             </a>

             <!-- Tab Item for Events -->

         </div>
     </div>
 </div>
