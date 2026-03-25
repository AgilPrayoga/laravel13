<div class="{{ $sidebarOpen ? 'block' : 'hidden' }} sm:block ">
    <div class="h-15 px-5 py-5 border-b  border-gray-300 w-full flex  items-center ">

        @if ($sidebarOpen)
            <div wire:click="toggleSidebar" class="font-bold text-xl text-gray-600 cursor-pointer w-8 h-8 flex justify-center items-center p-1 rounded-lg hover:bg-gray-200 ">
                <i class="bi bi-list"></i>
            </div>
            <h1 class="font-bold text-3xl text-gray-600 ml-3">
                Edu Portal
            </h1>
        @endif
        @if (!$sidebarOpen)
            <div wire:click="toggleSidebar" class="font-bold text-xl text-gray-600 cursor-pointer w-8 h-8 flex justify-center items-center  p-1 rounded-lg hover:bg-gray-200 ">
                <i class="bi bi-list-nested"></i>

            </div>
        @endif

    </div>
    <div class="flex  flex-col h-screen overflow-hidden border-r px-5 border-gray-300 transition-all duration-300
    {{ $sidebarOpen ? 'w-72' : 'w-20' }}">
        <p class="text-sm mt-3 m-2 py-3 text-gray-400"></i> MENU</p>
        <nav class=" text-gray-500">
            <ul>
                <div>

                    {{-- Beranda --}}
                    <a wire:navigate href="{{ route('dashboard') }}"
                        class="block  p-3 rounded-xl hover:bg-gray-200 active:bg-blue-200 active:text-blue-400 {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-500' : '' }} transition">
                        <i class="mr-2 bi bi-grid"></i>
                        @if ($sidebarOpen)
                            Beranda
                        @endif
                    </a>
                    <a href="#" class="block  p-3 rounded-xl hover:bg-gray-200 active:bg-blue-200 active:text-blue-400  transition">
                        <i class="mr-2 bi bi-journals"></i>
                        @if ($sidebarOpen)
                            Kursus
                        @endif
                    </a>

                    <h3 wire:click="toggle('mk')" class=" p-3 rounded-xl hover:bg-gray-200 active:bg-blue-200 active:text-blue-400 cursor-pointer flex justify-between items-center transition">
                        <span><i class="mr-2 bi bi-highlighter "></i>
                            @if ($sidebarOpen)
                                Managemen Kursus
                            @endif
                        </span>
                        @if ($sidebarOpen)
                            <i class="bi {{ in_array('mk', $openMenus) ? 'bi-chevron-down' : 'bi-chevron-right' }}"></i>
                        @endif
                    </h3>

                    @if (in_array('mk', $openMenus))
                        <ul class="ml-5 space-y-1 transition-all duration-300">
                            <li>
                                <a wire:navigate href="{{ route('courses.index') }}" class="block p-2 rounded-xl hover:bg-gray-200 active:bg-blue-200 active:text-blue-400 ">
                                    @if ($sidebarOpen)
                                        Kursus
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="{{ route('categories.index') }}" class="block p-2 rounded-xl hover:bg-gray-200 active:bg-blue-200 active:text-blue-400 ">
                                    @if ($sidebarOpen)
                                        Kategori Kursus
                                    @endif
                                </a>
                            </li>
                        </ul>
                    @endif


                </div>
            </ul>
        </nav>
    </div>

</div>
