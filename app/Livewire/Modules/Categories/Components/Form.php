<?php

namespace App\Livewire\Modules\Categories\Components;

use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    public $categoryInput = [];
    public $isEdit = false;
    public $categoryId;
    public $categoryName;
    public $alert = null;

    #[On('fillForm')]
    public function fillForm($isEdit, $category)
    {
        $this->isEdit = $isEdit;
        $this->categoryName = $category['name'];
        $this->categoryId = $category['id'];
    }

    public function store()
    {
        try {

            $validator = Validator::make(
                ['categoryName' => $this->categoryName],
                ['categoryName' => [
                    'required',
                    'min:3',
                    Rule::unique('categories', 'name')->whereNull('deleted_at'),
                ]],
                [
                    'categoryName.required' => 'Nama category wajib diisi.',
                    'categoryName.min' => 'Nama category minimal 3 karakter.',
                    'categoryName.unique' => 'category dengan nama ini sudah ada.'
                ]
            );

            if ($validator->fails()) {
                $errors = implode("\n", $validator->errors()->all());

                $this->dispatch(
                    'showAlert',
                    type: 'error',
                    message: $errors
                );
            } else {

                DB::transaction(function () {
                    Categories::create([
                        'name' => $this->categoryName
                    ]);
                });

                $this->dispatch('categoryUpdated');
                $this->resetForm();


                $this->dispatch(
                    'showAlert',
                    type: 'success',
                    message: 'Kategori berhasil ditambahkan'
                );
            }
        } catch (\Throwable $e) {

            logger()->error($e);

            session()->flash('showAlert', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan Kategori'
            ]);
        }
    }

    public function update()
    {

        try {

            $validator = Validator::make(
                ['categoryName' => $this->categoryName],
                ['categoryName' => [
                    'required',
                    'min:3',
                    Rule::unique('categories', 'name')->whereNull('deleted_at'),
                ]],
                [
                    'categoryName.required' => 'Nama Kategori wajib diisi.',
                    'categoryName.min' => 'Nama Kategori minimal 3 karakter.',
                    'categoryName.unique' => 'Kategori dengan nama ini sudah ada.'
                ]
            );

            if ($validator->fails()) {
                $errors = implode("\n", $validator->errors()->all());
                // dd($errors);
                $this->dispatch(
                    'showAlert',
                    type: 'error',
                    message: $errors
                );
                return;
            }

            DB::transaction(function () {
                $category = Categories ::findOrFail($this->categoryId);
                $category->update([
                    'name' => $this->categoryName
                ]);
            });

            $this->dispatch('categoryUpdated');


            $this->dispatch(
                'showAlert',
                type: 'success',
                message: 'Kategori berhasil diubah'
            );
        } catch (\Throwable $e) {

            logger()->error($e);

            session()->flash('showAlert', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan Kategori'
            ]);
        }
    }

    private function resetForm()
    {
        $this->reset(['categoryInput', 'categoryId', 'isEdit']);
        $this->categoryName = '';
    }
    public function render()
    {
        return view('livewire.modules.categories.components.form');
    }
}
