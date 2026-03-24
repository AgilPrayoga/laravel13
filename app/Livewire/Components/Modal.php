<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class Modal extends Component
{
    public $open = false;
    public $title;
    public $message;
    public $eventListener;
    public $id;
    public $type;

    public function modalClose()
    {
        $this->open = false;
    }

    #[On('open-modal')]
    public function modalOpen($type = null, $title = null, $message = null, $event = null, $id = null)
    {
        $this->open = true;
        $this->type = $type;
        $this->title = $title;
        $this->message = $message;
        $this->eventListener = $event;
        $this->id = $id;
    }
    public function redirectEvent()
    {
        $this->dispatch($this->eventListener, id: $this->id);
    }

    public function render()
    {
        return view('livewire.components.modal');
    }
}
