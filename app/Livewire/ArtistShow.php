<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Record;
use Livewire\Component;
use Illuminate\Http\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ArtistShow extends Component
{
    use LivewireAlert;

    public $art_id;

    public $name = '';

    public function mount(Request $request)
    {
        $this->name = Artist::find($this->art_id)->name;

        if ($request->msg == 'artist') {
            $this->alert('success', 'Artist tillagd!', [
                'toast' => false,
                'timer' => 3000,
                'position' => 'center',
                'timerProgressBar' => true,
                'showConfirmButton' => true,
                'onConfirmed' => ''
            ]);
        } elseif ($request->msg == 'vinyl') {
            $this->alert('success', 'Vinyl tillagd!', [
                'toast' => false,
                'timer' => 3000,
                'position' => 'center',
                'timerProgressBar' => true,
                'showConfirmButton' => true,
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
    }

    public function delete(Artist $artist)
    {
        $artist->delete();

        $this->redirect('/');
    }

    public function recordDelete(Record $record)
    {
        $record->delete();

        session()->flash('status', 'Vinylen är borttagen!');

        $this->redirect('/artist/' . $this->art_id);
    }

    public function render()
    {
        return view('livewire.artist-show', [
            'artist' => Artist::find($this->art_id)
        ]);
    }
}
