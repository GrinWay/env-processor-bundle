<?php

namespace GrinWay\EnvProcessor\Tests\Unit;

use GrinWay\EnvProcessor\EnvProcessor\AssertPathExistsVarProcessor;
use GrinWay\EnvProcessor\Tests\AbstractEnvProcessorTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;

#[CoversClass(AssertPathExistsVarProcessor::class)]
class RTrimVarProcessorTest extends AbstractEnvProcessorTestCase
{
    #[RunInSeparateProcess]
    public function testStringWasRightTrimmedFromCharsetDefindedInTheFirstParameterOfEnvProcessor()
    {
        $_ENV['TEST_STRING'] = $passedPath = \sprintf('%1$sTEST%1$s', self::$charset);

        $processedPath = (self::$getenv)('grinway_env_r_trim:grinway_env.charset:TEST_STRING');
        $this->assertSame(
            \rtrim($passedPath, self::$charset),
            $processedPath,
        );
    }

    #[RunInSeparateProcess]
    public function testStringWasNotChangedWhenFirstParameterOfEnvProcessorWasNotPassed()
    {
        $_ENV['TEST_STRING'] = $passedPath = \sprintf('%1$sTEST%1$s', self::$charset);

        $processedPath = (self::$getenv)('grinway_env_r_trim::TEST_STRING');
        $this->assertSame(
            $passedPath,
            $processedPath,
        );
    }
}
