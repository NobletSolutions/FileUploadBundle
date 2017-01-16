<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 19/08/16
 * Time: 1:06 PM
 */

namespace NS\FileUploadBundle\Upload;

use NS\FileUploadBundle\Exceptions\InvalidConfigurationException;
use NS\FileUploadBundle\Namer\DirectoryNamerInterface;
use NS\FileUploadBundle\Namer\FileNamerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Config
{
    /** @var FileNamerInterface */
    private $namer;

    /** @var string */
    private $destination;

    /** @var DirectoryNamerInterface|null */
    private $directoryNamer;

    /**
     * Config constructor.
     * @param FileNamerInterface $namer
     * @param string|null $destination
     * @param DirectoryNamerInterface|null $directoryNamer
     *
     * @throws InvalidConfigurationException
     */
    public function __construct(FileNamerInterface $namer, $destination = null, DirectoryNamerInterface $directoryNamer = null)
    {
        $this->namer = $namer;

        if ($destination === null && $directoryNamer === null) {
            throw new InvalidConfigurationException('You must provide either a destination path or directory namer');
        }

        $this->destination = $destination;
        $this->directoryNamer = $directoryNamer;
    }

    /**
     * @param $additionalData
     * @return string
     */
    public function getPath($additionalData = null)
    {
        if ($this->destination !== null && $this->directoryNamer === null) {
            return $this->destination;
        }

        if ($this->destination === null && $this->directoryNamer) {
            return $this->directoryNamer->getDirectory($additionalData);
        }

        return sprintf('%s/%s', $this->destination, $this->directoryNamer->getDirectory($additionalData));
    }

    /**
     * @param UploadedFile $file
     * @return mixed
     */
    public function getFilename(UploadedFile $file)
    {
        return $this->namer->getName($file);
    }
}
