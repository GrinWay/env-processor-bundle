<?php

namespace GrinWay\EnvProcessor\Exception;

/**
 * See docs
 * https://github.com/GrinWay/env-processor-bundle/blob/main/docs/reference.md#grinway_env_assert_absolute_path-test
 *
 * @author Grigory Koblitskiy <grin180898@outlook.com>
 */
class NotAbsolutePathEnvProcessorException extends AbstractEnvProcessorException
{
    protected function doGetMessage(mixed $code, mixed $previous): string
    {
        return 'exception.must_be_absolute';
    }
}
