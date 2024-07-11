<?php

namespace App\Livewire;

use App\Models\Artist;
use Livewire\Component;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Cache;
use Gotify\Server;
use Gotify\Auth\Token;
use Gotify\Endpoint\Message;
use Gotify\Exception\GotifyException;
use Gotify\Exception\EndpointException;

class CreateArtist extends Component
{
    #[Url(history: true)]
    public $name = '';

    public function save()
    {
        $this->name = mb_strtoupper($this->name);

        $formFields = $this->validate([
            'name' => 'required|min:1'
        ]);

        $createRecord = Artist::create($formFields);

        Cache::flush();

        try {
            $server = new Server($_ENV['GOTIFY_SERVER']);

            // Set application token
            $auth = new Token($_ENV['GOTIFY_TOKEN']);

            // Create a message class instance
            $message = new Message($server, $auth);

            // Send a message
            $message->create(
                title: 'Ny Artist',
                message: 'Namn: ' . $createRecord->name,
                priority: Message::PRIORITY_HIGH,
            );
        } catch (EndpointException | GotifyException $err) {
        }

        $this->redirect('/artist/' . $createRecord->id . '?msg=artist');
    }

    public function render()
    {
        // Hash::make()
        return view('livewire.create-artist');
    }
}
