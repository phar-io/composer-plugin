<?php
namespace PharIo\Composer\Tests\Unit\Console;

use PharIo\Composer\Common\PhiveBinaryException;
use PharIo\Composer\Console\PhiveBinary;

class PhiveBinaryTest extends \PHPUnit_Framework_TestCase {

    public function testCanCreateAPhiveBinary() {
        $exception = null;

        try {
            $phiveBinary = new PhiveBinary(__DIR__ . '/../../Fixtures/phive.php');
        } catch (\RuntimeException $exception) {
            $this->fail();
        }

        $this->assertNull($exception);
    }

    /**
     * @expectedException \PharIo\Composer\Common\PhiveBinaryException
     */
    public function testAnExceptionAreThrownIfBinaryPathNotExist()
    {
        $phiveBinary = new PhiveBinary('/foo');
    }
}