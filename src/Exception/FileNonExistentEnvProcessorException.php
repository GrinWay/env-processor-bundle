<?php

namespace GrinWay\EnvProcessor\Exception;

class FileNonExistentEnvProcessorException extends AbstractEnvProcessorException
{
    protected function doGetMessage(mixed $code, mixed $previous): string
    {
        return 'exception.file_must_exist';
    }
}
