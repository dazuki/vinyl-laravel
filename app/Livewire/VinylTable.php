<?php

namespace App\Livewire;

use App\Exports\ArtistExport;
use App\Models\Artist;
use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

// NTFY Service
use Ntfy\Auth\User;
use Ntfy\Client;
use Ntfy\Server;
use Ntfy\Message;
use Ntfy\Exception\NtfyException;
use Ntfy\Exception\EndpointException;

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
        $cacheName = 'page-' . $this->getPage() . ($this->search ? '.q-' . $this->search : '');

        Cache::rememberForever($cacheName, function () {
            return Artist::with('records')->search($this->search)
                ->orderBy('name')
                ->paginate(25);
        });

        Cache::rememberForever('count_records', function () {
            return Record::all()->count();
        });

        Cache::rememberForever('count_artists', function () {
            return Artist::all()->count();
        });

        Cache::rememberForever('count_records' . ($this->search ? '.q-' . $this->search : ''), function () {
            return Record::search($this->search)->count();
        });

        Cache::rememberForever('count_artists' . ($this->search ? '.q-' . $this->search : ''), function () {
            return Artist::searchCount($this->search)->count();
        });

        $pageCache = Cache::get($cacheName);
        $recordsCount = Cache::get('count_records');
        $artistsCount = Cache::get('count_artists');
        $searchRecordsCount = Cache::get('count_records' . ($this->search ? '.q-' . $this->search : ''));
        $searchArtistsCount = Cache::get('count_artists' . ($this->search ? '.q-' . $this->search : ''));

        return view('livewire.vinyl-table', [
            'artists' => $this->loadData ? $pageCache : [],
            'records' => $this->loadData ? $recordsCount : [],
            'art_count' => $this->loadData ? $artistsCount : [],
            'searchCountArtist' => $this->loadData ? $searchArtistsCount : [],
            'searchCountRecord' => $this->loadData ? $searchRecordsCount : [],
        ]);
    }

    public function export()
    {
        $dlDate = Carbon::now()->format('Y-m-d');

        return Excel::download(new ArtistExport, 'Vinylförteckning-' . $dlDate . '.xls', \Maatwebsite\Excel\Excel::XLS);
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
