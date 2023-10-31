<?php

namespace App\Livewire;

use App\Models\Artist;
use Livewire\Component;

class ArtistShow extends Component
{
    public $art_id;

    public function render()
    {
        return view('livewire.artist-show', [
            'artist' => Artist::find($this->art_id)
        ]);
    }
}
