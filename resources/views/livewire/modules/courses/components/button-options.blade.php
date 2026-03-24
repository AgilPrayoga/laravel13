<div class="h-full">
    <div class="flex justify-end items-end gap-3 h-full">
        <button wire:click.stop="" type="button"
            class="text-white rounded-lg  w-15 h-15  bg-indigo-300 hover:bg-transparent hover:border-indigo-500 hover:text-indigo-500 cursor-pointer border border-white shadow-lg">
            <i class="text-xl bi   bi-journal-arrow-down m-0 p-0"></i>
        </button>
        <button wire:click.stop="create" type="button"
            class="text-white rounded-lg  w-15 h-15  bg-green-300 hover:bg-transparent hover:border-green-500 hover:text-green-500 cursor-pointer border border-white shadow-lg">
            <i class="text-xl bi   bi-plus-lg m-0 p-0"></i>
        </button>

        <button
            wire:click="$dispatch('open-modal', {
        type: 'delete',
        title: 'Hapus Kursus',
        message: 'Apakah benar kamu ingin menghapus Kursus!',
        event: 'deleteCourse',
        id:{{ $courseId }}
    })"
            type="button" class="text-white  rounded-lg  w-15 h-15  bg-red-300 hover:bg-transparent hover:border-red-500 hover:text-red-500 cursor-pointer border border-text-whites shadow-lg">
            <i class="text-xl bi bi-trash"></i>
        </button>
    </div>

</div>
