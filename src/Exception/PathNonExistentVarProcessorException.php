<?php

namespace GrinWay\EnvProcessor\Exception;

/**
 * See docs
 * https://github.com/GrinWay/env-processor-bundle/blob/main/docs/reference.md#grinway_env_assert_path_exists-test
 *
 * @author Grigory Koblitskiy <grin180898@outlook.com>
 */
class PathNonExistentVarProcessorException extends AbstractEnvProcessorException
{
    protected function doGetMessage(mixed $code, mixed $previous): string
    {
        return 'exception.path_must_exist';
    }
}
