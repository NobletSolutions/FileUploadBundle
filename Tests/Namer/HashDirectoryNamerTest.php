<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\Tests\Namer;

use NS\FileUploadBundle\Namer\HashDirectoryNamer;
use PHPUnit\Framework\TestCase;

class HashDirectoryNamerTest extends TestCase
{
    /**
     * @param $data
     *
     * @dataProvider getDirectoryNames
     */
    public function testGenerate($data): void
    {
        $namer = new HashDirectoryNamer();
        self::assertEquals(sha1($data),$namer->getDirectory($data));
    }

    public function getDirectoryNames(): array
    {
        return [
            ['something'],
            ['nathanael@gnat.ca']
        ];
    }
}
