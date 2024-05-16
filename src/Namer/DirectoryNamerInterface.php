<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\Namer;


interface DirectoryNamerInterface
{
    public function getDirectory(?string $data): string;
}
