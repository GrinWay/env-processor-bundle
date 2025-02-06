<?php

namespace GrinWay\EnvProcessor\Exception;

class PathNonExistentVarProcessorException extends AbstractEnvProcessorException
{
    protected function doGetMessage(mixed $code, mixed $previous): string
    {
        return 'exception.path_must_exist';
    }
}
