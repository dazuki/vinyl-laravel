<?php

namespace App\Livewire;

use App\Exports\ArtistExport;
use App\Models\Artist;
use App\Models\Record;
use Illuminate\Support\Facades\Cache;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class VinylTable extends Component
{
    use LivewireAlert, WithPagination;

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
        $cacheName = 'VinylTable_page_'.$this->getPage().'_search_'.$this->search;

        $cacheKey = Cache::rememberForever($cacheName, function () {
            return Artist::with('records')->search($this->search)
                ->orderBy('name', 'asc')
                ->paginate(25);
        });

        $recordsCountCache = Cache::rememberForever('VinylTable_records_count', function () {
            return Record::all()->count();
        });

        $artistsCountCache = Cache::rememberForever('VinylTable_artists_count', function () {
            return Artist::all()->count();
        });

        return view('livewire.vinyl-table', [
            'artists' => $this->loadData ? $cacheKey : [],
            'records' => $this->loadData ? $recordsCountCache : [],
            'art_count' => $this->loadData ? $artistsCountCache : [],
            'searchCountArtist' => $this->loadData ? Artist::searchCount($this->search)->count() : [],
            'searchCountRecord' => $this->loadData ? Record::search($this->search)->count() : [],
        ]);
    }

    public function export()
    {
        $recordsCountCache = Cache::rememberForever('VinylTable_records_count', function () {
            return Record::all()->count();
        });

        $artistsCountCache = Cache::rememberForever('VinylTable_artists_count', function () {
            return Artist::all()->count();
        });

        return Excel::download(new ArtistExport, 'Vinyler Förteckning(Artister '.$recordsCountCache.' - Vinyler '.$artistsCountCache.').xls', \Maatwebsite\Excel\Excel::XLS);
    }

    public function view()
    {
        return view('exports.collection', [
            'collections' => Artist::all()
                ->sortBy('name'),
            'collections_records' => Record::all()->count(),
        ]);
    }
}
