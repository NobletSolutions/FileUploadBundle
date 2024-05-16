<?php declare(strict_types = 1);

namespace NS\FileUploadBundle\Namer;

use RandomLib\Factory;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use RandomLib\Generator;

class OriginalRandomNamer implements FileNamerInterface
{
    private Factory $factory;

    private array $opts = [
        'length' => 6,
    ];

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function setLength(int $length): void
    {
        $this->opts['length'] = $length;
    }

    public function getName(UploadedFile $file): string
    {
        $generator = $this->factory->getMediumStrengthGenerator();

        return sprintf(
            '%s_%s.%s',
            pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            $generator->generateString($this->opts['length'], Generator::CHAR_ALNUM),
            $file->getClientOriginalExtension()
        );
    }
}
