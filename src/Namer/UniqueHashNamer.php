<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\Namer;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class UniqueHashNamer implements FileNamerInterface
{
    public function getName(UploadedFile $file): string
    {
        return sprintf('%s.%s', sha1($file->getClientOriginalName() . microtime()), $file->getClientOriginalExtension());
    }
}
