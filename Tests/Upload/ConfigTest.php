<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 2016-08-22
 * Time: 5:14 AM
 */

namespace NS\FileUploadBundle\Tests\Upload;


use NS\FileUploadBundle\Namer\HashDirectoryNamer;
use NS\FileUploadBundle\Namer\UniqueHashNamer;
use NS\FileUploadBundle\Upload\Config;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidConfig()
    {
        self::setExpectedException('NS\FileUploadBundle\Exceptions\InvalidConfigurationException','You must provide either a destination path or directory namer');
        $namer = new UniqueHashNamer();
        new Config($namer);
    }

    public function testOnlyDestination()
    {
        $namer = new UniqueHashNamer();
        $config = new Config($namer,"/some/directory");

        self::assertEquals('/some/directory',$config->getPath());
        self::assertEquals('/some/directory',$config->getPath('additional data'));
    }

    public function testOnlyDirectoryNamer()
    {
        $namer = new UniqueHashNamer();
        $dirNamer = new HashDirectoryNamer();
        $config = new Config($namer, null, $dirNamer);

        self::assertEquals(sha1(null),$config->getPath());
        self::assertEquals(sha1('additional data'),$config->getPath('additional data'));
    }

    public function testDestinationAndDirectoryNamer()
    {
        $namer = new UniqueHashNamer();
        $dirNamer = new HashDirectoryNamer();
        $config = new Config($namer, "/some/directory", $dirNamer);

        self::assertEquals("/some/directory/".sha1(null),$config->getPath());
        self::assertEquals("/some/directory/".sha1('additional data'),$config->getPath('additional data'));
    }

    public function testGetFilename()
    {
        $namer = $this->getMock('NS\FileUploadBundle\Namer\FileNamerInterface');
        $namer->expects($this->once())
            ->method('getName')
            ->willReturn('filename.jpg');

        $uploadedFile = new UploadedFile(__FILE__, 'filename.jpg', 'image/jpeg', 9988);
        $config = new Config($namer,"who cares");

        $config->getFilename($uploadedFile);
    }
}
