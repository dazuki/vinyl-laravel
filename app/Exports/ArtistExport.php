<?php

namespace App\Exports;

use App\Models\Artist;
use App\Models\Record;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ArtistExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $excelCache_ArtistAll = Cache::rememberForever('excelCache_ArtistAll', function () {
            return Artist::all();
        });

        $excelCache_RecordAllCount = Cache::rememberForever('excelCache_RecordAllCount', function () {
            return Record::all()->count();
        });

        return view('exports.collection', [
            'collections' => $excelCache_ArtistAll
                ->sortBy('name'),
            'collections_records' => $excelCache_RecordAllCount
        ]);
    }
}
