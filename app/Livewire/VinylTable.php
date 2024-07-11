<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Record;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Exports\ArtistExport;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Gotify\Server;
use Gotify\Auth\Token;
use Gotify\Endpoint\Message;
use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

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
        $cacheName = 'tablePageCache_p' . $this->getPage() . '-s_' . $this->search;

        $cacheKey = Cache::rememberForever($cacheName, function () {
            return Artist::with('records')->search($this->search)
                ->orderBy('name', 'asc')
                ->paginate(25);
        });

        $recordsCountCache = Cache::rememberForever('recordsCountCache', function () {
            return Record::all()->count();
        });

        $artistsCountCache = Cache::rememberForever('artistsCountCache', function () {
            return Artist::all()->count();
        });

        return view('livewire.vinyl-table', [
            'artists' => $this->loadData ? $cacheKey : [],
            'records' => $this->loadData ? $recordsCountCache : [],
            'art_count' => $this->loadData ? $artistsCountCache : [],
            'searchCountArtist' => $this->loadData ? Artist::searchCount($this->search)->count() : [],
            'searchCountRecord' => $this->loadData ? Record::search($this->search)->count() : []
        ]);
    }

    public function export()
    {
        $recordsCountCache = Cache::rememberForever('recordsCountCache', function () {
            return Record::all()->count();
        });

        $artistsCountCache = Cache::rememberForever('artistsCountCache', function () {
            return Artist::all()->count();
        });

        try {
            $server = new Server($_ENV['GOTIFY_SERVER']);

            // Set application token
            $auth = new Token($_ENV['GOTIFY_TOKEN']);

            // Create a message class instance
            $message = new Message($server, $auth);

            // Send a message
            $message->create(
                title: 'Excel Nerladdning',
                message: 'Vinyler Förteckning(Artister ' . $recordsCountCache . ' - Vinyler ' . $artistsCountCache . ').xls',
                priority: Message::PRIORITY_HIGH,
            );
        } catch (EndpointException | GotifyException $err) {
        }

        return Excel::download(new ArtistExport, 'Vinyler Förteckning(Artister ' . $recordsCountCache . ' - Vinyler ' . $artistsCountCache . ').xls', \Maatwebsite\Excel\Excel::XLS);
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
