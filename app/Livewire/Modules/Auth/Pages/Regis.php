<?php

namespace App\Livewire\Modules\Auth\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class Regis extends Component
{
    



    public function render()
    {
        return view('livewire.modules.auth.pages.regis');
    }
}
