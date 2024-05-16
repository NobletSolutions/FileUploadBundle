<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\Twig;

use NS\FileUploadBundle\UrlGenerator\FileUrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FileUrlTwigExtension extends AbstractExtension
{
    private FileUrlGeneratorInterface $urlGenerator;

    public function __construct(FileUrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('file_path',[$this,'getFileUrl'],['is_safe'=>['html']])
        ];
    }

    public function getFileUrl($configName, $filename, $additionalData = null): string
    {
        return $this->urlGenerator->generate($configName, rawurlencode($filename), $additionalData);
    }
}
