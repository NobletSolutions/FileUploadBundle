<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 19/08/16
 * Time: 4:07 PM
 */

namespace NS\FileUploadBundle\Exceptions;

class ConfigNotFoundException extends \RuntimeException
{
    /**
     * ConfigNotFoundException constructor.
     *
     * @param string $configName
     */
    public function __construct($configName)
    {
        parent::__construct(sprintf('Unable to location config "%s"',$configName));
    }
}
