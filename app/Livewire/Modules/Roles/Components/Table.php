<?php

namespace App\Livewire\Modules\Roles\Components;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Table extends Component
{
    use WithPagination;
    public $search = '';
    public $dataAmount = 10;

    public $selectedRowId = null;

    public function rowSelected($id)
    {
        $this->selectedRowId = $id;
        $this->dispatch('findRole', id: $id);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('roleUpdated')]
    public function refreshTable()
    {
        // re-render
    }

    public function render()
    {
        return view('livewire.modules.roles.components.table', [
            'roles_count' => Role::count(),
            'roles' => Role::query()
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->paginate($this->dataAmount)
        ]);
    }
}
