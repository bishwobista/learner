<?php

namespace App\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\Card;

class EditCardModal extends ModalComponent
{
    public $card;
    public $question;
    public $answer;

    public function mount($cardId)
    {
        $this->card = Card::findOrFail($cardId);
        $this->question = $this->card->question;
        $this->answer = $this->card->answer;
    }

    public function save()
    {
        $this->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $this->card->update([
            'question' => $this->question,
            'answer' => $this->answer,
        ]);

        $this->closeModal();
        
        return redirect()->route('search');

    }

    public function render()
    {
        return view('livewire.edit-card-modal');
    }
}
