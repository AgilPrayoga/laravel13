<?php

namespace App\Livewire\Modules\Dashboard\Pages;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $courses_count;
    public $users_count;

    public function mount()
    {
        $this->courses_count = Course::count();
        $this->users_count = User::count();
        $this->dispatch(
            'updateBreadcrumb',
            icon: 'highlighter',
            title: 'Manajemen Kursus',
            subtitle: '',
            routePrefix: ''
        );
    }


    public function render()
    {
        return view('livewire.modules.dashboard.pages.dashboard');
    }
}
