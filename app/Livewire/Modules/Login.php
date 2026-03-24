<?php

namespace App\Livewire\Modules;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportPageComponents\BaseLayout;

// #[Layout('layouts.guest')]
class Login extends Component
{

    public $username;
    public $password;
    public $alert;

    protected $rules = [
        'username' => 'required',
        'password' => 'required',
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

        if (Auth::attempt([
            'username' => $this->username,
            'password' => $this->password
        ])) {

            session()->regenerate();

            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('dashboard');
        } else {
            $this->addError('username', 'Username atau password salah');
            return;
        }
    }
    public function render()
    {
        dd(config('livewire.component_layout'));
        return view('livewire.modules.login');
    }
}
