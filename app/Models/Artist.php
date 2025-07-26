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

    // In your Artist model
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
                \Log::info("Using manual ID {$artistId} for artist: {$this->name}");
            }
            // If we're forcing to use manual ID or don't have auto ID, search
            elseif ($useManualId || !$this->discogs_id) {
                \Log::info("Searching for artist: {$this->name}");

                // Search for the artist first
                $searchResponse = $client->get('https://api.discogs.com/database/search', [
                    'headers' => $headers,
                    'query' => [
                        'q' => $this->name,
                        'type' => 'artist'
                    ]
                ]);

                $searchData = json_decode($searchResponse->getBody(), true);
                \Log::info("Search results for {$this->name}: " . json_encode($searchData));

                if (!empty($searchData['results'])) {
                    $artistId = $searchData['results'][0]['id'];
                    \Log::info("Found artist ID {$artistId} for: {$this->name}");

                    // Only update discogs_id if we don't have a manual override
                    if (!$this->discogs_id_manual && !$useManualId) {
                        $this->update(['discogs_id' => $artistId]);
                    }
                }
            } else {
                // Use existing auto ID
                $artistId = $this->discogs_id;
                \Log::info("Using existing ID {$artistId} for artist: {$this->name}");
            }

            if ($artistId) {
                \Log::info("Fetching details for artist ID: {$artistId}");

                // Get detailed artist info
                $artistResponse = $client->get("https://api.discogs.com/artists/{$artistId}", [
                    'headers' => $headers
                ]);

                $artistData = json_decode($artistResponse->getBody(), true);
                \Log::info("Artist data for {$this->name}: " . json_encode($artistData));

                $imageUrl = isset($artistData['images'][0]['uri']) ? $artistData['images'][0]['uri'] : null;
                $discogsUrl = $artistData['uri'] ?? null;

                // Update the artist record with Discogs data
                $updateData = [
                    'discogs_url' => $discogsUrl,
                    'discogs_image_url' => $imageUrl
                ];

                \Log::info("Updating artist {$this->name} with data: " . json_encode($updateData));
                $this->update($updateData);

                return [
                    'id' => $artistId,
                    'url' => $discogsUrl,
                    'image' => $imageUrl,
                    'web_url' => "https://www.discogs.com/artist/{$artistId}"
                ];
            } else {
                \Log::info("No artist ID found for: {$this->name}");
            }
        } catch (\Exception $e) {
            \Log::error('Discogs API error for ' . $this->name . ': ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
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
