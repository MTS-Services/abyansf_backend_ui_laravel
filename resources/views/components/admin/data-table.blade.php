   @props([
       'items' => [],
       'actions' => [],
       'columns' => [],

   ])
   <table class="min-w-full w-auto border-collapse">
          <thead>
              <tr class="bg-[#e7e7e7] text-black font-medium">
                  <th class="p-4 text-left font-medium text-base">SL</th>
                  @foreach ( $columns as $column )
                      <th class="p-4 text-left font-medium text-base">{{ $column['label'] }}</th>
                  @endforeach
                  <th class="p-4 text-right font-medium text-base">Action</th>
              </tr>
          </thead>

          <tbody class="w-full">
              @forelse ($items as $index => $item)
                  <tr wire:key="main-{{ $item['id'] }}" x-data="{ dropdownOpen: false }" class="border-b border-gray-200">
                      <td class="p-4 text-left font-playfair text-base">
                          <p class="text-black whitespace-nowrap">{{ $index + 1 }}</p>
                      </td>
                        @foreach ($columns as $column )
                              <td class="p-4 text-left font-playfair text-base">

                                   <p class="text-black whitespace-nowrap">
                                   
                                    {{ 
                                       isset($column['format']) ? $column['format']($item[$column['key']]) : $item[$column['key']];
                                    }}
                                 </p>

                             </td>
                        @endforeach
                    
                      <td class="py-3 px-6 text-right">
                          <!-- Actions -->
                          <div class="relative inline-block text-left" x-data="{ open: false }"
                              x-on:click.outside="open = false">
                              <button x-on:click="open = ! open"
                                  class="-mt-1 text-[#AD8945] rounded-full focus:outline-none" title="Settings">
                                  <flux:icon name="cog-6-tooth" class="text-[#C7AE6A]" />
                              </button>

                              <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                  x-transition:enter-start="transform opacity-0 scale-95"
                                  x-transition:enter-end="transform opacity-100 scale-100"
                                  x-transition:leave="transition ease-in duration-75"
                                  x-transition:leave-start="transform opacity-100 scale-100"
                                  x-transition:leave-end="transform opacity-0 scale-95"
                                  class="absolute right-3 -mt-1 p-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-100 ">

                                    @foreach ( $actions as $action )

                                         <button wire:click="{{ isset($action['method']) ? $action['method'].'(\''.encrypt($item['id']).'\')' : '' }}"
                                            class="w-full flex items-center px-3 py-1 rounded text-sm hover:bg-gray-100 cursor-pointer">
                                            <flux:icon name="pencil-square" class="text-[#6D6D6D] mr-2 h-4 w-4" />
                                            {{ $action['label'] }}
                                        </button>

                                    @endforeach

                              </div>

                          </div>
                      </td>

                  </tr>
              @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center">No Items Found</td>
                    </tr>
              @endforelse
          </tbody>
      </table>
