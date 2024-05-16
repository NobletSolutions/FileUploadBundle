<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\Namer;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileNamerInterface
{
    public function getName(UploadedFile $file): string;
}
