<div>
    <div class="relative w-full ">
        <!-- Input -->
        <input type="{{ $show ? 'text' : 'password' }}" placeholder="{{ $show ? 'Masukan Password' : '******' }}" wire:model.defer="value"
            class="w-full  px-3 py-2 mt-1 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
        <!-- Icon -->
        <i wire:click='togglePassword'
            class="bi  @if ($show) bi-eye-slash @else bi-eye @endif absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 cursor-pointer"></i>
    </div>
</div>
