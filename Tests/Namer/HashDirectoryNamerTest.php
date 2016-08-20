<?php

namespace NS\FileUploadBundle\Tests;

use NS\FileUploadBundle\Namer\HashDirectoryNamer;

/**
 * Created by PhpStorm.
 * User: gnat
 * Date: 2016-08-19
 * Time: 10:48 PM
 */
class HashDirectoryNamerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $data
     *
     * @dataProvider getDirectoryNames
     */
    public function testGenerate($data)
    {
        $namer = new HashDirectoryNamer();
        self::assertEquals(sha1($data),$namer->getDirectory($data));
    }

    public function getDirectoryNames()
    {
        return [
            ['something'],
            ['nathanael@gnat.ca']
        ];
    }
}
