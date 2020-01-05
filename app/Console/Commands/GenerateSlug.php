<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Post;
use App\Models\Review;
use App\Models\Tour;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class GenerateSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slug:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slug flied for entities whose it is empty';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sluggableModels = [
            Article::class,
            Post::class,
            Review::class,
            Tour::class
        ];

        $mergedCollection = new Collection();
        foreach ($sluggableModels as $sluggableModel) {
            $mergedCollection = $mergedCollection->merge($sluggableModel::query()->whereNull('slug')->get());
        }

        foreach ($mergedCollection as $item) {
            $item->save();
        }

        $this->info('Slugs generated!');
    }
}
