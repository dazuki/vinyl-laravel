<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Record;
use Livewire\Component;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Cache;
use Gotify\Server;
use Gotify\Auth\Token;
use Gotify\Endpoint\Message;
use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

class CreateVinyl extends Component
{
    #[Url(history: true)]
    public $artist_id;

    public $record_name = '';

    public $password;

    public function save()
    {
        $this->record_name = mb_strtolower($this->record_name);

        if ($this->artist_id == 0) {
            $this->artist_id = null;
        }

        $formFields = $this->validate([
            'artist_id' => 'required',
            'record_name' => 'required|min:1'
        ]);

        $createRecord = Record::create($formFields);
        $artistName = Artist::find($createRecord->artist_id);

        Cache::flush();

        try {
            $server = new Server($_ENV['GOTIFY_SERVER']);

            // Set application token
            $auth = new Token($_ENV['GOTIFY_TOKEN']);

            // Create a message class instance
            $message = new Message($server, $auth);

            $extras = [
                'client::notification' => [
                    'click' => ['url' => 'https://vinyl.bokbindaregatan.se/artist/' . $artistName->id]
                ]
            ];

            // Send a message
            $message->create(
                title: 'Ny Vinyl (Artist: ' . $artistName->name . ')',
                message: 'Namn: ' . mb_strtoupper($createRecord->record_name),
                priority: Message::PRIORITY_HIGH,
                extras: $extras,
            );
        } catch (EndpointException | GotifyException $err) {
        }

        session()->flash('status', 'Vinylen är tillagd!');

        $this->redirect('/artist/' . $this->artist_id . '?msg=vinyl');
    }

    public function render()
    {
        // Hash::make()
        return view('livewire.create-vinyl', [
            'artists' => Artist::all()->sortBy('name')
        ]);
    }
}
