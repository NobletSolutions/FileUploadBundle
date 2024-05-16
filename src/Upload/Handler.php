<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\Upload;

use NS\FileUploadBundle\Exceptions\ConfigNotFoundException;
use NS\FileUploadBundle\Exceptions\UnableToHandleException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Handler
{
    /** @var Config[] */
    private array $configs = [];

    private string $uploadDirectory;

    public function __construct(string $uploadDirectory)
    {
        $this->uploadDirectory = $uploadDirectory;
    }

    public function addConfig(string $name, Config $config): void
    {
        $this->configs[$name] = $config;
    }

    public function upload(string $configName, UploadedFile $file, $additionalData = null): File
    {
        if (!isset($this->configs[$configName])) {
            throw new ConfigNotFoundException($configName);
        }

        $config = $this->configs[$configName];

        try {
            $destinationDirectory = sprintf('%s/%s', $this->uploadDirectory, $config->getPath($additionalData));
            $destinationFileName = $config->getFilename($file);
            return $file->move($destinationDirectory, $destinationFileName);
        } catch (FileException $exception) {
            throw new UnableToHandleException('Unable to move uploaded file', null, $exception);
        }
    }
}
