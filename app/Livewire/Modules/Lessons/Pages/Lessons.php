<?php

namespace App\Livewire\Modules\Lessons\Pages;

use App\Models\Lessons as ModelsLessons;
use Livewire\Attributes\On;
use Livewire\Component;

class Lessons extends Component
{
    public $courseId;
    public $dualistbox;
    public $selectedCourse = [];
    public $isEdit = false;
    public $selectedPermissions = [];


    #[On('findCourse')]
    public function findCategory($id)
    {
        // dd('masuk');
        $this->isEdit = true;
        $course = ModelsLessons::where('id', $id)->first();
        $this->selectedCourse = $course;

        $this->dispatch(
            'fillForm',
            isEdit: $this->isEdit,
            course: $this->selectedCourse,
        );
    }
    public function mount($id)
    {
        $this->courseId = $id;
        $this->dispatch(
            'updateBreadcrumb',
            icon: 'highlighter',
            title: 'Manajemen Kursus',
            subtitle: 'Pelajaran',
            routePrefix: 'courses.index'
        );
    }
    public function render()
    {
        return view('livewire.modules.lessons.pages.lessons');
    }
}
