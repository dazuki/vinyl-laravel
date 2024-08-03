<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Record;
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
            // Set server
            $server = new Server($_ENV['NTFY_SERVER']);

            // Action button
            $action = new View();
            $action->label('Länk Till Artist');
            $action->url('https://vinyl.bokbindaregatan.se/artist/' . $artistName->id);

            // Create a new message
            $message = new Message();
            $message->topic('vinyler');
            $message->title('Ny Vinyl');
            $message->tags(['green_circle', 'cd']);
            $message->body('Vinyl: ' . mb_strtoupper($createRecord->record_name) . '
Artist: ' . $artistName->name);

            $message->action($action);
            //$message->priority(Message::PRIORITY_HIGH);
            // Set authentication username and password
            $auth = new User($_ENV['NTFY_LOGIN'], $_ENV['NTFY_PASS']);

            $client = new Client($server, $auth);
            $response = $client->send($message);
        } catch (EndpointException | NtfyException $err) {
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
