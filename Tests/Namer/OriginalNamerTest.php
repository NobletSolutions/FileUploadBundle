<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\Tests\Namer;

use NS\FileUploadBundle\Namer\OriginalNamer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class OriginalNamerTest extends TestCase
{
    public function testGetName(): void
    {
        $file  = new UploadedFile(__FILE__, 'filename.jpg', 'image/jpeg', 9988);
        $namer = new OriginalNamer();

        self::assertEquals($file->getClientOriginalName(),$namer->getName($file));
    }
}
