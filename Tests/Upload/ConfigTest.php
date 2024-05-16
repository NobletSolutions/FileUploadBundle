<?php

namespace NS\FileUploadBundle\Tests\Upload;

use NS\FileUploadBundle\Namer\HashDirectoryNamer;
use NS\FileUploadBundle\Namer\UniqueHashNamer;
use NS\FileUploadBundle\Upload\Config;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use NS\FileUploadBundle\Exceptions\InvalidConfigurationException;
use NS\FileUploadBundle\Namer\FileNamerInterface;

class ConfigTest extends TestCase
{
    public function testInvalidConfig(): void
    {
        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessage('You must provide either a destination path or directory namer');
        $namer = new UniqueHashNamer();
        new Config($namer);
    }

    public function testOnlyDestination(): void
    {
        $namer = new UniqueHashNamer();
        $config = new Config($namer, "/some/directory");

        self::assertEquals('/some/directory', $config->getPath());
        self::assertEquals('/some/directory', $config->getPath('additional data'));
    }

    public function testOnlyDirectoryNamer(): void
    {
        $namer = new UniqueHashNamer();
        $dirNamer = new HashDirectoryNamer();
        $config = new Config($namer, null, $dirNamer);

        self::assertEquals(sha1('null'), $config->getPath());
        self::assertEquals(sha1('additional data'), $config->getPath('additional data'));
    }

    public function testDestinationAndDirectoryNamer(): void
    {
        $namer = new UniqueHashNamer();
        $dirNamer = new HashDirectoryNamer();
        $config = new Config($namer, "/some/directory", $dirNamer);

        self::assertEquals("/some/directory/" . sha1('null'), $config->getPath());
        self::assertEquals("/some/directory/" . sha1('additional data'), $config->getPath('additional data'));
    }

    public function testGetFilename(): void
    {
        $namer = $this->createMock(FileNamerInterface::class);
        $namer->expects($this->once())
            ->method('getName')
            ->willReturn('filename.jpg');

        $uploadedFile = new UploadedFile(__FILE__, 'filename.jpg', 'image/jpeg', 9988);
        $config = new Config($namer, "who cares");

        $config->getFilename($uploadedFile);
    }
}
