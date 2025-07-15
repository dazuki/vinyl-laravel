<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

// NTFY Service
use Ntfy\Client;
use Ntfy\Server;
use Ntfy\Message;
use Ntfy\Auth\User;
use Ntfy\Exception\NtfyException;
use Ntfy\Exception\EndpointException;

class Login extends Component
{
    public function render()
    {
        //// NTFY
        if (!empty(config('ntfy.server'))) {
            $inloggad = Auth::user()->name;

            try {
                $server = new Server(config('ntfy.server'));

                $message = new Message();
                $message->topic(config('ntfy.topic'));
                $message->icon('https://vinyl.bokbindaregatan.se/static/images/android-chrome-512x512.png');
                $message->tags(['key']);
                $message->title('INLOGGNING');
                $message->body('Användare: ' . mb_strtoupper($inloggad));
                $message->priority(Message::PRIORITY_DEFAULT);

                $auth = new User(config('ntfy.username'), config('ntfy.password'));

                $client = new Client($server, $auth);

                $client->send($message);
            } catch (EndpointException | NtfyException $err) {
                echo $err->getMessage();
            }
        }
        ////

        return view('livewire.login');
    }
}
