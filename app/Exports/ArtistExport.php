<?php

namespace App\Exports;

use App\Models\Artist;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ArtistExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('exports.collection', [
            'collections' => Artist::all()
                ->sortBy('name')
        ]);
    }
}
