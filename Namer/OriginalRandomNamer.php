<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 19/08/16
 * Time: 3:54 PM
 */

namespace NS\FileUploadBundle\Namer;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use RandomLib\Generator;
use RandomLib\Factory;

class OriginalRandomNamer implements FileNamerInterface
{
    private $opts = [
        'length' => 6,
    ];
    /**
     * @param int $length of random portion of filename
     */
    public function setLength($length)
    {
        $this->opts['length'] = (int) $length;
    }

    public function getName(UploadedFile $file)
    {
        $factory = new Factory();
        $generator = $factory->getMediumStrengthGenerator();
        return sprintf(
            '%s_%s.%s',
            pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            $generator->generateString($this->opts['length'], Generator::CHAR_ALNUM),
            $file->getClientOriginalExtension()
        );
    }
}
