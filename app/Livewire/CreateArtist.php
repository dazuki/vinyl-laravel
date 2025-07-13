<?php

namespace App\Livewire;

use App\Models\Artist;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Url;
use Livewire\Component;

// NTFY Service
use Ntfy\Auth\User;
use Ntfy\Client;
use Ntfy\Server;
use Ntfy\Message;
use Ntfy\Exception\NtfyException;
use Ntfy\Exception\EndpointException;

class CreateArtist extends Component
{
    #[Url(history: true)]
    public $name = '';

    public function save()
    {
        $this->name = mb_strtoupper($this->name);

        $formFields = $this->validate(
            ['name' => 'required|min:1']
        );

        $createRecord = Artist::create($formFields);

        Cache::flush();

        // NTFY
        if (!empty(config('ntfy.server'))) {
            $server = new Server(config('ntfy.server'));

            $message = new Message();
            $message->topic(config('ntfy.topic'));
            $message->title('Ny Artist');
            $message->body('Namn: ' . $this->name);
            $message->priority(Message::PRIORITY_DEFAULT);

            $auth = new User(config('ntfy.username'), config('ntfy.password'));

            $client = new Client($server, $auth);

            // Send message
            $client->send($message);
            //$response = $client->send($message);
        }

        $this->redirect('/artist/' . $createRecord->id . '?msg=artist');
    }

    public function render()
    {
        // Hash::make()
        return view('livewire.create-artist');
    }
}
