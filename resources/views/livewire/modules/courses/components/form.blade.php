<div>
    <div class="border text-outfit text-gray-500 border-gray-300 rounded-xl bg-white  w-full">
        <div class="border-b p-3 border-gray-300">
            <h3 class="text-2xl">{{ $isEdit ? 'Ubah' : 'Tambahkan' }} Kursus</h3>
        </div>
        <div class="p-3">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-6">
                <div class="">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Kursus <i class="text-red-500">*</i></label>
                    <input type="text" id="name" wire:model="name" class="w-full   px-3 py-2 mt-1 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="Masukan Nama Kursus" required>
                </div>
                <div class="">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi <i class="text-red-500">*</i></label>
                    <textarea id="description" wire:model="description" class="w-full px-3 py-2 mt-1 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-200" placeholder="Masukan Deskripsi"
                        required></textarea>

                </div>
                <div class="">
                    <label for="start" class="block text-sm font-medium text-gray-700">Tanggal Mulai <i class="text-red-500">*</i></label>
                    <input type="date" id="start" wire:model="start" class="w-full   px-3 py-2 mt-1 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-200"
                        required>
                </div>
                <div>
                    <label for="end" class="block text-sm font-medium text-gray-700">Tanggal Selesai <i class="text-red-500">*</i></label>
                    <input type="date" id="end" wire:model="end" class="w-full   px-3 py-2 mt-1 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-200" required>
                </div>
                <div class="">
                    <label for="color" class="block text-sm font-medium text-gray-700">Warna <i class="text-red-500">*</i></label>
                    <input type="color" id="name" wire:model="color" class="w-20 h-20   px-3 py-2 mt-1 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="Pilih Warna" required>
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
