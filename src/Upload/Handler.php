<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 19/08/16
 * Time: 1:06 PM
 */

namespace NS\FileUploadBundle\Upload;

use NS\FileUploadBundle\Exceptions\ConfigNotFoundException;
use NS\FileUploadBundle\Exceptions\UnableToHandleException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Handler
{
    /** @var Config[] */
    private $configs = [];

    /** @var string */
    private $uploadDirectory;

    /**
     * @param string $uploadDirectory
     */
    public function __construct($uploadDirectory)
    {
        $this->uploadDirectory = $uploadDirectory;
    }

    /**
     * @param $name
     * @param Config $config
     */
    public function addConfig($name, Config $config)
    {
        $this->configs[$name] = $config;
    }

    /**
     * @param $configName
     * @param UploadedFile $file
     * @param null $additionalData
     *
     * @return \Symfony\Component\HttpFoundation\File\File
     */
    public function upload($configName, UploadedFile $file, $additionalData = null)
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
