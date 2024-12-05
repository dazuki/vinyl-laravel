<?php

namespace App\Livewire;

use App\Models\Artist;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ArtistShow extends Component
{
    use LivewireAlert;

    public $art_id;

    public $name = '';

    public function mount(Request $request)
    {
        $artNameCache = Cache::rememberForever('show_name_'.$this->art_id, function () {
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
                'onConfirmed' => '',
            ]);
        } elseif ($request->msg == 'vinyl') {
            $this->alert('success', 'Vinyl tillagd!', [
                'toast' => true,
                'timer' => 2000,
                'position' => 'center',
                'timerProgressBar' => true,
                // 'showConfirmButton' => true,
                'onConfirmed' => '',
            ]);
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:1',
        ]);

        Artist::where('id', $this->art_id)->update([
            'name' => mb_strtoupper($this->name),
        ]);

        Cache::flush();
    }

    public function delete(Artist $artist)
    {
        $artist->delete();

        Cache::flush();

        $this->redirect('/');
    }

    public function recordDelete(Record $record)
    {
        $record->delete();

        Cache::flush();

        session()->flash('status', 'Vinylen är borttagen!');

        $this->redirect('/artist/'.$this->art_id);
    }

    public function render()
    {
        $artIdCache = Cache::rememberForever('show_id_'.$this->art_id, function () {
            return Artist::find($this->art_id);
        });

        return view('livewire.artist-show', [
            'artist' => $artIdCache,
        ]);
    }
}
