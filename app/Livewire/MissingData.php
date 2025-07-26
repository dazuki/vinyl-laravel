<?php

namespace App\Livewire;

use App\Models\Artist;
use Livewire\Component;

class MissingData extends Component
{
    public function render()
    {
        return view('livewire.missing-data', [
            'noids' => Artist::whereNull('discogs_id')
                ->get(),
            'noimages' => Artist::whereNull('discogs_image_url')
                ->get(),

        ]);
    }
}
