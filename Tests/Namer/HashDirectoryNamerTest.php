<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\Tests\Namer;

use NS\FileUploadBundle\Namer\HashDirectoryNamer;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class HashDirectoryNamerTest extends TestCase
{
    #[DataProvider('getDirectoryNames')]
    public function testGenerate(string $data): void
    {
        $namer = new HashDirectoryNamer();
        self::assertEquals(sha1($data),$namer->getDirectory($data));
    }

    public static function getDirectoryNames(): array
    {
        return [
            ['something'],
            ['nathanael@gnat.ca']
        ];
    }
}
