<?php

namespace App\Livewire;

use App\Models\Artist;
use Livewire\Component;

class MissingData extends Component
{
    public function render()
    {
        return view('livewire.missing-data', [
            'artists' => Artist::whereNotNull('discogs_id')
                ->orWhereNotNull('discogs_id_manual')
        ]);
    }
}
