<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Record;
use App\Exports\ArtistExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

// NTFY Service
use Ntfy\Client;
use Ntfy\Server;
use Ntfy\Message;
use Ntfy\Auth\User;
use Ntfy\Exception\NtfyException;
use Ntfy\Exception\EndpointException;

class VinylTable extends Component
{
    use LivewireAlert, WithPagination;

    #[Url(history: true)]
    public $search = '';

    public bool $loadData = true;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    /*public function init()
    {
        $this->loadData = true;
    }*/

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

    public function export(Request $request)
    {
        $dlDate = Carbon::now()->format('Y-m-d');
        $ntfyDate = Carbon::now()->format('Y-m-d H:i');
        $ip = $request->header('X-Forwarded-For') ?: $request->ip();

        //dd($request);

        //// NTFY
        if (!empty(config('ntfy.server'))) {
            try {
                $server = new Server(config('ntfy.server'));

                $message = new Message();
                $message->topic(config('ntfy.topic'));
                $message->icon('https://vinyl.bokbindaregatan.se/static/images/android-chrome-512x512.png');
                $message->tags(['information_source']);
                $message->title('NERLADDNING (XLS)');
                $message->body('Datum: ' . $ntfyDate . '
IP: ' . $ip);
                $message->priority(Message::PRIORITY_DEFAULT);

                $auth = new User(config('ntfy.username'), config('ntfy.password'));

                $client = new Client($server, $auth);

                $client->send($message);
            } catch (EndpointException | NtfyException $err) {
                echo $err->getMessage();
            }
        }
        ////

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
