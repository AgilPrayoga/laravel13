<?php

namespace App\Livewire\Modules\Courses\Components;

use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ButtonOptions extends Component
{


    public $courseInput = [];
    public $isEdit = false;
    public $courseId;

    #[On('fillForm')]
    public function fillForm($isEdit, $course)
    {
        $this->isEdit = $isEdit;
        $this->courseInput = $course;
        $this->courseId = $course['id'];
    }

    #[On('deleteCourse')]
    public function delete($id)
    {
        if (!$id) {
            $this->dispatch('notify', type: 'error', message: 'ID tidak valid');
            return;
        }

        try {

            DB::transaction(function () use ($id) {
                Course::findOrFail($id)->delete();
            });

            $this->reset(['courseId', 'courseInput', 'isEdit']);

            session()->flash('notifyAlert', [
                'type' => 'success',
                'message' => 'Kursus berhasil dihapus'
            ]);
            
            $this->dispatch('courseUpdated');

            return $this->redirectRoute('courses.index');
        } catch (\Exception $e) {

            session()->flash('notifyAlert', [
                'type' => 'error',
                'message' => 'Kursus Gagal dihapus!'
            ]);

            // optional: log error
            logger()->error($e->getMessage());
        }
    }

    public function create()
    {
        $this->redirectRoute('courses.index');
    }

    public function render()
    {
        return view('livewire.modules.courses.components.button-options');
    }
}
