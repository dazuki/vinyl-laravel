<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $discogs_id
 * @property string|null $discogs_url
 * @property string|null $discogs_image_url
 * @property int|null $discogs_id_manual
 * @property int $discogs_fetch_attempted
 * @property-read mixed $discogs_image
 * @property-read mixed $discogs_web_url
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Record> $records
 * @property-read int|null $records_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist search($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist whereDiscogsFetchAttempted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist whereDiscogsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist whereDiscogsIdManual($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist whereDiscogsImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artist whereDiscogsUrl($value)
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

    public function getDiscogsData($useManualId = false)
    {
        $client = new \GuzzleHttp\Client();

        $headers = [
            'User-Agent' => config('services.discogs.user_agent'),
            'Authorization' => 'Discogs key=' . config('services.discogs.key') . ', secret=' . config('services.discogs.secret')
        ];

        try {
            $artistId = null;

            // If we have a manual ID, use it directly
            if ($this->discogs_id_manual) {
                $artistId = $this->discogs_id_manual;
            }
            // If we're forcing to use manual ID or don't have auto ID, search
            elseif ($useManualId || !$this->discogs_id) {
                // Search for the artist first
                $searchResponse = $client->get('https://api.discogs.com/database/search', [
                    'headers' => $headers,
                    'query' => [
                        'q' => $this->name,
                        'type' => 'artist'
                    ]
                ]);

                $searchData = json_decode($searchResponse->getBody(), true);

                if (!empty($searchData['results'])) {
                    $artistId = $searchData['results'][0]['id'];

                    // Only update discogs_id if we don't have a manual override
                    if (!$this->discogs_id_manual && !$useManualId) {
                        $this->update(['discogs_id' => $artistId]);
                    }
                }
            } else {
                // Use existing auto ID
                $artistId = $this->discogs_id;
            }

            if ($artistId) {
                // Get detailed artist info
                $artistResponse = $client->get("https://api.discogs.com/artists/{$artistId}", [
                    'headers' => $headers
                ]);

                $artistData = json_decode($artistResponse->getBody(), true);

                // Update the artist record with Discogs data
                $this->update([
                    'discogs_url' => $artistData['uri'] ?? null,
                    'discogs_image_url' => $artistData['images'][0]['uri'] ?? null
                ]);

                return [
                    'id' => $artistId,
                    'url' => $artistData['uri'],
                    'image' => $artistData['images'][0]['uri'] ?? null,
                    'web_url' => "https://www.discogs.com/artist/{$artistId}"
                ];
            }
        } catch (\Exception $e) {
            \Log::error('Discogs API error: ' . $e->getMessage());
        }

        return null;
    }

    public function getEffectiveDiscogsId()
    {
        return $this->discogs_id_manual ?? $this->discogs_id;
    }

    public function getDiscogsImageAttribute()
    {
        // If we already have the data, return it
        if ($this->discogs_image_url) {
            return $this->discogs_image_url;
        }

        // If we don't have it, fetch from API
        $discogsData = $this->getDiscogsData();
        return $discogsData['image'] ?? null;
    }

    // Helper method to get the web URL for linking
    public function getDiscogsWebUrlAttribute()
    {
        $effectiveId = $this->getEffectiveDiscogsId();
        if ($effectiveId) {
            return "https://www.discogs.com/artist/{$effectiveId}";
        }
        return null;
    }
}
