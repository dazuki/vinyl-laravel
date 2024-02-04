<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Record;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Exports\ArtistExport;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class VinylTable extends Component
{
    use WithPagination, LivewireAlert;

    #[Url(history: true)]
    public $search = '';

    public bool $loadData = false;

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
        $cacheName = 'rCache_' . $this->getPage() . '_' . $this->search;

        $cacheKey = Cache::remember($cacheName, 60 * 60, function () {
            return Artist::with('records')->search($this->search)
                ->orderBy('name', 'asc')
                ->paginate(25);
        });

        $recordsCache = Cache::remember('recordsCache', 60 * 60, function () {
            return Record::all()->count();
        });

        $artCountCache = Cache::remember('artCountCache', 60 * 60, function () {
            return Artist::all()->count();
        });

        return view('livewire.vinyl-table', [
            'artists' => $this->loadData ? $cacheKey : [],
            'records' => $this->loadData ? $recordsCache : [],
            'art_count' => $this->loadData ? $artCountCache : [],
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
                ->sortBy('name'),
            'collections_records' => Record::all()->count()
        ]);
    }
}
