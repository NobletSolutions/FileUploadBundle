<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\Upload;

use NS\FileUploadBundle\Exceptions\InvalidConfigurationException;
use NS\FileUploadBundle\Namer\DirectoryNamerInterface;
use NS\FileUploadBundle\Namer\FileNamerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Config
{
    private FileNamerInterface $namer;

    private ?string $destination = null;

    private ?DirectoryNamerInterface $directoryNamer = null;

    public function __construct(FileNamerInterface $namer, ?string $destination = null, ?DirectoryNamerInterface $directoryNamer = null)
    {
        $this->namer = $namer;

        if ($destination === null && $directoryNamer === null) {
            throw new InvalidConfigurationException('You must provide either a destination path or directory namer');
        }

        $this->destination    = $destination;
        $this->directoryNamer = $directoryNamer;
    }

    /**
     * @param $additionalData
     * @return string
     */
    public function getPath($additionalData = null): string
    {
        if ($this->destination !== null && $this->directoryNamer === null) {
            return $this->destination;
        }

        if ($this->destination === null && $this->directoryNamer) {
            return $this->directoryNamer->getDirectory($additionalData);
        }

        return sprintf('%s/%s', $this->destination, $this->directoryNamer->getDirectory($additionalData));
    }

    public function getFilename(UploadedFile $file): string
    {
        return $this->namer->getName($file);
    }
}
