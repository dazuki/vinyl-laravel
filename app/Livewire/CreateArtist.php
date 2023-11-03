<?php

namespace App\Livewire;

use App\Models\Artist;
use Livewire\Component;
use Livewire\Attributes\Url;

class CreateArtist extends Component
{
    #[Url(history: true)]
    public $name = '';

    public function save()
    {
        $this->name = strtoupper($this->name);

        $formFields = $this->validate([
            'name' => 'required|min:1'
        ]);

        $createRecord = Artist::create($formFields);

        session()->flash('status', 'Artisten är skapad!');

        $this->redirect('/artist/' . $createRecord->id);
    }

    public function render()
    {
        // Hash::make()
        return view('livewire.create-artist');
    }
}
