<?php

namespace App\Livewire\Modules\Roles\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Form extends Component
{
    public $roleInput = [];
    public $isEdit = false;
    public $roleId;
    public $roleName;
    public $alert = null;

    #[On('fillForm')]
    public function fillForm($isEdit, $role)
    {
        $this->isEdit = $isEdit;
        $this->roleName = $role['name'];
        $this->roleId = $role['id'];
    }

    public function store()
    {
        try {

            $validator = Validator::make(
                ['roleName' => $this->roleName],
                ['roleName' => 'required|min:3|unique:roles,name'],
                [
                    'roleName.required' => 'Nama role wajib diisi.',
                    'roleName.min' => 'Nama role minimal 3 karakter.',
                    'roleName.unique' => 'Role dengan nama ini sudah ada.'
                ]
            );

            if ($validator->fails()) {
                $errors = implode("\n", $validator->errors()->all());

                $this->dispatch(
                    'showAlert',
                    type: 'error',
                    message: $errors
                );
            } else {
                DB::transaction(function () {
                    Role::create([
                        'name' => $this->roleName
                    ]);
                });

                $this->dispatch('roleUpdated');
                $this->resetForm();


                $this->dispatch(
                    'showAlert',
                    type: 'success',
                    message: 'Role berhasil ditambahkan'
                );
            }
        } catch (\Throwable $e) {

            logger()->error($e);

            session()->flash('showAlert', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan role'
            ]);
        }
    }

    public function update()
    {

        try {

            $validator = Validator::make(
                ['roleName' => $this->roleName],
                ['roleName' => 'required|min:3|unique:roles,name'],
                [
                    'roleName.required' => 'Nama role wajib diisi.',
                    'roleName.min' => 'Nama role minimal 3 karakter.',
                    'roleName.unique' => 'Role dengan nama ini sudah ada.'
                ]
            );

            if ($validator->fails()) {
                $errors = implode("\n", $validator->errors()->all());
                // dd($errors);
                $this->dispatch(
                    'showAlert',
                    type: 'error',
                    message: $errors
                );
                return;
            } else {
                DB::transaction(function () {
                    $role = Role::findOrFail($this->roleId);
                    $role->update([
                        'name' => $this->roleName
                    ]);
                });

                $this->dispatch('roleUpdated');


                $this->dispatch(
                    'showAlert',
                    type: 'success',
                    message: 'Role berhasil diubah'
                );
            }
        } catch (\Throwable $e) {

            logger()->error($e);

            session()->flash('showAlert', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan role'
            ]);
        }
    }

    private function resetForm()
    {
        $this->reset(['roleInput', 'roleId', 'isEdit']);
        $this->roleName = '';
    }

    public function render()
    {
        return view('livewire.modules.roles.components.form');
    }
}
