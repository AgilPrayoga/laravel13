<?php

namespace App\Livewire\Modules;

use App\Models\Course;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{

    public $courses_count;
    public $users_count;

    public function mount()
    {
        $this->courses_count = Course::count();
        $this->users_count = User::count();
    }
    public function render()
    {
        return view('livewire.modules.dashboard.pages.dashboard');
    }
}
