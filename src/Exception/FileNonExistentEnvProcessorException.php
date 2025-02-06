<?php

namespace GrinWay\EnvProcessor\Exception;

/**
 * See docs
 * https://github.com/GrinWay/env-processor-bundle/blob/main/docs/reference.md#grinway_env_assert_file_exists-test
 *
 * @author Grigory Koblitskiy <grin180898@outlook.com>
 */
class FileNonExistentEnvProcessorException extends AbstractEnvProcessorException
{
    protected function doGetMessage(mixed $code, mixed $previous): string
    {
        return 'exception.file_must_exist';
    }
}
