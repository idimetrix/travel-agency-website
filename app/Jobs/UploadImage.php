<?php

namespace App\Jobs;

use App\Models\Image as ImageModel;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

class UploadImage
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var UploadedFile
     */
    private $uploadedFile;
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
     * @param UploadedFile $uploadedFile
     * @param int|null $width
     * @param int|null $height
     * @param string $type
     */
    public function __construct(
        UploadedFile $uploadedFile,
        ?int $width = null,
        ?int $height = null,
        string $type = \App\Models\Image::DEFAULT_TYPE
    ) {
        $this->uploadedFile = $uploadedFile;
        $this->width = $width;
        $this->height = $height;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return ImageModel
     */
    public function handle(): ImageModel
    {
        $filename = md5(microtime()) . '.' . $this->uploadedFile->clientExtension();
        $path = 'images/' . $filename;
        $storagePath = storage_path('app/public/' . $path);

        /** @var \Intervention\Image\Image $img */
        $img = Image::make($this->uploadedFile);
        if ($this->width && $this->height) {
            $img->resize($this->width, $this->height, function (Constraint $constraint) {
                $constraint->aspectRatio();
            });
        }
        $img->save($storagePath, 100);

        dispatch(new OptimizeImage($storagePath));

        return ImageModel::create(['path' => $path, 'type' => $this->type]);
    }
}
