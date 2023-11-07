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
        $query->whereRAW('name like ? ', '%' . mb_strtoupper($value) . '%')
            ->orWhereHas('records', function ($query) use ($value) {
                return $query->whereRaw('record_name like ? COLLATE NOCASE', '%' . mb_strtolower($value) . '%');
            });
    }
}
