<div x-data x-cloak x-show="$wire.open" x-transition.opacity class="fixed  inset-0 flex items-center z-50 justify-center bg-black/50 backdrop-blur-sm">

    <!-- Modal Box -->
    <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="w-96 bg-white rounded-xl shadow-2xl ">
        <div class="border-b rounded-t-xl bg-red-400 text-white border-gray-300 py-3 px-6 ">
            <h2 class="text-lg font-semibold">{{ $title }}</h2>
        </div>
        <div class="p-6">
            {{ $message }}
        </div>
        <div class="border-t flex justify-center items-center gap-4 border-gray-300 p-6">

            <button wire:click="redirectEvent" class="px-4 py-2 bg-red-200 rounded">
                Ya
            </button>
            <button wire:click="$set('open', false)" class="px-4 py-2 bg-gray-200 rounded">
                Tutup
            </button>
        </div>
    </div>

</div>
