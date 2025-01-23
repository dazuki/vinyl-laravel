<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $discogs_id
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Record> $records
 * @property-read int|null $records_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist search($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist whereDiscogsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    public static function searchCount($value)
    {
        $valuesArtist = str_replace(' ', '%', $value);
        return Artist::whereRAW('name like ? ', '%' . mb_strtoupper($valuesArtist) . '%');
    }
}
