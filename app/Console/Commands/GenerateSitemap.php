<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Spatie\Sitemap\Tags\Url;

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
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('Sitemap generation: started');
        $ignorable = ['images', 'storage'];

        \Spatie\Sitemap\SitemapGenerator::create(config('app.url'))
            ->hasCrawled(function (Url $url) use ($ignorable) {
                if (\in_array($url->segment(1), $ignorable, true)) {
                    return;
                }

                return $url;
            })
            ->writeToFile(public_path('sitemap.xml'));

        Log::info('Sitemap generation: finished');
        $this->info('Sitemap generated!');
    }
}
