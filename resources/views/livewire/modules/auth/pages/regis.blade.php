<div>
    <div class="flex   items-center justify-center min-h-screen bg-gradient-to-r from-blue-300 to-blue-700 pt-30 sm:pt-0 ">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-xl">
            {{-- <h2 class="text-2xl text-blue-400 font-bold text-center">HRIS</h2> --}}
            <div class="flex justify-center items-center">
            </div>
            <div>

                <form wire:submit="store" class="space-y-6">
                    <a wire:navigate href="{{ route('login') }}">
                        <p class="text-blue-400"><i class="bi bi-arrow-left"></i></p>
                    </a>
                    <h1>Registrasi</h1>
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="username" wire:model.defer="username" required placeholder="Masukan username"
                            class="w-full  px-3 py-2 mt-1 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                    </div>
                    <div>
                        <label for="fullname" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="fullname" wire:model.defer="fullname" required placeholder="Masukan Nama Lengkap"
                            class="w-full  px-3 py-2 mt-1 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" wire:model.defer="email" required placeholder="Masukan Email"
                            class="w-full  px-3 py-2 mt-1 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                    </div>
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea id="address" wire:model="address" class="w-full px-3 py-2 mt-1 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-200" placeholder="Masukan Alamat Singkat"
                            required></textarea>
                    </div>
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" id="phone_number" wire:model.defer="phone_number" required placeholder="Cth.08xxxxxxxxxxxx"
                            class="w-full  px-3 py-2 mt-1 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <livewire:components.password-input wire:model.defer="password" />

                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                        <livewire:components.password-input wire:model.defer="password_confirmation" />

                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Foto Profile</label>
                        <div x-data="{ fileName: '' }"
                            class="flex items-center border border-gray-500 rounded-lg overflow-hidden focus-within:border-blue-400 focus-within:ring-2 focus-within:ring-blue-100">
                            <span class="px-3 text-xs font-medium text-gray-500 bg-gray-50 border-r border-gray-200 h-10 flex items-center whitespace-nowrap">
                                Foto
                            </span>
                            <span class="flex-1 px-3 text-sm truncate h-10 flex items-center" :class="fileName ? 'text-gray-800' : 'text-gray-400'">
                                <span x-text="fileName || 'Belum ada foto...'"></span>
                            </span>
                            <label class="px-3 text-xs font-medium text-blue-600 border-l border-gray-200 h-10 flex items-center cursor-pointer hover:bg-blue-50 transition whitespace-nowrap">
                                Pilih
                                <input type="file" wire:model="profile_picture" class="hidden" @change="fileName = $event.target.files[0]?.name ?? ''">
                            </label>
                        </div>
                    </div>


                    {{-- ====Alert Start==== --}}
                    @if (isset($alert))
                        <div class="bg-red-100 text-sm border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                            <strong class="font-bold">Peringatan !</strong>
                            <span class="block sm:inline">{{ $alert }}</span>
                        </div>
                    @endif
                    @error('loginError')
                        <div class="bg-red-100 text-sm border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                            <strong class="font-bold">Login Gagal ,</strong>
                            <span class="block sm:inline">{{ $message }}</span>
                        </div>
                    @enderror
                    {{-- ====Alert End==== --}}


                    <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700">Registrasi</button>
                </form>

            </div>
        </div>
    </div>
</div>
