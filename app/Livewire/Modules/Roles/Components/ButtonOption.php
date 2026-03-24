<?php

namespace App\Livewire\Modules\Roles\Components;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class ButtonOption extends Component
{
    public $roleInput = [];
    public $isEdit = false;
    public $roleId;

    #[On('fillForm')]
    public function fillForm($isEdit, $role)
    {
        $this->isEdit = $isEdit;
        $this->roleInput = $role;
        $this->roleId = $role['id'];
    }

    #[On('deleteRoles')]
    public function delete($id)
    {
        if (!$id) {
            $this->dispatch('notify', type: 'error', message: 'ID tidak valid');
            return;
        }

        try {

            DB::transaction(function () use ($id) {

                $role = Role::findOrFail($id);
                $role->permissions()->detach();
                $role->delete();
            });

            $this->reset(['roleId', 'roleInput', 'isEdit']);

            session()->flash('notifyAlert', [
                'type' => 'success',
                'message' => 'Role berhasil dihapus'
            ]);


            return $this->redirectRoute('roles.index');
        } catch (\Exception $e) {

            session()->flash('notifyAlert', [
                'type' => 'error',
                'message' => 'Role Gagal dihapus!'
            ]);

            // optional: log error
            logger()->error($e->getMessage());
        }
    }

    public function create()
    {
        $this->redirectRoute('roles.index');
    }
    public function render()
    {
        return view('livewire.modules.roles.components.button-option');
    }
}
