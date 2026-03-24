<?php

namespace App\Livewire\Modules\Courses\Components;

use App\Models\Course;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';
    public $dataAmount = 10;

    public $selectedRowId = null;

    public function rowSelected($id)
    {
        $this->selectedRowId = $id;
        $this->dispatch('findCourse', id: $id);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('courseUpdated')]
    public function refreshTable()
    {
        // re-render
    }

    public function render()
    {
        return view('livewire.modules.courses.components.table', [
            'courses_count' => Course::count(),
            'courses' => Course::query()
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->paginate($this->dataAmount)
        ]);
    }
}
