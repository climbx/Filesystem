<?php

namespace Climbx\Filesystem\Tests;

use Climbx\Filesystem\Exception\FileErrorException;
use Climbx\Filesystem\FileHelper;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Climbx\Filesystem\FileHelper
 */
class FileHelperTest extends TestCase
{
    public function testBadFilePath()
    {
        $helper = new FileHelper();

        // contentAsArray test
        $this->expectException(FileErrorException::class);
        $this->expectExceptionMessage("The file '/path/to/a/missing/file' do not exists or has no read access.");

        $helper->getContentAsArray('/path/to/a/missing/file');

        // contentAsString test
        $this->expectException(FileErrorException::class);
        $this->expectExceptionMessage("The file '/path/to/a/missing/file' do not exists or has no read access.");

        $helper->getContentAsString('/path/to/a/missing/file');
    }

    public function testGoodFilePath()
    {
        $fileReader = new FileHelper();
        $tmpdir = sys_get_temp_dir();

        // contentAsArray test
        $filename = tempnam($tmpdir, 'test_array');
        file_put_contents($filename, "Hello world!\n\nThis is a good day.");

        $fileContent = $fileReader->getContentAsArray($filename);

        $this->assertIsArray($fileContent);
        $this->assertEquals(["Hello world!", "", 'This is a good day.'], $fileContent);

        unlink($filename);

        // contentAsString test
        $filename = tempnam($tmpdir, 'test_str');
        file_put_contents($filename, "Hello world!\nThis is a good day.");

        $fileContent = $fileReader->getContentAsString($filename);

        $this->assertEquals("Hello world!\nThis is a good day.", $fileContent);

        unlink($filename);
    }
}
