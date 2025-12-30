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
use Ntfy\Exception\EndpointException;
use Ntfy\Exception\NtfyException;
use Ntfy\Message;
use Ntfy\Server;

class ArtistShow extends Component
{
    use LivewireAlert;

    public $artistId;

    public $name = '';

    public $editingRecordId = null;

    public $editingRecordName = '';

    public function mount(Artist $artist, Request $request): void
    {
        $this->artistId = $artist->id;
        $this->name = $artist->name;

        if ($request->msg == 'artist') {
            $this->alert('success', 'Artist tillagd!', [
                'toast' => true,
                'timer' => 2000,
                'position' => 'center',
                'timerProgressBar' => true,
                'onConfirmed' => '',
            ]);
        } elseif ($request->msg == 'vinyl') {
            $this->alert('success', 'Vinyl tillagd!', [
                'toast' => true,
                'timer' => 2000,
                'position' => 'center',
                'timerProgressBar' => true,
                'onConfirmed' => '',
            ]);
        }
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|min:1',
        ]);

        Artist::where('id', $this->artistId)->update([
            'name' => mb_strtoupper($this->name),
        ]);

        Cache::flush();
        $this->name = mb_strtoupper($this->name);
    }

    public function delete(): void
    {
        $artist = Artist::find($this->artistId);

        if ($artist) {
            // NTFY notification
            if (! empty(config('ntfy.server'))) {
                try {
                    $artist_name = $artist->name;
                    $server = new Server(config('ntfy.server'));

                    $message = new Message;
                    $message->topic(config('ntfy.topic'));
                    $message->icon('https://vinyl.bokbindaregatan.se/static/images/android-chrome-512x512.png');
                    $message->tags(['red_circle']);
                    $message->title('ARTIST');
                    $message->body('Borttagen: '.$artist_name);
                    $message->priority(Message::PRIORITY_DEFAULT);

                    $auth = new User(config('ntfy.username'), config('ntfy.password'));
                    $client = new Client($server, $auth);
                    $client->send($message);
                } catch (EndpointException|NtfyException $err) {
                    \Log::error('NTFY error: '.$err->getMessage());
                }
            }

            $artist->delete();
            Cache::flush();
            $this->redirect('/');
        }
    }

    public function recordDelete($recordId): void
    {
        $record = Record::with('artist')->find($recordId);

        if ($record) {
            // NTFY notification
            if (! empty(config('ntfy.server'))) {
                try {
                    $artist_name = $record->artist->name;
                    $server = new Server(config('ntfy.server'));

                    $message = new Message;
                    $message->topic(config('ntfy.topic'));
                    $message->icon('https://vinyl.bokbindaregatan.se/static/images/android-chrome-512x512.png');
                    $message->tags(['red_circle']);
                    $message->title('VINYL');
                    $message->body('Borttagen: '.$record->record_name."\nArtist: ".$artist_name);
                    $message->priority(Message::PRIORITY_DEFAULT);

                    $auth = new User(config('ntfy.username'), config('ntfy.password'));
                    $client = new Client($server, $auth);
                    $client->send($message);
                } catch (EndpointException|NtfyException $err) {
                    \Log::error('NTFY error: '.$err->getMessage());
                }
            }

            $record->delete();
            Cache::flush();
            session()->flash('status', 'Vinylen är borttagen!');
            $this->redirect('/artist/'.$this->artistId);
        }
    }

    public function startEditingRecord($recordId): void
    {
        $record = Record::find($recordId);

        if ($record && $record->artist_id === $this->artistId) {
            $this->editingRecordId = $recordId;
            $this->editingRecordName = $record->record_name;
        }
    }

    public function cancelEditingRecord(): void
    {
        $this->editingRecordId = null;
        $this->editingRecordName = '';
    }

    public function updateRecordName(): void
    {
        $this->validate([
            'editingRecordName' => 'required|min:1',
        ]);

        $record = Record::find($this->editingRecordId);

        if ($record && $record->artist_id === $this->artistId) {
            $record->update([
                'record_name' => mb_strtoupper($this->editingRecordName),
            ]);

            Cache::flush();
            $this->editingRecordId = null;
            $this->editingRecordName = '';
            session()->flash('status', 'Vinylen är uppdaterad!');
        }
    }

    public function __serialize(): array
    {
        return [
            'artistId' => $this->artistId,
            'name' => $this->name,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->artistId = $data['artistId'];
        $this->name = $data['name'];
    }

    public function render()
    {
        $artist = Artist::with('records')->find($this->artistId);

        if (! $artist) {
            $this->redirect('/');

            return;
        }

        if (! $artist->getEffectiveDiscogsId() && ! $artist->discogs_fetch_attempted) {
            try {
                $artist->getDiscogsData();
                $artist->update(['discogs_fetch_attempted' => true]);
            } catch (\Exception $e) {
                \Log::error("Failed to fetch Discogs data for artist {$artist->id}: ".$e->getMessage());
            }
        }

        return view('livewire.artist-show', compact('artist'));
    }
}
