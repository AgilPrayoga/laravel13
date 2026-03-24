<?php

namespace App\Livewire\Modules\Roles\Components;

use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DualListBox extends Component
{
    public $available = [];
    public $selected = [];
    public $roleId;
    public $permission = [];
    public $searchAvailable = '';
    public $searchSelected = '';

    public function mount()
    {

        $permissions = Permission::select('id', 'name')->get();

        $this->available = $permissions->toArray();

        $this->selected = [];
    }

    #[On('fillForm')]
    public function loadRolePermissions($role)
    {
        $this->roleId = $role['id'];

        $roleModel = Role::with('permissions')->find($this->roleId);

        // Permission milik role
        $roles = $roleModel->permissions
            ->select('id', 'name');
        $this->selected = $roles->toArray();

        // Permission yang belum dimiliki
        $this->available = Permission::whereNotIn(
            'id',
            $roleModel->permissions->pluck('id')
        )
            ->select('id', 'name')
            ->get()
            ->toArray();
    }

    #[Computed]
    public function filteredAvailable()
    {
        return collect($this->available)
            ->when($this->searchAvailable, function ($collection) {
                return $collection->filter(function ($item) {
                    return str_contains(
                        strtolower($item['name']),
                        strtolower($this->searchAvailable)
                    );
                });
            })
            ->values();
    }

    #[Computed]
    public function filteredSelected()
    {
        return collect($this->selected)
            ->when($this->searchSelected, function ($collection) {
                return $collection->filter(function ($item) {
                    return str_contains(
                        strtolower($item['name']),
                        strtolower($this->searchSelected)
                    );
                });
            })
            ->values();
    }

    public function updatedRoleId()
    {
        $this->loadRolePermissions(['id' => $this->roleId]);
    }

    public function moveToSelected($id)
    {
        $item = collect($this->available)->firstWhere('id', $id);

        if ($item) {
            $this->selected[] = $item;
            $this->available = collect($this->available)
                ->reject(fn($i) => $i['id'] == $id)
                ->values()
                ->toArray();
            $this->savePermision();
        }
    }

    public function moveToAvailable($id)
    {
        $item = collect($this->selected)->firstWhere('id', $id);

        if ($item) {
            $this->available[] = $item;
            $this->selected = collect($this->selected)
                ->reject(fn($i) => $i['id'] == $id)
                ->values()
                ->toArray();
            $this->savePermision();
        }
    }

    public function savePermision()
    {
        if (!$this->roleId) return;

        $role = Role::find($this->roleId);

        $permissionNames = collect($this->selected)
            ->pluck('name')
            ->toArray();

        $role->syncPermissions($permissionNames);
    }

    public function render()
    {
        return view('livewire.modules.roles.components.dual-list-box');
    }
}
