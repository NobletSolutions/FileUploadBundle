<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 2016-08-22
 * Time: 4:08 AM
 */

namespace NS\FileUploadBundle\Tests\Namer;

use NS\FileUploadBundle\Namer\RandomNamer;
use RandomLib\Factory;
use RandomLib\Generator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RandomNamerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $generator = $this->getMockBuilder('\RandomLib\Generator')
            ->disableOriginalConstructor()
            ->setMethods(['generateString'])
            ->getMock();

        $generator->expects($this->any())
            ->method('generateString')
            ->with(6,Generator::CHAR_ALNUM)
            ->willReturn('MediumStrengthRandomString');

        self::assertEquals('MediumStrengthRandomString',$generator->generateString(6,Generator::CHAR_ALNUM));

        $factoryMock = $this->getMockBuilder(Factory::class)
            ->disableOriginalConstructor()
//            ->setMethods(['getMediumStrengthGenerator'])
            ->getMock();

        $factoryMock->expects($this->atLeast(2))
            ->method('getMediumStrengthGenerator')
            ->willReturn($generator);

        self::assertEquals($generator,$factoryMock->getMediumStrengthGenerator());

        $file  = new UploadedFile(__FILE__, 'filename.jpg', 'image/jpeg', 9988);
        $namer = new RandomNamer($factoryMock);

        self::assertEquals('MediumStrengthRandomString.jpg',$namer->getName($file));
    }
}
