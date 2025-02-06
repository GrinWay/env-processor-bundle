<?php

namespace GrinWay\EnvProcessor\EnvProcessor;

use GrinWay\EnvProcessor\GrinWayEnvProcessorBundle;

/**
 * See explanations in the env-processors.md
 *
 * @author Grigory Koblitskiy <grin180898@outlook.com>
 */
class RTrimVarProcessor extends AbstractWithParamsVarProcessor
{
    public const COUNT_OF_PARAMETERS = 1;

    public const ENV_PROCESSOR_NAME = 'r_trim';

    public const ENV_PROCESSOR_TYPES = [
        'string',
        'float',
        'int',
    ];

    protected static function getCountOfParameters(): int
    {
        return self::COUNT_OF_PARAMETERS;
    }

    protected static function getEnvProcessorPrefix(): string
    {
        return GrinWayEnvProcessorBundle::ENV_PROCESSOR_PREFIX;
    }

    protected static function getEnvProcessorName(): string
    {
        return self::ENV_PROCESSOR_NAME;
    }

    protected static function getEnvProcessorTypes(): array|string
    {
        return self::ENV_PROCESSOR_TYPES;
    }

    protected function get(
        string   $prefix,
        string   $nameWithoutParameters,
        \Closure $getEnv,
        array    $parameters,
    ): mixed
    {
        $val = $getEnv($nameWithoutParameters);

        // get rid of null values
        $parameters = \array_filter($parameters, static fn($el) => null !== $el);

        return (\count($parameters) > 0)
            ? \rtrim($val, $parameters[0])
            : \rtrim($val);
    }
}
