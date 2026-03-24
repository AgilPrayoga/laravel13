<?php

namespace App\Livewire\Modules;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function logout()
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login')
            ->with('warning', 'Anda telah logout.');
    }
    public function render()
    {
        return view('livewire.modules.dashboard');
    }
}
