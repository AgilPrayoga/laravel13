<div>
    <div class="border text-outfit text-gray-500 border-gray-300 rounded-xl bg-white  w-full">
        <div class="border-b p-3 border-gray-300">
            <h3 class="text-2xl">{{ $isEdit ? 'Ubah' : 'Tambahkan' }} Kategori</h3>
        </div>
        <div class="p-3">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-6">
                <div class="">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama kategori</label>
                    <input type="text" id="name" wire:model="categoryName" class="w-full   px-3 py-2 mt-1 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="Masukan Nama Kategori">
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="w-fit px-4 py-2 font-bold text-white rounded-lg  {{ $isEdit ? 'bg-blue-300  hover:bg-blue-400' : 'bg-green-300  hover:bg-green-400 ' }}{{ $isEdit ? 'bg-blue-300  hover:bg-blue-400' : 'bg-green-300  hover:bg-green-400 ' }} ">
                        @if ($isEdit)
                            Update
                            <i class="bi bi-pencil-square"></i>
                        @else
                            Submit <i class="bi bi-send"></i>
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
