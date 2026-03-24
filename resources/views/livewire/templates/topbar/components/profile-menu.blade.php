<div>
    <div class="relative ">
        <!-- Icon -->
        <button wire:click="toggle" class="focus:outline-none">
            <i class="text-xl bi bi-person-circle mr-5 text-gray-500 hover:text-gray-400 transition"></i>
        </button>

        <!-- Dropdown -->
        @if ($open)
            <div class="absolute right-5 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-200 z-50" wire:click.outside="$set('open', false)">
                <div class="px-4 py-3 border-b bg-gray-100 border-gray-200">
                    <p class="text-sm text-center font-semibold text-gray-700">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-xs text-center text-gray-500">
                        {{ auth()->user()->email }}
                    </p>
                </div>

                <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 transition">
                    <i class="bi bi-person mr-3"></i> Profile
                </a>

                <button wire:click="logout" class="w-full text-left px-4 py-2 text-sm text-gray-500 hover:bg-gray-100 transition">
                    <i class="bi bi-box-arrow-left mr-3"></i> Logout
                </button>
            </div>
        @endif
    </div>
</div>
