<?php

namespace GrinWay\EnvProcessor\Tests\Unit;

use GrinWay\EnvProcessor\EnvProcessor\AssertPathExistsVarProcessor;
use GrinWay\EnvProcessor\Exception\PathNonExistentVarProcessorException;
use GrinWay\EnvProcessor\Tests\AbstractEnvProcessorTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;

#[CoversClass(AssertPathExistsVarProcessor::class)]
class AssertPathExistsVarProcessorTest extends AbstractEnvProcessorTestCase
{
    #[RunInSeparateProcess]
    public function testExistingFilepathDoesNotThrow()
    {
        $_ENV['TEST_PATH'] = $passedPath = self::$tmpTestExistingAbsFilepath;

        $processedPath = (self::$getenv)('grinway_env_assert_path_exists:TEST_PATH');
        $this->assertSame($passedPath, $processedPath);
    }

    #[RunInSeparateProcess]
    public function testExistingDirectoryDoesNotThrow()
    {
        $_ENV['TEST_PATH'] = $passedPath = \dirname(self::$tmpTestExistingAbsFilepath);

        $processedPath = (self::$getenv)('grinway_env_assert_path_exists:TEST_PATH');
        $this->assertSame($passedPath, $processedPath);
    }

    #[RunInSeparateProcess]
    public function testNonExistentFilepathThrowsPathNonExistentVarProcessorException()
    {
        $_ENV['TEST_PATH'] = $passedPath = self::$tmpTestNonExistingAbsFilepath;

        $this->expectException(PathNonExistentVarProcessorException::class);
        $this->expectExceptionMessage(\sprintf(
            'Path must exist, got "%s" does not exist',
            $passedPath,
        ));
        $processedPath = (self::$getenv)('grinway_env_assert_path_exists:TEST_PATH');
    }
}
