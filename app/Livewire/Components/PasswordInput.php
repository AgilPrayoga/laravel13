<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class PasswordInput extends Component
{
    public $show = false;

    #[Modelable]
    public $value;

    public function togglePassword()
    {
        $this->show = !$this->show;
    }

    public function render()
    {
        return view('livewire.components.password-input');
    }
}
