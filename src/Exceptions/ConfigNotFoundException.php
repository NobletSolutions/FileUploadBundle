<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\Exceptions;

class ConfigNotFoundException extends \RuntimeException
{
    public function __construct(string $configName)
    {
        parent::__construct(sprintf('Unable to location config "%s"',$configName));
    }
}
