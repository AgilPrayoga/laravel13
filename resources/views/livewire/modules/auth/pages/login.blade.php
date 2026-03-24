<div>
    <div class="flex   items-center justify-center min-h-screen bg-gradient-to-r from-blue-300 to-blue-700">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-xl">
            {{-- <h2 class="text-2xl text-blue-400 font-bold text-center">HRIS</h2> --}}
            <div class="flex justify-center items-center">
                <img class="w-70 h-70" src="{{ asset('assets/images/ilustrasi.png') }}" alt="">
            </div>
            <div>

                <form wire:submit.prevent="login" class="space-y-6">

                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="username" wire:model.defer="username" required placeholder="Masukan : username!"
                            class="w-full  px-3 py-2 mt-1 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <livewire:components.password-input wire:model.defer="password" />
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

                    <i my-3>belum memiliki akun? <a wire:navigate href="{{ route('regis') }}">Daftar</a></i>

                    <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700">Login</button>
                </form>

            </div>
        </div>
    </div>
</div>
