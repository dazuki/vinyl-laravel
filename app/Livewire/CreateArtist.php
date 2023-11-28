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
        $this->name = mb_strtoupper($this->name);

        $formFields = $this->validate([
            'name' => 'required|min:1'
        ]);

        $createRecord = Artist::create($formFields);

        $this->redirect('/artist/' . $createRecord->id . '?msg=artist');
    }

    public function render()
    {
        // Hash::make()
        return view('livewire.create-artist');
    }
}
