<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 19/08/16
 * Time: 4:02 PM
 */

namespace NS\FileUploadBundle\UrlGenerator;

use NS\FileUploadBundle\Exceptions\ConfigNotFoundException;
use NS\FileUploadBundle\Upload\Config;
use Symfony\Component\Asset\Packages;

class Local implements FileUrlGeneratorInterface
{
    /** @var Config[] */
    private $configs = [];

    /** @var Packages */
    private $packages;

    /**
     * Local constructor.
     * @param Packages $packages
     */
    public function __construct(Packages $packages)
    {
        $this->packages = $packages;
    }

    /**
     * @param string $name
     * @param Config $config
     */
    public function addConfig($name, Config $config)
    {
        $this->configs[$name] = $config;
    }

    /**
     * @inheritDoc
     */
    public function generate($configName, $filename, $additionalData = null)
    {
        if (!isset($this->configs[$configName])) {
            throw new ConfigNotFoundException($configName);
        }

        return $this->packages->getUrl(sprintf('uploads/%s/%s', $this->configs[$configName]->getPath($additionalData), $filename));
    }
}
