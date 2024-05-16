<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\Namer;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class OriginalNamer implements FileNamerInterface
{
    public function getName(UploadedFile $file): string
    {
        return $file->getClientOriginalName();
    }
}
