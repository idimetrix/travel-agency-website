<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadImages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    private $uploadedImages;
    /**
     * @var int|null
     */
    private $width;
    /**
     * @var int|null
     */
    private $height;
    /**
     * @var null|string
     */
    private $type;

    /**
     * Create a new job instance.
     *
     * @param array $uploadedImages
     * @param int|null $width
     * @param int|null $height
     * @param string $type
     */
    public function __construct(
        array $uploadedImages,
        ?int $width = null,
        ?int $height = null,
        string $type = Image::DEFAULT_TYPE
    ) {
        $this->uploadedImages = $uploadedImages;
        $this->width = $width;
        $this->height = $height;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return array
     */
    public function handle(): array
    {
        return array_map(function (UploadedFile $uploadedFile) {
            return dispatch_now(new UploadImage($uploadedFile, $this->width, $this->height, $this->type));
        }, $this->uploadedImages);
    }
}
