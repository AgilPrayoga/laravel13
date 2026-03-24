<?php

namespace App\Livewire\Modules\Categories\Pages;

use App\Models\Categories as ModelsCategories;
use Livewire\Attributes\On;
use Livewire\Component;

class Categories extends Component
{
    public $dualistbox;
    public $selectedCategory = [];
    public $isEdit = false;
    public $selectedPermissions = [];


    #[On('findCategory')]
    public function findCategory($id)
    {
        // dd('masuk');
        $this->isEdit = true;
        $category = ModelsCategories::where('id', $id)->first();
        $this->selectedCategory = $category;

        $this->dispatch(
            'fillForm',
            isEdit: $this->isEdit,
            category: $this->selectedCategory,
        );
    }
    public function mount()
    {
        $this->dispatch(
            'updateBreadcrumb',
            icon: 'highlighter',
            title: 'Kategori Kursus',
            subtitle: '',
            routePrefix: ''
        );
    }
    public function render()
    {
        return view('livewire.modules.categories.pages.categories');
    }
}
