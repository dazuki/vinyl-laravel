<?php

namespace App\Console\Commands;

use App\Models\Artist;
use Illuminate\Console\Command;

class DiscogsDataPopulate extends Command
{
    protected $signature = 'discogs:populate {--force : Force repopulate existing data}';
    protected $description = 'Populate Discogs data for artists';

    public function handle()
    {
        $query = Artist::query();

        if (!$this->option('force')) {
            // Only get artists that don't have any Discogs data
            $query->where(function ($q) {
                $q->whereNull('discogs_id')
                    ->whereNull('discogs_id_manual')
                    ->orWhere('discogs_fetch_attempted', false);
            });
        }

        $artists = $query->get();

        if ($artists->isEmpty()) {
            $this->info('No artists need processing.');
            return;
        }

        $this->info("Processing {$artists->count()} artists...");
        $bar = $this->output->createProgressBar($artists->count());

        foreach ($artists as $artist) {
            $this->newLine();
            $this->line("Processing: {$artist->name}");

            try {
                // Reset fetch attempted to ensure fresh data
                $artist->update(['discogs_fetch_attempted' => false]);

                // Fetch the data
                $result = $artist->getDiscogsData();

                if ($result) {
                    $this->line("  ✓ Found: ID {$result['id']} - Image: " . ($result['image'] ? 'Yes' : 'No'));
                } else {
                    $this->line("  ✗ No data found");
                }

                // Mark as attempted
                $artist->update(['discogs_fetch_attempted' => true]);
            } catch (\Exception $e) {
                $this->error("  Error: " . $e->getMessage());
                \Log::error("Discogs populate error for artist {$artist->id}: " . $e->getMessage());
            }

            $bar->advance();
            sleep(1); // Rate limiting
        }

        $bar->finish();
        $this->newLine();
        $this->info('Done!');

        // Show summary
        $withImages = Artist::whereNotNull('discogs_image_url')->count();
        $withIds = Artist::whereNotNull('discogs_id')->orWhereNotNull('discogs_id_manual')->count();

        $this->newLine();
        $this->info("Summary:");
        $this->info("Artists with Discogs IDs: {$withIds}");
        $this->info("Artists with images: {$withImages}");
    }
}
