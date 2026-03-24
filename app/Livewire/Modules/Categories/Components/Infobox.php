<?php

namespace App\Livewire\Modules\Categories\Components;

use App\Models\Categories;
use Livewire\Attributes\On;
use Livewire\Component;

class Infobox extends Component
{
    public $categories_count;
    protected $listeners = ['categoriesCreated' => 'refreshCount'];

    #[On('categoriesUpdated')]
    public function refreshCount()
    {
        $this->mount();
    }

    public function mount()
    {
        $this->categories_count = Categories::count();
    }

    public function render()
    {
        return view('livewire.modules.categories.components.infobox');
    }
}
