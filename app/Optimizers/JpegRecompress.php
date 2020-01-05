<?php

namespace App\Optimizers;


use Spatie\ImageOptimizer\Image;
use Spatie\ImageOptimizer\Optimizers\BaseOptimizer;

class JpegRecompress extends BaseOptimizer
{
    public $binaryName = 'jpeg-recompress';

    public function canHandle(Image $image): bool
    {
        return $image->mime() === 'image/jpeg';
    }

    public function getCommand(): string
    {
        $optionString = implode(' ', $this->options);

        return "\"{$this->binaryPath}{$this->binaryName}\" {$optionString} "
            .escapeshellarg($this->imagePath) . ' ' . escapeshellarg($this->imagePath);
    }
}