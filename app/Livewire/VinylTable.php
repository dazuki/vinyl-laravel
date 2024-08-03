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

use Ntfy\Client;
use Ntfy\Server;
use Ntfy\Message;
use Ntfy\Auth\User;
use Ntfy\Exception\NtfyException;
use Ntfy\Exception\EndpointException;

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
            // Set server
            $server = new Server($_ENV['NTFY_SERVER']);

            // Action button
            //$action = new View();
            //$action->label('Länk Till Artist');
            //$action->url('https://vinyl.bokbindaregatan.se/artist/' . $createRecord->id);

            // Create a new message
            $message = new Message();
            $message->topic('vinyler');
            $message->title('Nerladdning .xls');
            $message->tags(['arrow_down', 'page_with_curl']);
            $message->body('Vinyler Förteckning(Artister ' . $recordsCountCache . ' - Vinyler ' . $artistsCountCache . ').xls');

            //$message->action($action);
            //$message->priority(Message::PRIORITY_HIGH);
            // Set authentication username and password
            $auth = new User($_ENV['NTFY_LOGIN'], $_ENV['NTFY_PASS']);

            $client = new Client($server, $auth);
            $response = $client->send($message);
        } catch (EndpointException | NtfyException $err) {
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
