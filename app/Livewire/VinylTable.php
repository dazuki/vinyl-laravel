<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Record;
use Livewire\Component;
use Livewire\Attributes\Url;

class VinylTable extends Component
{
    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $removed = 0;

    public bool $loadData = false;

    public function resetRemoved()
    {
        $this->removed = 0;
    }

    public function init()
    {
        $this->loadData = true;
    }

    public function render()
    {
        return view('livewire.vinyl-table', [
            'artists' => Artist::search($this->search)
                ->orderBy('name'),
            'records' => Record::all()->count(),
            'art_count' => Artist::all()->count()
        ]);
    }
}
