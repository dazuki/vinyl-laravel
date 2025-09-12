<?php

namespace App\Console\Commands;

use App\Models\Artist;
use Illuminate\Console\Command;

class DiscogsDataReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discogs:reset {--manual-only : Only reset manual IDs} {--force : Skip confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Discogs data for artists';

    public function handle()
    {
        $manualOnly = $this->option('manual-only');

        $message = $manualOnly
            ? 'Reset only manual Discogs IDs? This cannot be undone.'
            : 'Reset all Discogs data? This cannot be undone.';

        if (!$this->option('force') && !$this->confirm($message)) {
            $this->info('Cancelled.');
            return;
        }

        $query = Artist::query();

        if ($manualOnly) {
            $count = $query->whereNotNull('discogs_id_manual')->count();
            $query->update([
                'discogs_id_manual' => null,
                'discogs_fetch_attempted' => false
            ]);
            $this->info("Reset manual Discogs IDs for {$count} artists.");
        } else {
            $count = $query->whereNotNull('discogs_id')
                ->orWhereNotNull('discogs_id_manual')
                ->orWhereNotNull('discogs_url')
                ->orWhereNotNull('discogs_image_url')
                ->count();

            $query->update([
                'discogs_id' => null,
                'discogs_id_manual' => null,
                'discogs_url' => null,
                'discogs_image_url' => null,
                'discogs_fetch_attempted' => false
            ]);

            $this->info("Reset all Discogs data for {$count} artists.");
        }
    }
}
