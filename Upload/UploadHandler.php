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

class UploadHandler
{
    /** @var UploadHandler[] */
    private $configs = [];

    /** @var string */
    private $rootDirectory;

    /**
     * UploadHandler constructor.
     * @param string $rootDir
     */
    public function __construct($rootDir)
    {
        $this->rootDirectory = $rootDir;
    }

    /**
     * @param $configName
     * @param UploadConfig $config
     */
    public function addConfig($configName, UploadConfig $config)
    {
        $this->configs[$configName] = $config;
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
            $destinationDirectory = sprintf('%s/../web/uploads/%s', $this->rootDirectory, $config->getPath($additionalData));
            $destinationFileName = $config->getFilename($file);
            return $file->move($destinationDirectory, $destinationFileName);
        } catch (FileException $exception) {
            throw new UnableToHandleException('Unable to move uploaded file', null, $exception);
        }
    }
}
