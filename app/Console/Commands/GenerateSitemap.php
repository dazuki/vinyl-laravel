<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a sitemap.xml file for the website';

    public function handle()
    {
        Sitemap::create()
            ->add(Url::create('https://vinyl.bokbindaregatan.se/')
                ->setLastModificationDate(Carbon::now()))
            ->add(Url::create('https://vinyl.bokbindaregatan.se/history')
                ->setLastModificationDate(Carbon::now()))
            ->writeToFile(public_path('sitemap.xml'));
    }
}
