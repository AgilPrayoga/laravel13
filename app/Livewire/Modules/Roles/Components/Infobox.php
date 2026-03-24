<?php

namespace App\Livewire\Modules\Roles\Components;

use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Infobox extends Component
{
    public $roles_count;
    protected $listeners = ['roleCreated' => 'refreshCount'];

    #[On('roleUpdated')]
    public function refreshCount()
    {
        $this->mount();
    }

    public function mount()
    {
        $this->roles_count = Role::count();
    }

    public function render()
    {
        return view('livewire.modules.roles.components.infobox');
    }
}
