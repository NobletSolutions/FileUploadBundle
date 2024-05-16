<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\Namer;

use RandomLib\Factory;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use RandomLib\Generator;

class RandomNamer implements FileNamerInterface
{
    private Factory $factory;

    private array $opts = [
        'length' => 6,
    ];

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function setLength(int $length)
    {
        $this->opts['length'] = $length;
    }

    public function getName(UploadedFile $file): string
    {
        $generator = $this->factory->getMediumStrengthGenerator();

        return sprintf(
            '%s.%s',
            $generator->generateString($this->opts['length'], Generator::CHAR_ALNUM),
            $file->getClientOriginalExtension()
        );
    }
}
