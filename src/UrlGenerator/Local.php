<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\UrlGenerator;

use NS\FileUploadBundle\Exceptions\ConfigNotFoundException;
use NS\FileUploadBundle\Upload\Config;
use Symfony\Component\Asset\Packages;

class Local implements FileUrlGeneratorInterface
{
    /** @var Config[] */
    private array $configs = [];

    private Packages $packages;

    private string $webDirectory;

    public function __construct(string $webDir, Packages $packages)
    {
        $this->webDirectory = $webDir;
        $this->packages     = $packages;
    }

    public function addConfig(string $name, Config $config): void
    {
        $this->configs[$name] = $config;
    }

    public function generate(string $configName, string $filename, mixed $additionalData = null): string
    {
        if (!isset($this->configs[$configName])) {
            throw new ConfigNotFoundException($configName);
        }

        return $this->packages->getUrl(sprintf('uploads/%s/%s', $this->configs[$configName]->getPath($additionalData), $filename));
    }

    public function generateFullPath(string $configName, string $filename, mixed $additionalData = null): string
    {
        return sprintf('%s/%s', $this->webDirectory, $this->generate($configName, $filename, $additionalData));
    }
}

