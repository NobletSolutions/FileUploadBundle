<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\Tests\Namer;

use NS\FileUploadBundle\Namer\RandomNamer;
use PHPUnit\Framework\TestCase;
use RandomLib\Factory;
use RandomLib\Generator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RandomNamerTest extends TestCase
{
    public function testGetName(): void
    {
        $generator = $this->createMock(Generator::class);

        $generator
            ->method('generateString')
            ->with(6,Generator::CHAR_ALNUM)
            ->willReturn('MediumStrengthRandomString');

        self::assertEquals('MediumStrengthRandomString',$generator->generateString(6,Generator::CHAR_ALNUM));

        $factoryMock = $this->createMock(Factory::class);

        $factoryMock->expects($this->atLeast(2))
            ->method('getMediumStrengthGenerator')
            ->willReturn($generator);

        self::assertEquals($generator,$factoryMock->getMediumStrengthGenerator());

        $file  = new UploadedFile(__FILE__, 'filename.jpg', 'image/jpeg', 9988);
        $namer = new RandomNamer($factoryMock);

        self::assertEquals('MediumStrengthRandomString.jpg',$namer->getName($file));
    }
}
