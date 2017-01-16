<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 19/08/16
 * Time: 4:47 PM
 */

namespace NS\FileUploadBundle\Namer;


interface DirectoryNamerInterface
{
    public function getDirectory($data);
}
