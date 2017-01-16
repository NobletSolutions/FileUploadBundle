<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 19/08/16
 * Time: 1:02 PM
 */

namespace NS\FileUploadBundle\Namer;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileNamerInterface
{
    public function getName(UploadedFile $file);
}
