<?php

namespace App\Livewire\Modules\Categories\Components;

use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ButtonOptions extends Component
{


    public $categoryInput = [];
    public $isEdit = false;
    public $categoryId;

    #[On('fillForm')]
    public function fillForm($isEdit, $category)
    {
        $this->isEdit = $isEdit;
        $this->categoryInput = $category;
        $this->categoryId = $category['id'];
    }

    #[On('deleteCategory')]
    public function delete($id)
    {
        if (!$id) {
            $this->dispatch('notify', type: 'error', message: 'ID tidak valid');
            return;
        }

        try {

            DB::transaction(function () use ($id) {
                Categories::findOrFail($id)->delete();
            });

            $this->reset(['categoryId', 'categoryInput', 'isEdit']);

            session()->flash('notifyAlert', [
                'type' => 'success',
                'message' => 'Kategori berhasil dihapus'
            ]);
            
            $this->dispatch('categoryUpdated');

            return $this->redirectRoute('categories.index');
        } catch (\Exception $e) {

            session()->flash('notifyAlert', [
                'type' => 'error',
                'message' => 'Kategori Gagal dihapus!'
            ]);

            // optional: log error
            logger()->error($e->getMessage());
        }
    }

    public function create()
    {
        $this->redirectRoute('categories.index');
    }

    public function render()
    {
        return view('livewire.modules.categories.components.button-options');
    }
}
