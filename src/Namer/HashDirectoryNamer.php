<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 19/08/16
 * Time: 4:49 PM
 */

namespace NS\FileUploadBundle\Namer;

class HashDirectoryNamer implements DirectoryNamerInterface
{
    public function getDirectory($data)
    {
        return sha1($data);
    }
}
