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
            $query->whereNull('discogs_id');
        }

        $artists = $query->get();

        if ($artists->isEmpty()) {
            $this->info('No artists need processing.');
            return;
        }

        $this->info("Processing {$artists->count()} artists...");
        $bar = $this->output->createProgressBar($artists->count());

        foreach ($artists as $artist) {
            $this->line("Processing: {$artist->name}");
            $artist->getDiscogsData();

            $bar->advance();
            sleep(1); // Rate limiting
        }

        $bar->finish();
        $this->newLine();
        $this->info('Done!');
    }
}
