<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 19/08/16
 * Time: 3:54 PM
 */

namespace NS\FileUploadBundle\Namer;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class OriginalNamer implements FileNamerInterface
{
    public function getName(UploadedFile $file)
    {
        return $file->getClientOriginalName();
    }
}
