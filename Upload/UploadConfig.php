<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 19/08/16
 * Time: 1:06 PM
 */

namespace NS\FileUploadBundle\Upload;

use NS\FileUploadBundle\Namer\DirectoryNamerInterface;
use NS\FileUploadBundle\Namer\FileNamerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadConfig
{
    /** @var string */
    private $name;

    /** @var FileNamerInterface */
    private $namer;

    /** @var string */
    private $destination;

    /**
     * UploadConfig constructor.
     * @param string $name
     * @param FileNamerInterface $namer
     * @param string|null $destination
     * @param DirectoryNamerInterface|null $directoryNamer
     */
    public function __construct($name, FileNamerInterface $namer, $destination = null, DirectoryNamerInterface $directoryNamer = null)
    {
        $this->name = $name;
        $this->namer = $namer;

        if ($destination === null && $directoryNamer === null) {
            throw new \RuntimeException('You must provide either a destination path or directory namer');
        }

        $this->destination = $destination;
        $this->dirNamer = $directoryNamer;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function getPath($additionalData)
    {
        if($this->destination !== null && $this->dirNamer === null) {
            return $this->destination;
        }

        if ($this->destination === null && $this->dirNamer) {
            return $this->dirNamer->getDirectory($additionalData);
        }

        return sprintf('%s/%s',$this->destination,$this->dirNamer->getDirectory($additionalData));
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
