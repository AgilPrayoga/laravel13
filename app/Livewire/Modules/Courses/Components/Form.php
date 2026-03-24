<?php

namespace App\Livewire\Modules\Courses\Components;

use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    public $courseInput = [];
    public $isEdit = false;
    public $courseId;
    public $name;
    public $description;
    public $start;
    public $end;
    public $color;

    public $alert = null;

    #[On('fillForm')]
    public function fillForm($isEdit, $course)
    {
        $this->isEdit = $isEdit;
        $this->name = $course['name'];
        $this->description = $course['description'];
        $this->start = $course['start'];
        $this->end = $course['end'];
        $this->color = $course['color'];


        $this->courseId = $course['id'];
    }

    public function store()
    {
        try {

            $validator = Validator::make(
                [
                    'name' => $this->name,
                    'description' => $this->description,
                    'start' => $this->start,
                    'end' => $this->end,
                    'color' => $this->color,

                ],
                [
                    'name' => [
                        'required',
                        'min:3',
                        Rule::unique('courses', 'name')->whereNull('deleted_at'),
                    ],
                    'description' => 'required',
                    'start' => 'required',
                    'end' => 'required',
                    'color' => 'required',
                ],
                [
                    'name.required' => 'Nama Kursus wajib diisi.',
                    'name.min' => 'Nama Kursus minimal 3 karakter.',
                    'name.unique' => 'Kursus dengan nama ini sudah ada.',
                    'description.required' => 'Description Kursus wajib diisi.',
                    'start.required' => 'Waktu Mulai Kursus wajib diisi.',
                    'end.required' => 'Waktu Akhir Kursus wajib diisi.',
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
                    Course::create([
                        'name' => $this->name,
                        'description' => $this->description,
                        'start' => $this->start,
                        'end' => $this->end,
                        'color' => $this->color,
                        'status' => 1
                    ]);
                });

                $this->dispatch('courseUpdated');
                $this->resetForm();


                $this->dispatch(
                    'showAlert',
                    type: 'success',
                    message: 'Kursus berhasil ditambahkan'
                );
            }
        } catch (\Throwable $e) {

            logger()->error($e);

            session()->flash('showAlert', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan Kursus'
            ]);
        }
    }

    public function update()
    {

        try {

            $validator = Validator::make(
                [
                    'name' => $this->name,
                    'description' => $this->description,
                    'start' => $this->start,
                    'end' => $this->end,
                    'color' => $this->color,

                ],
                [
                    'name' => [
                        'required',
                        'min:3'
                    ],
                    'description' => 'required',
                    'start' => 'required',
                    'end' => 'required',
                    'color' => 'required',
                ],
                [
                    'name.required' => 'Nama Kursus wajib diisi.',
                    'name.min' => 'Nama Kursus minimal 3 karakter.',
                    'name.unique' => 'Kursus dengan nama ini sudah ada.',
                    'description.required' => 'Description Kursus wajib diisi.',
                    'start.required' => 'Waktu Mulai Kursus wajib diisi.',
                    'end.required' => 'Waktu Akhir Kursus wajib diisi.',
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
                $course = Course::findOrFail($this->courseId);
                $course->update([
                    'name' => $this->name,
                    'description' => $this->description,
                    'start' => $this->start,
                    'end' => $this->end,
                    'color' => $this->color,
                    'status' => 1
                ]);
            });

            $this->dispatch('courseUpdated');


            $this->dispatch(
                'showAlert',
                type: 'success',
                message: 'Kursus berhasil diubah'
            );
        } catch (\Throwable $e) {

            logger()->error($e);

            session()->flash('showAlert', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan Kursus'
            ]);
        }
    }

    private function resetForm()
    {
        $this->reset(['courseInput', 'courseId', 'isEdit']);
        $this->name = '';
    }
    public function render()
    {
        return view('livewire.modules.courses.components.form');
    }
}
