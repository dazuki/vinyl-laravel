<?php

namespace App\Exports;

use App\Models\Artist;
use Maatwebsite\Excel\Concerns\FromCollection;

class ArtistExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Artist::all();
    }
}
