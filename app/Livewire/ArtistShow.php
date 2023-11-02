<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Record;
use Livewire\Component;

class ArtistShow extends Component
{
    public $art_id;

    public $name = '';

    public function save()
    {
        Artist::where('id', $this->art_id)->update([
            'name' => strtoupper($this->name)
        ]);
    }

    public function delete(Artist $artist)
    {
        $artist->delete();

        session()->flash('status', 'Artist är borttagen!');

        $this->redirect('/');
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
