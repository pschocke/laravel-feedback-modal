<?php

namespace pschocke\FeedbackModal;

use Livewire\Component;

class FeedbackModalComponent extends Component
{
    public $type = "";

    public $email = "";

    public $feedback = "";

    public $data_protection = false;

    public $currentPage;

    public function mount()
    {
        $this->currentPage = url()->current();
    }

    public function send()
    {
        $this->validate([
            'type' => 'required',
            'email' => ['nullable', 'email'],
            'feedback' => 'required',
            'data_protection' => 'accepted',
        ]);

        AnonymousFeedback::create([
            'type' => $this->type,
            'email' => $this->email,
            'feedback' => $this->feedback,
            'url' => $this->currentPage,
        ]);

        $this->emitSelf('change-send');
    }

    public function render()
    {
        return view('feedback-modal::feedback-modal');
    }
}
