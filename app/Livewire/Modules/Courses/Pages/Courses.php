<?php

namespace App\Livewire\Modules\Courses\Pages;

use App\Models\Course;
use Livewire\Attributes\On;
use Livewire\Component;

class Courses extends Component
{
    public $dualistbox;
    public $selectedCourse = [];
    public $isEdit = false;
    public $selectedPermissions = [];


    #[On('findCourse')]
    public function findCategory($id)
    {
        // dd('masuk');
        $this->isEdit = true;
        $course = Course::where('id', $id)->first();
        $this->selectedCourse = $course;

        $this->dispatch(
            'fillForm',
            isEdit: $this->isEdit,
            course: $this->selectedCourse,
        );
    }
    public function mount()
    {
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
        return view('livewire.modules.courses.pages.courses');
    }
}
