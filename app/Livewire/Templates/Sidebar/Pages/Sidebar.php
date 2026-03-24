<?php

namespace App\Livewire\Templates\Sidebar\Pages;

use Livewire\Attributes\On;
use Livewire\Component;

class Sidebar extends Component
{
    public $openMenus = [];
    public $sidebarOpen = true;

    #[On('toggleBar')]
    public function toggleBar($sidebar)
    {
        $this->sidebarOpen = $sidebar;
    }

    public function toggleSidebar()
    {
        $this->sidebarOpen = !$this->sidebarOpen;
        $this->dispatch(
            'changeSidebarOpened',
            sidebar: $this->sidebarOpen,
        );
    }
    public function toggle($menu)
    {
        $this->sidebarOpen = true;
        if (in_array($menu, $this->openMenus)) {
            $this->openMenus = array_diff($this->openMenus, [$menu]);
        } else {
            $this->openMenus[] = $menu;
        }
    }
    public function render()
    {
        return view('livewire.templates.sidebar.pages.sidebar');
    }
}
