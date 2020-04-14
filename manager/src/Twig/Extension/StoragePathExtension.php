<?php

declare(strict_types=1);

namespace App\Twig\Extension;

use App\Service\Uploader\FileUploader;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class StoragePathExtension extends AbstractExtension
{
    /**
     * @var FileUploader
     */
    private $uploader;

    /**
     * @param FileUploader $uploader
     */
    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('storage_path', [$this, 'path'], ['is_safe' => ['html']])
        ];
    }

    /**
     * @param string $path
     * @return string
     */
    public function path(string $path): string
    {
        return $this->uploader->generateUrl($path);
    }
}