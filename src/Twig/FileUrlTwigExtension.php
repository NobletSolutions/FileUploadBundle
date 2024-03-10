<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 19/08/16
 * Time: 4:37 PM
 */

namespace NS\FileUploadBundle\Twig;

use NS\FileUploadBundle\UrlGenerator\FileUrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FileUrlTwigExtension extends AbstractExtension
{
    /** @var FileUrlGeneratorInterface */
    private $urlGenerator;

    /**
     * FileUrlTwigExtension constructor.
     * @param FileUrlGeneratorInterface $urlGenerator
     */
    public function __construct(FileUrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @inheritDoc
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('file_path',[$this,'getFileUrl'],['is_safe'=>['html']])
        ];
    }

    public function getFileUrl($configName, $filename, $additionalData = null)
    {
        return $this->urlGenerator->generate($configName, rawurlencode($filename), $additionalData);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'ns_file.file_url_twig';
    }
}
