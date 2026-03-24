<div>
	<div class="p- text-outfit text-gray-600 bg-white rounded-xl border-gray-300 border shadow-lg">
		<div class="p-5 border-b border-gray-300">
			<h3 class="text-2xl">Hak Akses Roles</h3>
		</div>
		<div class="grid grid-cols-2 p-3 gap-4 items-center">

			<!-- Available -->
			<div class="border pb-2 rounded-lg border-blue-300  ">
				<div class="p-2 border-b border-blue-300">

					<h2 class=" font-semibold mb-2 w-full ">Tersedia</h2>
					<div class="relative w-full max-w-sm">

						<!-- Icon -->
						<i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

						<!-- Input -->
						<input type="text" placeholder="Search..." wire:model.live.debounce.300ms="searchAvailable"
							class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg
                    focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent transition">
					</div>
				</div>
				<div class="p-3 overflow-y-auto  bg-white overflow-x-auto h-65">
					@foreach ($this->filteredAvailable as $item)
						<a wire:click="moveToSelected({{ $item['id'] }})"
							class="w-full flex bg-gray-100 justify-between items-center mb-2 p-2 cursor-pointer hover:bg-green-200 rounded">
							<span>{{ $item['name'] }}</span>
							<i class="bi bi-arrow-right"></i>

						</a>
					@endforeach
				</div>
			</div>

			<!-- Middle Buttons -->


			<!-- Selected -->
			<div class="border pb-2 rounded-lg border-blue-300">
				<div class="p-2 border-b border-blue-300">
					<h2 class="font-semibold mb-2">Terpilih</h2>
					<div class="relative w-full max-w-sm">

						<!-- Icon -->
						<i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

						<!-- Input -->
						<input type="text" placeholder="Search..." wire:model.live.debounce.300ms="searchSelected"
							class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg
                    focus:outline-none focus:ring-2 focus:ring-blue-500
                    focus:border-transparent transition">
					</div>
				</div>
				<div class=" overflow-y-auto p-2 bg-white  overflow-x-auto h-65">
					@foreach ($this->filteredSelected as $item)
						<button wire:click="moveToAvailable({{ $item['id'] }})"
							class="w-full flex bg-green-200 justify-between items-center p-2 mb-1 hover:bg-red-200 rounded">
							<i class="bi bi-arrow-left"></i>
							<span>{{ $item['name'] }}</span>
						</button>
					@endforeach
				</div>
			</div>

		</div>

		<div class="mt-6">
			{{-- <button wire:click="save" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Save
            </button> --}}
		</div>
	</div>
</div>
