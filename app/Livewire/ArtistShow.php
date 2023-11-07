<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Record;
use Livewire\Component;

class ArtistShow extends Component
{
    public $art_id;

    public $name = '';

    public function mount()
    {
        $this->name = Artist::find($this->art_id)->name;
    }

    public function save()
    {
        $formFields = $this->validate([
            'name' => 'required|min:1'
        ]);

        Artist::where('id', $this->art_id)->update([
            'name' => mb_strtoupper($this->name)
        ]);
    }

    public function delete(Artist $artist)
    {
        $artist->delete();

        $this->redirect('/?removed=1');
    }

    public function recordDelete(Record $record)
    {
        $record->delete();

        session()->flash('status', 'Vinylen är borttagen!');

        $this->redirect('/artist/' . $this->art_id);
    }

    public function render()
    {
        return view('livewire.artist-show', [
            'artist' => Artist::find($this->art_id)
        ]);
    }
}
