<?php

namespace App\Livewire;

use App\Models\Record;
use Illuminate\Support\Facades\Cache;
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
        $vinylerCache = Cache::remember('vinylerCache', 60 * 60, function () {
            return Record::selectRAW('*, CAST(STRFTIME("%s", created_at) as INT) as created_time')
                ->whereRAW('created_time > ' . strtotime('2023-11-01 00:00:00'))
                ->orderBy('created_time', 'DESC')
                ->get();
        });

        return view('livewire.vinyl-history', [
            'vinyler' => $this->loadData ? $vinylerCache : [],
            'vinyler_old' => $this->loadData ? 827 : [] // 827 vinyler saknar datum
        ]);
    }
}
