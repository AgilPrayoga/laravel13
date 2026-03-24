<?php

namespace App\Livewire\Modules\Categories\Components;

use App\Models\Categories;
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
        $this->dispatch('findCategory', id: $id);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('categoryUpdated')]
    public function refreshTable()
    {
        // re-render
    }

    public function render()
    {
        return view('livewire.modules.categories.components.table', [
            'categories_count' => Categories::count(),
            'categories' => Categories::query()
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->paginate($this->dataAmount)
        ]);
    }
}
