<?php

namespace App\Livewire;

use App\Models\Artist;
use Livewire\Component;

class CreateArtist extends Component
{
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
        return view('livewire.create-artist');
    }
}
