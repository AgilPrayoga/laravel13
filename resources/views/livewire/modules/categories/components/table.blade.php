<div>
    <div class="bg-white border text-gray-500 shadow-lg  rounded-xl border-gray-300">
        <div class="px-5 py-5 w-full border-b border-gray-300 flex justify-between items-center">

            <div class="flex  justify-center items-center">
                <p class="mr-4">Tampilkan </p>
                <select class="border rounded-lg border-gray-300 p-1" wire:model.live.debounce.300ms="dataAmount" id="">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="relative w-full max-w-sm">

                <!-- Icon -->
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

                <!-- Input -->
                <input type="text" placeholder="Search..." wire:model.live.debounce.300ms="search"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg
                    focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent transition">
            </div>
        </div>
        <table class="w-full">
            <thead class="text-center">
                <tr class="border-b border-gray-300">
                    <th class="p-3">No</th>
                    <th class="p-3">Nama Kategori</th>
                    <th class="p-3">Waktu Dibuat</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @if (isset($categories))
                    @if ($categories->count() > 0)
                        @foreach ($categories as $item)
                            <tr wire:click='rowSelected({{ $item->id }})'
                                class="border-b border-gray-200 hover:bg-gray-200 cursor-pointer transition {{ $selectedRowId === $item->id ? 'bg-blue-100' : 'hover:bg-gray-50' }}">
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3">{{ $item->name }}</td>
                                <td class="p-3">{{ $item->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="border-b border-gray-200 hover:bg-gray-200  cursor-pointer transition ">
                            <td class="p-3 " colspan="3">Tidak Ada Data !</td>
                        </tr>

                    @endif
                @endif

            </tbody>

        </table>
        <div class="flex items-center justify-between space-x-2 p-3">
            <div>
                <p class="text-sm text-gray-500"> Menampilkan {{ $categories->currentPage() }} to {{ $categories->lastPage() }} dari
                    {{ $categories_count }} hasil
                </p>

            </div>
            <div>
                @php
                    $current = $categories->currentPage();
                    $last = $categories->lastPage();
                    $window = 5;

                    $start = max($current - floor($window / 2), 1);
                    $end = $start + $window - 1;

                    if ($end > $last) {
                        $end = $last;
                        $start = max($end - $window + 1, 1);
                    }
                @endphp
                @php
                    $current = $categories->currentPage();
                    $last = $categories->lastPage();
                    $window = 5;

                    $start = max($current - floor($window / 2), 1);
                    $end = $start + $window - 1;

                    if ($end > $last) {
                        $end = $last;
                        $start = max($end - $window + 1, 1);
                    }
                @endphp

                {{-- Previous --}}
                <button wire:click="previousPage" @disabled($categories->onFirstPage()) class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-100 transition disabled:opacity-50">
                    Previous
                </button>

                {{-- Show "..." if not starting from 1 --}}
                @if ($start > 1)
                    <button wire:click="gotoPage(1)" class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-100">
                        1
                    </button>

                    @if ($start > 2)
                        <span class="px-2 text-gray-400">...</span>
                    @endif
                @endif

                {{-- Page Window --}}
                @for ($i = $start; $i <= $end; $i++)
                    <button wire:click="gotoPage({{ $i }})"
                        class="px-3 py-1 rounded-md text-sm
            {{ $i == $current ? 'bg-blue-500 text-white' : 'border border-gray-300 hover:bg-gray-100' }}">
                        {{ $i }}
                    </button>
                @endfor

                {{-- Show "..." if not ending at last --}}
                @if ($end < $last)
                    @if ($end < $last - 1)
                        <span class="px-2 text-gray-400">...</span>
                    @endif

                    <button wire:click="gotoPage({{ $last }})" class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-100">
                        {{ $last }}
                    </button>
                @endif

                {{-- Next --}}
                <button wire:click="nextPage" @disabled(!$categories->hasMorePages()) class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-100 transition disabled:opacity-50">
                    Next
                </button>

            </div>

        </div>

    </div>

</div>
