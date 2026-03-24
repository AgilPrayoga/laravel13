<div class="fixed top-5 right-5 z-[9999]">
    <div x-cloak style="display:none" x-data="{
        show: @entangle('show').live,
        timer: null
    }" x-show="show" x-init="$watch('show', value => {
        if (value) {
            clearTimeout(timer)
            timer = setTimeout(() => show = false, 3000)
        }
    })" x-transition:enter="transform ease-out duration-300" x-transition:enter-start="translate-x-10 opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transform ease-in duration-200" x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="translate-x-10 opacity-0" @class([
            'px-6 py-4 rounded-xl shadow-lg text-white flex items-center gap-3',
            'bg-green-400' => $type === 'success',
            'bg-amber-400' => $type === 'warning',
            'bg-blue-400' => $type === 'info',
            'bg-red-400' => $type === 'error',
        ])>
        <!-- Icon -->
        @if ($type == 'success')
            <i class="bi bi-check-lg"></i>
        @elseif($type == 'warning')
            <i class="bi bi-exclamation-lg"></i>
        @elseif($type == 'info')
            <i class="bi bi-info"></i>
        @elseif($type == 'error')
            <i class="bi bi-exclamation-lg"></i>
        @endif

        <span class="font-medium whitespace-pre-line">{{ $message }}</span>

        <!-- Close Button -->
        <button wire:click="closeAlert" class="ml-4 text-white hover:text-gray-200">
            ✕
        </button>
    </div>
</div>
