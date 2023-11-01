<?php

namespace App\Livewire;

use App\Models\Artist;
use Livewire\Component;

class ArtistEdit extends Component
{
    public $art_id;

    public function render()
    {
        return view('livewire.artist-edit', [
            'artist' => Artist::find($this->art_id)
        ]);
    }
}
