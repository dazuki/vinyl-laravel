<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Record;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Hash;

class CreateVinyl extends Component
{
    #[Url(history: true)]
    public $artist_id;

    public $record_name = '';

    public $password;

    public function save()
    {
        $this->record_name = strtoupper($this->record_name);

        if ($this->artist_id == 0) {
            $this->artist_id = null;
        }

        $formFields = $this->validate([
            'artist_id' => 'required',
            'record_name' => 'required|min:1'
        ]);

        $createRecord = Record::create($formFields);

        session()->flash('status', 'Vinylen är tillagd!');

        $this->redirect('/artist/' . $this->artist_id);
    }

    public function render()
    {
        // Hash::make()
        return view('livewire.create-vinyl', [
            'artists' => Artist::all()->sortBy('name')
        ]);
    }
}
