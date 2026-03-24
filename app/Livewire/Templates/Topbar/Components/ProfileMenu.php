<?php

namespace App\Livewire\Templates\Topbar\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfileMenu extends Component
{
    public $open = false;

    public function toggle()
    {
        $this->open = !$this->open;
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }
    public function render()
    {
        return view('livewire.templates.topbar.components.profile-menu');
    }
}
