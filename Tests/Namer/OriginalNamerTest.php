<?php
/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 2016-08-19
 * Time: 11:01 PM
 */

namespace NS\FileUploadBundle\Tests;


use NS\FileUploadBundle\Namer\OriginalNamer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class OriginalNamerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $file  = new UploadedFile(__FILE__, 'filename.jpg', 'image/jpeg', 9988);
        $namer = new OriginalNamer();

        self::assertEquals($file->getClientOriginalName(),$namer->getName($file));
    }

}
