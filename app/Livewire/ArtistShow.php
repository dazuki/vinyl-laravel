<?php

namespace App\Livewire;

use App\Models\Artist;
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

    public function render()
    {
        return view('livewire.artist-show', [
            'artist' => Artist::find($this->art_id)
        ]);
    }
}
