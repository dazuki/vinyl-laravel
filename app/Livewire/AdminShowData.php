<?php

namespace App\Livewire;

use App\Models\Artist;
use Livewire\Component;

class AdminShowData extends Component
{
    public $noids;

    public $noimages;

    public $hasmid;

    public $hasnothing;

    public function mount()
    {
        $this->noids = Artist::whereNull('discogs_id')->whereNull('discogs_id_manual')->get();
        $this->noimages = Artist::whereNull('discogs_image_url')->get();
        $this->hasmid = Artist::whereNotNull('discogs_id_manual')->get();
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
        return view('livewire.admin-show-data', [
            'noids' => $this->noids,
            'noimages' => $this->noimages,
            'hasmid' => $this->hasmid,
        ]);
    }
}
