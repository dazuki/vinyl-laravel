<?php

namespace App\Livewire;

use App\Exports\ArtistExport;
use App\Models\Artist;
use App\Models\Record;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

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
            'artists' => $this->loadData ? Artist::search($this->search)
                ->orderBy('name', 'asc')
                ->paginate(25) : [],
            'records' => $this->loadData ? Record::all()->count() : [],
            'art_count' => $this->loadData ? Artist::all()->count() : [],
            'searchCountArtist' => $this->loadData ? Artist::searchCount($this->search)->count() : [],
            'searchCountRecord' => $this->loadData ? Record::search($this->search)->count() : []
        ]);
    }

    public function export()
    {
        return Excel::download(new ArtistExport, 'Vinyler Förteckning(' . date('Y-m-d') . ' vid ' . date('H.i') . ').xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function view()
    {
        return view('exports.collection', [
            'collections' => Artist::all()
                ->sortBy('name')
        ]);
    }
}
