<?php

namespace App\Console\Commands;

use App\Models\Artist;
use Illuminate\Console\Command;

class DiscogsDataRefresh extends Command
{
    protected $signature = 'discogs:refresh-manual';
    protected $description = 'Refresh Discogs data for artists with manual IDs';

    public function handle()
    {
        $artists = Artist::whereNotNull('discogs_id_manual')->get();

        if ($artists->isEmpty()) {
            $this->info('No artists with manual Discogs IDs found.');
            return;
        }

        $this->info("Refreshing {$artists->count()} artists with manual IDs...");
        $bar = $this->output->createProgressBar($artists->count());

        foreach ($artists as $artist) {
            $this->line("Refreshing: {$artist->name} (Manual ID: {$artist->discogs_id_manual})");
            $artist->getDiscogsData();

            $bar->advance();
            sleep(1); // Rate limiting
        }

        $bar->finish();
        $this->newLine();
        $this->info('Manual ID refresh completed!');
    }
}
