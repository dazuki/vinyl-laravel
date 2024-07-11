<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Record;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Gotify\Server;
use Gotify\Auth\Token;
use Gotify\Endpoint\Message;
use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

class ArtistShow extends Component
{
    use LivewireAlert;

    public $art_id;

    public $name = '';

    public function mount(Request $request)
    {
        $artNameCache = Cache::rememberForever('artNameCache_' . $this->art_id, function () {
            return Artist::find($this->art_id)->name;
        });

        $this->name = $artNameCache;

        if ($request->msg == 'artist') {
            $this->alert('success', 'Artist tillagd!', [
                'toast' => true,
                'timer' => 2000,
                'position' => 'center',
                'timerProgressBar' => true,
                // 'showConfirmButton' => true,
                'onConfirmed' => ''
            ]);
        } elseif ($request->msg == 'vinyl') {
            $this->alert('success', 'Vinyl tillagd!', [
                'toast' => true,
                'timer' => 2000,
                'position' => 'center',
                'timerProgressBar' => true,
                // 'showConfirmButton' => true,
                'onConfirmed' => ''
            ]);
        }
    }

    public function save()
    {
        $formFields = $this->validate([
            'name' => 'required|min:1'
        ]);

        Artist::where('id', $this->art_id)->update([
            'name' => mb_strtoupper($this->name)
        ]);

        try {
            $server = new Server($_ENV['GOTIFY_SERVER']);

            // Set application token
            $auth = new Token($_ENV['GOTIFY_TOKEN']);

            // Create a message class instance
            $message = new Message($server, $auth);

            // Send a message
            $message->create(
                title: 'Redigerad Artist',
                message: 'Nytt Namn: ' . mb_strtoupper($this->name),
                priority: Message::PRIORITY_HIGH,
            );
        } catch (EndpointException | GotifyException $err) {
        }

        Cache::flush();
    }

    public function delete(Artist $artist)
    {
        try {
            $server = new Server($_ENV['GOTIFY_SERVER']);

            // Set application token
            $auth = new Token($_ENV['GOTIFY_TOKEN']);

            // Create a message class instance
            $message = new Message($server, $auth);

            // Send a message
            $message->create(
                title: 'Raderad Artist',
                message: 'Namn: ' . mb_strtoupper($artist->name),
                priority: Message::PRIORITY_HIGH,
            );
        } catch (EndpointException | GotifyException $err) {
        }

        $artist->delete();

        Cache::flush();

        $this->redirect('/');
    }

    public function recordDelete(Record $record)
    {
        $artistName = Artist::find($record->artist_id);

        try {
            $server = new Server($_ENV['GOTIFY_SERVER']);

            // Set application token
            $auth = new Token($_ENV['GOTIFY_TOKEN']);

            // Create a message class instance
            $message = new Message($server, $auth);

            // Send a message
            $message->create(
                title: 'Raderad Vinyl (Artist: ' . $artistName->name . ')',
                message: 'Namn: ' . mb_strtoupper($record->record_name),
                priority: Message::PRIORITY_HIGH,
            );
        } catch (EndpointException | GotifyException $err) {
        }

        $record->delete();

        Cache::flush();

        session()->flash('status', 'Vinylen är borttagen!');

        $this->redirect('/artist/' . $this->art_id);
    }

    public function render()
    {
        $artIdCache = Cache::rememberForever('artIdCache_' . $this->art_id, function () {
            return Artist::find($this->art_id);
        });

        return view('livewire.artist-show', [
            'artist' => $artIdCache
        ]);
    }
}
