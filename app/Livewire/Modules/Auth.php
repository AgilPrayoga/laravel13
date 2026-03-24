<?php

namespace App\Livewire\Modules;

use Illuminate\Support\Facades\Auth as FacadesAuth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class Auth extends Component
{
    public $username;
    public $password;
    public $alert;

    protected $rules = [
        'username' => 'required',
        'password' => 'required|min:6',
    ];

    public function mount()
    {
        if (session()->has('warning')) {
            $this->alert = session('warning');
        } else if (session()->has('error')) {
            $this->alert = session('error');
        }
    }
    public function login()
    {
        $this->reset('alert');
        $this->validate();

        if (FacadesAuth::attempt([
            'username' => $this->username,
            'password' => $this->password
        ])) {

            session()->regenerate();

            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('dashboard');
        } else {
            $this->addError('loginError', 'Username atau password salah!');
            return;
        }
    }

    public function render()
    {
        dd(config('livewire.component_layout')); 
        return view('livewire.modules.login');
    }
}
