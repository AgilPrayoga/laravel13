<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class Alert extends Component
{
    public $show = false;
    public $type;
    public $message;

    public function mount()
    {
        if (session()->has('notifyAlert')) {
            $data = session('notifyAlert');

            $this->show = true;
            $this->type = $data['type'];
            $this->message = $data['message'];
        }
    }
    #[On('showAlert')]
    public function showAlert($type, $message)
    {
        $this->show = true;
        $this->type = $type;
        $this->message = $message;
    }

    public function closeAlert()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.components.alert');
    }
}
