<?php

namespace GrinWay\EnvProcessor\Tests\Unit;

use GrinWay\EnvProcessor\EnvProcessor\AssertFileExistsVarProcessor;
use GrinWay\EnvProcessor\Exception\FileNonExistentEnvProcessorException;
use GrinWay\EnvProcessor\Tests\AbstractEnvProcessorTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;

#[CoversClass(AssertFileExistsVarProcessor::class)]
class AssertFileExistsVarProcessorTest extends AbstractEnvProcessorTestCase
{
    #[RunInSeparateProcess]
    public function testExistingFileDoesNotThrow()
    {
        $_ENV['TEST_PATH'] = self::$tmpTestExistingAbsFilepath;

        $processedPath = (self::$getenv)('grinway_env_assert_file_exists:TEST_PATH');
        $this->assertSame(self::$tmpTestExistingAbsFilepath, $processedPath);
    }

    #[RunInSeparateProcess]
    public function testNonExistingFileThrowsFileNonExistentEnvProcessorException()
    {
        $_ENV['TEST_PATH'] = self::$tmpTestNonExistingAbsFilepath;

        $this->expectException(FileNonExistentEnvProcessorException::class);
        $this->expectExceptionMessage(\sprintf(
            'File must exist, got "%s" does not exist',
            self::$tmpTestNonExistingAbsFilepath,
        ));
        (self::$getenv)('grinway_env_assert_file_exists:TEST_PATH');
    }
}
