<?php

namespace App\Livewire\Modules\Courses\Components;

use App\Models\Course;
use Livewire\Attributes\On;
use Livewire\Component;

class Infobox extends Component
{
    public $courses_count;
    protected $listeners = ['courseCreated' => 'refreshCount'];

    #[On('courseUpdated')]
    public function refreshCount()
    {
        $this->mount();
    }

    public function mount()
    {
        $this->courses_count = Course::count();
    }

    public function render()
    {
        return view('livewire.modules.courses.components.infobox');
    }
}
