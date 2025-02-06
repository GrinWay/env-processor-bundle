<?php

namespace GrinWay\EnvProcessor\Tests\Unit;

use GrinWay\EnvProcessor\EnvProcessor\NormalizePathEnvVarProcessor;
use GrinWay\EnvProcessor\Tests\AbstractEnvProcessorTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;

#[CoversClass(NormalizePathEnvVarProcessor::class)]
class NormalizePathEnvVarProcessorTest extends AbstractEnvProcessorTestCase
{
    #[RunInSeparateProcess]
    public function testPathWithBackSlashesWithoutEndSlashNormalizedToForwardSlashesWithoutEndSlash()
    {
        $_ENV['TEST_PATH'] = $passedPath = 'C:\\path\\to\\somewhere';

        $processedPath = (self::$getenv)('grinway_env_normalize_path:TEST_PATH');
        $this->assertSame('C:/path/to/somewhere', $processedPath);
    }

    #[RunInSeparateProcess]
    public function testPathWithBackSlashesWithEndSlashNormalizedToForwardSlashesWithEndSlash()
    {
        $_ENV['TEST_PATH'] = $passedPath = 'path\\to\\somewhere\\';

        $processedPath = (self::$getenv)('grinway_env_normalize_path:TEST_PATH');
        $this->assertSame('path/to/somewhere/', $processedPath);
    }

    #[RunInSeparateProcess]
    public function testRelativeDotStylePathWithBackSlashesWithEndSlashNormalizedToForwardSlashesWithEndSlash()
    {
        $_ENV['TEST_PATH'] = $passedPath = '.\\path\\to\\somewhere\\';

        $processedPath = (self::$getenv)('grinway_env_normalize_path:TEST_PATH');
        $this->assertSame('./path/to/somewhere/', $processedPath);
    }
}
