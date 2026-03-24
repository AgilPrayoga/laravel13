<?php

namespace App\Livewire\Modules\Dashboard\Pages;

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

    public function mount()
    {
        $this->dispatch(
            'updateBreadcrumb',
            icon: 'grid',
            title: 'Dashboard',
            subtitle: '',
            routePrefix: ''
        );
    }


    public function render()
    {
        return view('livewire.modules.dashboard.pages.dashboard');
    }
}
