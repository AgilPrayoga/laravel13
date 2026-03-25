<?php

namespace App\Livewire\Modules\Auth\Pages;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('layouts.guest')]
class Regis extends Component
{
    use WithFileUploads;

    public string $fullname = '';
    public string $email = '';
    public string $username = '';
    public string $address = '';
    public string $phone_number = '';
    public $profile_picture = null;
    public string $password = '';
    public string $password_confirmation = '';

    public function store()
    {

        $picturePath = null;

        try {
            $validator = Validator::make(
                [
                    'fullname' => $this->fullname,
                    'email' => $this->email,
                    'username' => $this->username,
                    'address' => $this->address,
                    'phone_number' => $this->phone_number,
                    'profile_picture' => $this->profile_picture,
                    'password' => $this->password,
                    'password_confirmation' => $this->password_confirmation,
                ],
                [
                    'fullname' => ['required', 'string', 'min:3', 'max:255'],
                    'email' => [
                        'required',
                        'email',
                        Rule::unique('users', 'email')->whereNull('deleted_at'),
                    ],
                    'username' => [
                        'required',
                        'string',
                        'min:3',
                        'max:50',
                        Rule::unique('users', 'username'),
                    ],
                    'address' => ['required', 'string'],
                    'phone_number' => ['required', 'string', 'min:10', 'max:15'],
                    'profile_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
                    'password' => ['required', 'min:6', 'same:password_confirmation'],
                ],
                [
                    'fullname.required' => 'Nama lengkap wajib diisi.',
                    'fullname.min' => 'Nama lengkap minimal 3 karakter.',
                    'email.required' => 'Email wajib diisi.',
                    'email.email' => 'Format email tidak valid.',
                    'email.unique' => 'Email sudah terdaftar.',
                    'username.required' => 'Username wajib diisi.',
                    'username.unique' => 'Username sudah digunakan.',
                    'address.required' => 'Alamat wajib diisi.',
                    'address.min' => 'Alamat minimal 10 karakter.',
                    'phone_number.required' => 'Nomor telepon wajib diisi.',
                    'phone_number.min' => 'Nomor telepon minimal 10 digit.',
                    'phone_number.max' => 'Nomor telepon maksimal 15 digit.',
                    'profile_picture.image' => 'File harus berupa gambar.',
                    'profile_picture.mimes' => 'Format harus JPG, JPEG, PNG, atau WEBP.',
                    'profile_picture.max' => 'Ukuran maksimal 2MB.',
                    'password.required' => 'Password wajib diisi.',
                    'password.min' => 'Password minimal 6 karakter.',
                    'password.same' => 'Konfirmasi password tidak cocok.',
                ]
            );

            if ($validator->fails()) {
                $this->dispatch(
                    'showAlert',
                    type: 'error',
                    message: implode("\n", $validator->errors()->all())
                );
                return;
            }

            DB::transaction(function () use (&$picturePath) {

                if ($this->profile_picture) {
                    $picturePath = $this->profile_picture->store(
                        'users/profile_picture',
                        'public'
                    );
                }

                // create user
                $user = User::create([
                    'username' => $this->username,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                ]);

                // create profile
                UserProfile::create([
                    'user_id' => $user->id,
                    'fullname' => $this->fullname,
                    'address' => $this->address,
                    'phone_number' => $this->phone_number,
                    'profile_picture' => $picturePath,
                ]);
            });



            $this->dispatch(
                'showAlert',
                type: 'success',
                message: 'Registrasi berhasil!'
            );
            return $this->redirectRoute('login');
        } catch (\Throwable $e) {

            if ($picturePath) {
                Storage::disk('public')->delete($picturePath);
            }

            logger()->error($e);

            $this->dispatch(
                'showAlert',
                type: 'error',
                message: 'Terjadi kesalahan saat registrasi.'
            );
        }
    }

    public function render()
    {
        return view('livewire.modules.auth.pages.regis');
    }
}
