<?php

namespace GrinWay\EnvProcessor\EnvProcessor;

use GrinWay\EnvProcessor\Exception\FileNonExistentEnvProcessorException;
use GrinWay\EnvProcessor\GrinWayEnvProcessorBundle;

/**
 * See explanations in the env-processors.md
 *
 * @author Grigory Koblitskiy <grin180898@outlook.com>
 */
class AssertFileExistsVarProcessor extends AbstractEnvProcessor
{
    public const ENV_PROCESSOR_NAME = 'assert_file_exists';

    public const ENV_PROCESSOR_TYPES = 'string';

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

    public function getEnv(
        string   $prefix,
        string   $name,
        \Closure $getEnv,
    ): mixed
    {
        $path = $getEnv($name);

        if (!\file_exists($path) || !\is_file($path)) {
            throw new FileNonExistentEnvProcessorException(
                $this->serviceLocator->get('t'),
                [
                    '{path}' => $path,
                ],
            );
        }

        return $path;
    }
}
