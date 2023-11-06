<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Record;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class VinylTable extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $removed = 0;

    public bool $loadData = false;

    public function resetRemoved()
    {
        $this->removed = 0;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function init()
    {
        $this->loadData = true;
    }

    public function render()
    {
        return view('livewire.vinyl-table', [
            'artists' => Artist::search($this->search)
                ->orderBy('name', 'asc')
                ->paginate(25),
            'records' => Record::all()->count(),
            'art_count' => Artist::all()->count()
        ]);
    }
}
