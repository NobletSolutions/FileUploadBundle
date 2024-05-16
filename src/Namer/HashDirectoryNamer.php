<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\Namer;

class HashDirectoryNamer implements DirectoryNamerInterface
{
    public function getDirectory(?string $data): string
    {
        return sha1($data??'null');
    }
}
