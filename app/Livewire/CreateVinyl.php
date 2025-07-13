<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Record;
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
            'record_name' => 'required|min:1',
        ]);

        Record::create($formFields);

        Cache::flush();

        session()->flash('status', 'Vinylen är tillagd!');

        $this->redirect('/artist/' . $this->artist_id . '?msg=vinyl');
    }

    public function render()
    {
        // Hash::make()
        return view('livewire.create-vinyl', [
            'artists' => Artist::all()->sortBy('name'),
        ]);
    }
}
