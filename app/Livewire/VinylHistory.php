<?php

namespace App\Livewire;

use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class VinylHistory extends Component
{
    public bool $loadData = false;

    public $startDate;

    public function init()
    {
        $this->loadData = true;
    }

    public function render()
    {
        $this->startDate = Carbon::create(2023, 11, 1);

        $vinylerHistoryCache = Cache::rememberForever('history', function () {
            return Record::with('artist')->selectRAW('*, CAST(STRFTIME("%s", created_at) as INT) as created_time')
                ->whereRAW('created_time > '.strtotime('2023-11-01 00:00:00'))
                ->orderBy('created_time', 'DESC')
                ->get()
                ->toJson();
        });

        $vinylerAvgYearCache = Cache::rememberForever('history.avg_year', function () {
            return Record::selectRAW('strftime("%Y", created_at) as year, COUNT(*) as record_count')
                ->whereRAW('created_at >= "'.$this->startDate.'"')
                ->groupBy('year')
                ->pluck('record_count')
                ->avg();
        });

        $vinylerAvgMonthCache = Cache::rememberForever('history.avg_month', function () {
            return Record::selectRAW('strftime("%Y-%m", created_at) as year_month, COUNT(*) as record_count')
                ->whereRAW('created_at >= "'.$this->startDate.'"')
                ->groupBy('year_month')
                ->pluck('record_count')
                ->avg();
        });

        $getHistoryCache = Cache::get('history');
        $getAvgYearCache = Cache::get('history.avg_year');
        $getAvgMonthCache = Cache::get('history.avg_month');

        return view('livewire.vinyl-history', [
            'vinyler' => $this->loadData ? json_decode($getHistoryCache, true) : [],
            'vinyler_avg_year' => $this->loadData ? round($getAvgYearCache) : [],
            'vinyler_avg_month' => $this->loadData ? round($getAvgMonthCache) : [],
            'vinyler_old' => $this->loadData ? 827 : [], // 827 vinyler saknar datum
        ]);
    }
}
