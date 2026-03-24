<?php

namespace App\Livewire\Modules;

use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public $alert ;

    
    public function render()
    {
        return view('livewire.modules.roles');
    }
}
