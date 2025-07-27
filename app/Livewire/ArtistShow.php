<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

// NTFY Service
use Ntfy\Auth\User;
use Ntfy\Client;
use Ntfy\Server;
use Ntfy\Message;
use Ntfy\Exception\NtfyException;
use Ntfy\Exception\EndpointException;

class ArtistShow extends Component
{
    use LivewireAlert;

    public Artist $artist;

    public $name = '';

    public function mount(Artist $artist, Request $request)
    {
        $this->artist = $artist;

        /*Cache::rememberForever('id.' . $this->artist, function () {
            return $this->artist;
        });

        $IdCache = Cache::get('id.' . $this->artist);
        $this->artist = json_decode($IdCache, true);*/

        $this->name = $this->artist["name"];

        if ($request->msg == 'artist') {
            $this->alert('success', 'Artist tillagd!', [
                'toast' => true,
                'timer' => 2000,
                'position' => 'center',
                'timerProgressBar' => true,
                // 'showConfirmButton' => true,
                'onConfirmed' => '',
            ]);
        } elseif ($request->msg == 'vinyl') {
            $this->alert('success', 'Vinyl tillagd!', [
                'toast' => true,
                'timer' => 2000,
                'position' => 'center',
                'timerProgressBar' => true,
                // 'showConfirmButton' => true,
                'onConfirmed' => '',
            ]);
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:1',
        ]);

        Artist::where('id', $this->artist)->update([
            'name' => mb_strtoupper($this->name),
        ]);

        Cache::flush();

        Cache::rememberForever('id.' . $this->artist, function () {
            return (string) Artist::with('records')->find($this->artist);
        });

        $IdCache = Cache::get('id.' . $this->artist);
        $this->artist = json_decode($IdCache, true);

        $this->name = $this->artist['name'];
    }

    public function delete(Artist $artist)
    {
        //// NTFY
        if (!empty(config('ntfy.server'))) {
            try {
                $artist_name = $artist->name;
                $server = new Server(config('ntfy.server'));

                $message = new Message();
                $message->topic(config('ntfy.topic'));
                $message->icon('https://vinyl.bokbindaregatan.se/static/images/android-chrome-512x512.png');
                $message->tags(['red_circle']);
                $message->title('ARTIST');
                $message->body('Borttagen: ' . $artist_name);
                $message->priority(Message::PRIORITY_DEFAULT);

                $auth = new User(config('ntfy.username'), config('ntfy.password'));

                $client = new Client($server, $auth);

                $client->send($message);
            } catch (EndpointException | NtfyException $err) {
                echo $err->getMessage();
            }
        }
        ////

        $artist->delete();

        Cache::flush();

        $this->redirect('/');
    }

    public function recordDelete(Record $record)
    {
        //// NTFY
        if (!empty(config('ntfy.server'))) {
            try {
                $artist_name = $record->artist->name;
                $server = new Server(config('ntfy.server'));

                $message = new Message();
                $message->topic(config('ntfy.topic'));
                $message->icon('https://vinyl.bokbindaregatan.se/static/images/android-chrome-512x512.png');
                $message->tags(['red_circle']);
                $message->title('VINYL');
                $message->body('Borttagen: ' . $record->record_name . '
Artist: ' . $artist_name);
                $message->priority(Message::PRIORITY_DEFAULT);

                $auth = new User(config('ntfy.username'), config('ntfy.password'));

                $client = new Client($server, $auth);

                $client->send($message);
            } catch (EndpointException | NtfyException $err) {
                echo $err->getMessage();
            }
        }
        ////

        $record->delete();

        Cache::flush();

        session()->flash('status', 'Vinylen är borttagen!');

        $this->redirect('/artist/' . $this->artist);
    }

    public function render()
    {
        // Check if we need to fetch Discogs data
        if (!$this->artist->getEffectiveDiscogsId() && !$this->artist->discogs_fetch_attempted) {
            try {
                $this->artist->getDiscogsData();
                // Mark that we've attempted to fetch (to avoid repeated API calls)
                $this->artist->update(['discogs_fetch_attempted' => true]);
            } catch (\Exception $e) {
                \Log::error("Failed to fetch Discogs data for artist {$this->artist->id}: " . $e->getMessage());
            }
        }

        return view('livewire.artist-show', [
            'artist' => $this->artist,
        ]);
    }
}
