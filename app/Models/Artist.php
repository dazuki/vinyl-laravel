<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    public function records()
    {
        return $this->hasMany(Record::class, 'artist_id');
    }

    public function scopeSearch($query, $value)
    {
        $valuesArtist = str_replace(' ', '%', $value);
        $query->whereRAW('name like ? ', '%' . mb_strtoupper($valuesArtist) . '%')
            ->orWhereHas('records', function ($query) use ($value) {
                $valuesVinyl = str_replace(' ', '%', $value);
                return $query->whereRaw('record_name like ? COLLATE NOCASE', '%' . mb_strtolower($valuesVinyl) . '%');
            });
    }
}
