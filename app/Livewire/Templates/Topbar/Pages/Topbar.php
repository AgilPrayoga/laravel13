<?php

namespace App\Livewire\Templates\Topbar\Pages;

use Livewire\Attributes\On;
use Livewire\Component;

class Topbar extends Component
{
    public $sidebarOpened = true;

    public function toggleSidebar()
    {
        $this->sidebarOpened == true ? $this->sidebarOpened = false : $this->sidebarOpened = true;
        $this->dispatch(
            'toggleBar',
            sidebar: $this->sidebarOpened,
        );
    }

    #[On('changeSidebarOpened')]
    public function change($sidebar)
    {
        $this->sidebarOpened = $sidebar;
    }


    public function render()
    {
        return view('livewire.templates.topbar.pages.topbar');
    }
}
