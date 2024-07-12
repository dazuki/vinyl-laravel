<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Record;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Ntfy\Client;
use Ntfy\Server;
use Ntfy\Message;
use Ntfy\Action\View;
use Ntfy\Exception\NtfyException;
use Ntfy\Exception\EndpointException;

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
            // Set server
            $server = new Server($_ENV['NTFY_SERVER']);

            // Action button
            $action = new View();
            $action->label('Länk Till Artist');
            $action->url('https://vinyl.bokbindaregatan.se/artist/' . $this->art_id);

            // Create a new message
            $message = new Message();
            $message->topic('vinyler');
            $message->title('Redigerad Artist');
            $message->tags(['yellow_circle', 'singer']);
            $message->body('Nytt Namn: ' . mb_strtoupper($this->name));

            $message->action($action);
            //$message->priority(Message::PRIORITY_HIGH);

            $client = new Client($server);
            $response = $client->send($message);
        } catch (EndpointException | NtfyException $err) {
        }

        Cache::flush();
    }

    public function delete(Artist $artist)
    {
        try {
            // Set server
            $server = new Server($_ENV['NTFY_SERVER']);

            // Action button
            //$action = new View();
            //$action->label('Länk Till Artist');
            //$action->url('https://vinyl.bokbindaregatan.se/artist/' . $this->art_id);

            // Create a new message
            $message = new Message();
            $message->topic('vinyler');
            $message->title('Raderad Artist');
            $message->tags(['red_circle', 'singer']);
            $message->body('Artist: ' . mb_strtoupper($artist->name));

            //$message->action($action);
            //$message->priority(Message::PRIORITY_HIGH);

            $client = new Client($server);
            $response = $client->send($message);
        } catch (EndpointException | NtfyException $err) {
        }

        $artist->delete();

        Cache::flush();

        $this->redirect('/');
    }

    public function recordDelete(Record $record)
    {
        $artistName = Artist::find($record->artist_id);

        try {
            // Set server
            $server = new Server($_ENV['NTFY_SERVER']);

            // Action button
            //$action = new View();
            //$action->label('Länk Till Artist');
            //$action->url('https://vinyl.bokbindaregatan.se/artist/' . $this->art_id);

            // Create a new message
            $message = new Message();
            $message->topic('vinyler');
            $message->title('Raderad Vinyl');
            $message->tags(['red_circle', 'cd']);
            $message->body('Vinyl: ' . mb_strtoupper($record->record_name) . '
Artist: ' . $artistName->name);

            //$message->action($action);
            //$message->priority(Message::PRIORITY_HIGH);

            $client = new Client($server);
            $response = $client->send($message);
        } catch (EndpointException | NtfyException $err) {
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
