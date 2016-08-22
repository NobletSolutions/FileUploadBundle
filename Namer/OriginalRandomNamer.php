<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 19/08/16
 * Time: 3:54 PM
 */

namespace NS\FileUploadBundle\Namer;

use RandomLib\Factory;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use RandomLib\Generator;

class OriginalRandomNamer implements FileNamerInterface
{
    /** @var Factory */
    private $factory;

    /** @var array */
    private $opts = [
        'length' => 6,
    ];

    /**
     * OriginalRandomNamer constructor.
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param int $length of random portion of filename
     */
    public function setLength($length)
    {
        $this->opts['length'] = (int) $length;
    }

    public function getName(UploadedFile $file)
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
