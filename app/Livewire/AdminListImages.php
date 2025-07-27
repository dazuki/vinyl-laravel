<?php

namespace App\Livewire;

use App\Models\Artist;
use Livewire\Component;
use Livewire\Attributes\Url;

class AdminListImages extends Component
{
    public $artist;

    #[Url(history: true)]
    public $search = '';

    public function mount()
    {
        $this->artist = Artist::whereNotNull('discogs_image_url')
            ->orderBy('name')
            ->get();
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="flex flex-col items-center mb-4">
            <svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <circle cx="20" cy="20" r="18" stroke="#202020" stroke-width="4" fill="none" opacity="0"/>
                <circle cx="20" cy="20" r="18" stroke="#202020" stroke-width="4" fill="none" stroke-linecap="round"
                    stroke-dasharray="90 100"
                    transform="rotate(0 20 20)">
                    <animateTransform
                        attributeName="transform"
                        type="rotate"
                        from="0 20 20"
                        to="360 20 20"
                        dur="1s"
                        repeatCount="indefinite"/>
                </circle>
            </svg>
        </div>
        HTML;
    }

    public function render()
    {
        if ($this->search) {
            $this->artist = Artist::where('name', 'like', '%' . $this->search . '%')
                ->whereNotNull('discogs_image_url')
                ->orderBy('name')
                ->get();
        } else {
            $this->artist = Artist::whereNotNull('discogs_image_url')
                ->orderBy('name')
                ->get();
        }

        return view('livewire.admin-list-images', [
            'artists' => $this->artist
        ]);
    }
}
