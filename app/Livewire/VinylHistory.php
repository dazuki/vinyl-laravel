<?php

namespace App\Livewire;

use App\Models\Record;
use Livewire\Component;

class VinylHistory extends Component
{
    public bool $loadData = false;

    public function init()
    {
        $this->loadData = true;
    }

    public function render()
    {
        return view('livewire.vinyl-history', [
            'vinyler' => $this->loadData ? Record::selectRAW('*, CAST(STRFTIME("%s", created_at) as INT) as created_time')
                ->whereRAW('created_time > ' . strtotime('2023-11-01 00:00:00'))
                ->orderBy('created_time', 'DESC')
                ->get() : [],
            'vinyler_old' => $this->loadData ? Record::selectRAW('*, CAST(STRFTIME("%s", created_at) as INT) as created_time')
                ->whereRAW('created_time < ' . strtotime('2023-11-01 00:00:00'))
                ->get() : []
        ]);
    }
}
