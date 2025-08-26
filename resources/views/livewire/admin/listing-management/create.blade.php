 <div class="max-w-5xl mx-auto bg-white rounded-lg  p-6 space-y-6 mt-10">
     <!-- Title -->
     <h2 class="text-2xl font-semibold text-gray-800">Add Listing</h2>

     <!-- Add Photos Section -->
     <div onclick="document.getElementById('photoUpload').click()"
         class="w-full h-[457px] bg-gray-200 rounded-lg flex items-center justify-center text-gray-600 text-lg cursor-pointer hover:bg-gray-300 transition">
         Add Photos
     </div>

     <input type="file" id="photoUpload" class="hidden" accept="image/*" multiple>

     <!-- Preview Slider -->
    <!-- Preview Slider -->
<div class="w-full max-w-8xl mx-auto px-4">
    <div class="overflow-x-auto scroll-smooth snap-x snap-mandatory flex gap-4 pb-8 no-scrollbar" id="previewSlider">
        <!-- Example cards -->
        <article class="flex-shrink-0 snap-start bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
            <img src="https://picsum.photos/seed/slide1/640/360" alt="Card 1" class="w-full h-40 md:h-48 object-cover" />
        </article>
        <article class="flex-shrink-0 snap-start bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
            <img src="https://picsum.photos/seed/slide2/640/360" alt="Card 2" class="w-full h-40 md:h-48 object-cover" />
        </article>
        <article class="flex-shrink-0 snap-start bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
            <img src="https://picsum.photos/seed/slide3/640/360" alt="Card 3" class="w-full h-40 md:h-48 object-cover" />
        </article>
        <article class="flex-shrink-0 snap-start bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
            <img src="https://picsum.photos/seed/slide4/640/360" alt="Card 4" class="w-full h-40 md:h-48 object-cover" />
        </article>
        <article class="flex-shrink-0 snap-start bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
            <img src="https://picsum.photos/seed/slide5/640/360" alt="Card 5" class="w-full h-40 md:h-48 object-cover" />
        </article>
        <article class="flex-shrink-0 snap-start bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
            <img src="https://picsum.photos/seed/slide6/640/360" alt="Card 6" class="w-full h-40 md:h-48 object-cover" />
        </article>
    </div>
</div>

<script>
(function() {
    const slider = document.getElementById('previewSlider');
    if (!slider) return;

    const cards = slider.querySelectorAll('article');

    // Responsive card width: mobile=2, tablet=3, desktop=5
    function updateCardWidth() {
        const containerWidth = slider.clientWidth;
        let visibleCount = 5;

        if (window.innerWidth < 640) visibleCount = 2; // mobile
        else if (window.innerWidth < 1024) visibleCount = 3; // tablet
        // else desktop = 5

        const gap = 16; // Tailwind gap-4
        const cardWidth = (containerWidth - gap * (visibleCount - 1)) / visibleCount;
        cards.forEach(card => card.style.width = `${cardWidth}px`);
    }

    window.addEventListener('resize', updateCardWidth);
    updateCardWidth();

    // Drag/Swipe to scroll
    let isDown = false, startX, scrollLeft;

    slider.addEventListener('mousedown', e => {
        isDown = true;
        slider.classList.add('cursor-grabbing');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });
    slider.addEventListener('mouseleave', () => { isDown = false; slider.classList.remove('cursor-grabbing'); });
    slider.addEventListener('mouseup', () => { isDown = false; slider.classList.remove('cursor-grabbing'); });
    slider.addEventListener('mousemove', e => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX);
        slider.scrollLeft = scrollLeft - walk;
    });

    // Touch support
    slider.addEventListener('touchstart', e => {
        startX = e.touches[0].pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });
    slider.addEventListener('touchmove', e => {
        const x = e.touches[0].pageX - slider.offsetLeft;
        const walk = (x - startX);
        slider.scrollLeft = scrollLeft - walk;
    });
})();
</script>

<style>
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
#previewSlider { cursor: grab; }
#previewSlider.cursor-grabbing { cursor: grabbing; }
</style>






     <!-- Category Selection -->
     <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
         <div>
             <label class="block text-sm font-medium mb-1">Main Service</label>
             <select
                 class="w-full border border-yellow-200 bg-[#F8F6EE] rounded p-2 h-[50px] focus:ring focus:ring-yellow-300">
                 <option>Select one category</option>
             </select>
         </div>
         <div>
             <label class="block text-sm font-medium mb-1">Sub Category</label>
             <select
                 class="w-full border border-yellow-200 bg-[#F8F6EE] rounded p-2 h-[50px] focus:ring focus:ring-yellow-300">
                 <option>Select one category</option>
             </select>
         </div>
         <div>
             <label class="block text-sm font-medium mb-1">Specific Category</label>
             <select
                 class="w-full border border-yellow-200 bg-[#F8F6EE] rounded p-2 h-[50px] focus:ring focus:ring-yellow-300">
                 <option>Select one category</option>
             </select>
         </div>
     </div>

     <!-- Description -->
     <div>
         <label class="block text-sm font-medium mb-1">Description</label>
         <textarea class="w-full border border-yellow-200 rounded p-2 h-[264px] focus:ring focus:ring-yellow-300"
             placeholder="Enter description"></textarea>
     </div>

     <!-- Location & Open Time -->
     <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
         <div>
             <label class="block text-sm font-medium mb-1">Location</label>
             <input type="text" placeholder="Location"
                 class="w-full border border-yellow-200 bg-[#F8F6EE] rounded p-2 h-[50px] focus:ring focus:ring-yellow-300" />
         </div>
         <div>
             <label class="block text-sm font-medium mb-1">Open time</label>
             <input type="text" placeholder="Open time"
                 class="w-full border border-yellow-200 bg-[#F8F6EE] rounded p-2 h-[50px] focus:ring focus:ring-yellow-300" />
         </div>
     </div>

     <!-- Status -->
     <div class="flex items-center space-x-6">
         <label class="flex items-center space-x-2">
             <input type="checkbox" class="form-checkbox" />
             <span>Active</span>
         </label>
         <label class="flex items-center space-x-2">
             <input type="checkbox" class="form-checkbox" />
             <span>Disable</span>
         </label>
     </div>

     <!-- Save Button -->
     <div class="flex justify-center md:justify-start">
         <button class="px-8 py-2 bg-[#C7AE6A] text-white rounded-md hover:bg-opacity-90 transition-colors font-medium">
             Save
         </button>
     </div>
 </div>

 <script>
     const input = document.getElementById("photoUpload");
     const previewSlider = document.getElementById("previewSlider");

     input.addEventListener("change", () => {
         previewSlider.innerHTML = "";

         [...input.files].forEach((file) => {
             const reader = new FileReader();

             reader.onload = e => {
                 // wrapper div
                 const wrapper = document.createElement("div");
                 wrapper.className = "relative flex-shrink-0 w-[20%]"; // 5 images visible on desktop

                 // image
                 const img = document.createElement("img");
                 img.src = e.target.result;
                 img.className = "w-full h-32 object-cover rounded-lg";

                 // delete button
                 const delBtn = document.createElement("button");
                 delBtn.innerHTML = "❌";
                 delBtn.className =
                     "absolute top-1 right-1 bg-black bg-opacity-50 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600";
                 delBtn.onclick = () => wrapper.remove();

                 wrapper.appendChild(img);
                 wrapper.appendChild(delBtn);
                 previewSlider.appendChild(wrapper);
             };

             reader.readAsDataURL(file);
         });
     });
 </script>
