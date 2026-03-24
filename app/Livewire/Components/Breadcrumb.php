<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class Breadcrumb extends Component
{
    public $icon = '';
    public $title = '';
    public $subTitle = '';
    public $routePrefix = '';

    #[On('updateBreadcrumb')]
    public function updateBreadcrumb(string $icon, string $title, string $subtitle, string $routePrefix)
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->subTitle = $subtitle;
        $this->routePrefix = $routePrefix;
    }

    public function mount() {}

    public function render()
    {
        return view('livewire.components.breadcrumb');
    }
}
