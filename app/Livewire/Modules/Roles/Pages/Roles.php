<?php

namespace App\Livewire\Modules\Roles\Pages;

use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public $dualistbox;
    public $selectedRole = [];
    public $isEdit = false;
    public $selectedPermissions = [];


    #[On('findRole')]
    public function findRole($id)
    {
        $this->isEdit = true;
        $role = Role::where('id', $id)->first();
        $this->selectedRole = $role;

        $this->selectedPermissions = $role->permissions->pluck('name')->toArray();
        $this->dispatch(
            'fillForm',
            isEdit: $this->isEdit,
            role: $this->selectedRole,
            permissions: $this->selectedPermissions
        );
    }
    public function mount()
    {
        $this->dispatch(
            'updateBreadcrumb',
            icon: 'gear',
            title: 'Roles',
            subtitle: '',
            routePrefix: ''
        );
    }


    public function render()
    {
        return view('livewire.modules.roles.pages.roles');
    }
}
