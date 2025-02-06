<?php

namespace GrinWay\EnvProcessor\Tests\Unit;

use GrinWay\EnvProcessor\EnvProcessor\AssertAbsolutePathVarProcessor;
use GrinWay\EnvProcessor\Exception\NotAbsolutePathEnvProcessorException;
use GrinWay\EnvProcessor\Tests\AbstractEnvProcessorTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;

#[CoversClass(AssertAbsolutePathVarProcessor::class)]
class AssertAbsolutePathVarProcessorTest extends AbstractEnvProcessorTestCase
{
    #[RunInSeparateProcess]
    public function testAbsolutePathWindowsStyleDoesNotThrow()
    {
        $_ENV['TEST_PATH'] = $passedPath = 'C:/windows';

        $processedPath = (self::$getenv)('grinway_env_assert_absolute_path:TEST_PATH');
        $this->assertSame($passedPath, $processedPath);
    }

    #[RunInSeparateProcess]
    public function testAbsolutePathUnixStyleDoesNotThrow()
    {
        $_ENV['TEST_PATH'] = $passedPath = '/unix';

        $processedPath = (self::$getenv)('grinway_env_assert_absolute_path:TEST_PATH');
        $this->assertSame($passedPath, $processedPath);
    }

    #[RunInSeparateProcess]
    public function testRelativePathDotStyleThrowsNotAbsolutePathEnvProcessorException()
    {
        $_ENV['TEST_PATH'] = $passedPath = './dot-style';

        $this->expectException(NotAbsolutePathEnvProcessorException::class);
        $this->expectExceptionMessage('Must be absolute, got "./dot-style"');
        (self::$getenv)('grinway_env_assert_absolute_path:TEST_PATH');
    }

    #[RunInSeparateProcess]
    public function testRelativePathDotLessStyleThrowsNotAbsolutePathEnvProcessorException()
    {
        $_ENV['TEST_PATH'] = $passedPath = 'dot-less-style';

        $this->expectException(NotAbsolutePathEnvProcessorException::class);
        $this->expectExceptionMessage('Must be absolute, got "dot-less-style"');
        (self::$getenv)('grinway_env_assert_absolute_path:TEST_PATH');
    }
}
