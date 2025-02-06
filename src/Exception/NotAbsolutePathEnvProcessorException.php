<?php

namespace GrinWay\EnvProcessor\Exception;

class NotAbsolutePathEnvProcessorException extends AbstractEnvProcessorException
{
    protected function doGetMessage(mixed $code, mixed $previous): string
    {
        return 'exception.must_be_absolute';
    }
}
