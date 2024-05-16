<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\UrlGenerator;

interface FileUrlGeneratorInterface
{
    public function generate(string $configName, string $filename, mixed $additionalData = null): string;

    public function generateFullPath(string $configName, string $filename, mixed $additionalData = null): string;
}

