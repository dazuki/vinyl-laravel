<?php

namespace App\Livewire;

use App\Models\Artist;
use Livewire\Component;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Cache;

use Ntfy\Client;
use Ntfy\Server;
use Ntfy\Message;
use Ntfy\Auth\User;
use Ntfy\Action\View;
use Ntfy\Exception\NtfyException;
use Ntfy\Exception\EndpointException;

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
            // Set server
            $server = new Server($_ENV['NTFY_SERVER']);

            // Action button
            $action = new View();
            $action->label('Länk Till Artist');
            $action->url('https://vinyl.bokbindaregatan.se/artist/' . $createRecord->id);

            // Create a new message
            $message = new Message();
            $message->topic('vinyler');
            $message->title('Ny Artist');
            $message->tags(['green_circle', 'singer']);
            $message->body('Artist: ' . $createRecord->name);

            $message->action($action);
            //$message->priority(Message::PRIORITY_HIGH);

            // Set authentication username and password
            $auth = new User($_ENV['NTFY_LOGIN'], $_ENV['NTFY_PASS']);

            $client = new Client($server, $auth);
            $response = $client->send($message);
        } catch (EndpointException | NtfyException $err) {
        }

        $this->redirect('/artist/' . $createRecord->id . '?msg=artist');
    }

    public function render()
    {
        // Hash::make()
        return view('livewire.create-artist');
    }
}
