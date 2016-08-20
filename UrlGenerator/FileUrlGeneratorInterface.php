<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 19/08/16
 * Time: 1:01 PM
 */

namespace NS\FileUploadBundle\UrlGenerator;

interface FileUrlGeneratorInterface
{
    /**
     * @param string $configName
     * @param string $filename
     * @param mixed|null $additionalData
     * @return string
     */
    public function generate($configName, $filename, $additionalData = null);
}
