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
    public function view(): View
    {
        $excelCache_ArtistAll = Cache::rememberForever('excel_artists', function () {
            return Artist::all();
        });

        $excelCache_RecordAllCount = Cache::rememberForever('excel_records', function () {
            return Record::all()->count();
        });

        return view('exports.collection', [
            'collections' => $excelCache_ArtistAll
                ->sortBy('name'),
            'collections_records' => $excelCache_RecordAllCount,
        ]);
    }
}
