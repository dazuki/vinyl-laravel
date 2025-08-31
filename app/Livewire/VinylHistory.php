<?php

namespace App\Livewire;

use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Url;
use Livewire\Component;

class VinylHistory extends Component
{
    #[Url(history: true)]
    public $qhistory = '';

    public bool $loadData = false;

    public $startDate;

    public function init()
    {
        $this->loadData = true;
    }

    public function render()
    {
        $this->startDate = Carbon::create(2023, 11, 1);

        // Search for records created after the start date
        $cacheName = 'history'.($this->qhistory ? '_q-'.$this->qhistory : '');
        Cache::rememberForever($cacheName, function () {
            return Record::search($this->qhistory)->with('artist')->selectRAW('*, CAST(STRFTIME("%s", created_at) as INT) as created_time')
                ->whereRAW('created_time > '.strtotime('2023-11-01 00:00:00'))
                ->orderBy('created_time', 'DESC')
                ->get()
                ->toJson();
        });

        // Cache average number of records per year and month
        // since the start date (2023-11-01)
        Cache::rememberForever('history.avg_year', function () {
            return Record::selectRAW('strftime("%Y", created_at) as year, COUNT(*) as record_count')
                ->whereRAW('created_at >= "'.$this->startDate.'"')
                ->groupBy('year')
                ->pluck('record_count')
                ->avg();
        });

        Cache::rememberForever('history.avg_month', function () {
            return Record::selectRAW('strftime("%Y-%m", created_at) as year_month, COUNT(*) as record_count')
                ->whereRAW('created_at >= "'.$this->startDate.'"')
                ->groupBy('year_month')
                ->pluck('record_count')
                ->avg();
        });

        $history = Cache::get($cacheName);
        // $history = Cache::get('history');
        $avgYear = Cache::get('history.avg_year');
        $avgMonth = Cache::get('history.avg_month');

        // dd($history);

        return view('livewire.vinyl-history', [
            'vinyler' => $this->loadData ? json_decode($history, true) : [],
            'vinyler_avg_year' => $this->loadData ? round($avgYear) : [],
            'vinyler_avg_month' => $this->loadData ? round($avgMonth) : [],
            'vinyler_old' => $this->loadData ? 827 : [], // 827 vinyler saknar datum
            'veckodagar' => ['Söndag', 'Måndag', 'Tisdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lördag'],
        ]);
    }
}
