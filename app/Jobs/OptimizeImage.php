<?php

namespace App\Jobs;

use App\Optimizers\JpegRecompress;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Spatie\ImageOptimizer\OptimizerChain;
use Spatie\ImageOptimizer\Optimizers\Optipng;
use Spatie\ImageOptimizer\Optimizers\Pngquant;

class OptimizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $pathToImage;

    /**
     * Create a new job instance.
     *
     * @param string $pathToImage
     */
    public function __construct(string $pathToImage)
    {
        $this->pathToImage = $pathToImage;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $optimizerChain = (new OptimizerChain())
            ->addOptimizer(new JpegRecompress([
                '-q high',
                '-n 80',
                '-x 80'
            ]))
            ->addOptimizer(new Pngquant([
                '--force',
            ]))
            ->addOptimizer(new Optipng([
                '-i0',
                '-o2',
                '-quiet',
            ]));

        $optimizerChain->optimize($this->pathToImage);
    }
}
