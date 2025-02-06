<?php

namespace GrinWay\EnvProcessor\Tests\Unit;

use GrinWay\EnvProcessor\EnvProcessor\HttpsToStringEnvVarProcessor;
use GrinWay\EnvProcessor\Tests\AbstractEnvProcessorTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;

#[CoversClass(HttpsToStringEnvVarProcessor::class)]
class HttpsToStringEnvVarProcessorTest extends AbstractEnvProcessorTestCase
{
    #[RunInSeparateProcess]
    public function testWhenHttpsNativeEnvEqualsToOnStringProtocolEqualsHttpsString()
    {
        $_ENV['HTTPS'] = 'on';

        $httpsString = (self::$getenv)('grinway_env_http_or_https:default::HTTPS');
        $this->assertSame('https', $httpsString);
    }

    #[RunInSeparateProcess]
    public function testWhenHttpsNativeEnvNotEqualToOnStringProtocolEqualsHttpString()
    {
        $_ENV['HTTPS'] = 'off';
        $protocolString = (self::$getenv)('grinway_env_http_or_https:default::HTTPS');

        $this->assertSame('http', $protocolString);
    }

    #[RunInSeparateProcess]
    public function testWhenHttpsNativeEnvNonExistentProtocolEqualsHttpString()
    {
        unset($_ENV['HTTPS']);
        $protocolString = (self::$getenv)('grinway_env_http_or_https:default::HTTPS');

        $this->assertSame('http', $protocolString);
    }
}
