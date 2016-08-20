<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 19/08/16
 * Time: 4:00 PM
 */

namespace NS\FileUploadBundle\Namer;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class UniqueHashNamer implements FileNamerInterface
{
    public function getName(UploadedFile $file)
    {
        return sprintf('%s.%s', sha1($file->getClientOriginalName() . microtime()), $file->getClientOriginalExtension());
    }
}
