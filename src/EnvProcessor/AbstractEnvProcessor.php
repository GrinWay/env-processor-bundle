<?php

namespace GrinWay\EnvProcessor\EnvProcessor;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\Attribute\AutowireLocator;
use Symfony\Component\DependencyInjection\EnvVarProcessorInterface;
use Symfony\Component\DependencyInjection\ServiceLocator;

/**
 * Can be used to create your custom symfony env processors
 * https://symfony.com/doc/current/configuration/env_var_processors.html#custom-environment-variable-processors
 *
 * @author Grigory Koblitskiy <grin180898@outlook.com>
 */
abstract class AbstractEnvProcessor implements EnvVarProcessorInterface
{
    public function __construct(
        #[AutowireLocator([
            't' => new Autowire('@.grinway_env_processor.translator'),
        ])]
        protected readonly ServiceLocator $serviceLocator,
    )
    {
    }

    /**
     * @reutrn string env processor prefix
     */
    abstract protected static function getEnvProcessorPrefix(): string;
//GrinWayEnvProcessorBundle::ENV_PROCESSOR_PREFIX

    /**
     * @reutrn string Env processor name without a prefix
     */
    abstract protected static function getEnvProcessorName(): string;

    /**
     * @return array [
     *  'string',
     *  'bool',
     * ... what \get_debug_type(...) returns
     * ]
     *
     * Also can return a single type
     */
    abstract protected static function getEnvProcessorTypes(): array|string;

    /**
     * @return array [
     *     'NAME_ENV_PROCESSOR' => 'ALL|ITS|TYPES',
     * ]
     */
    public static function getProvidedTypes(): array
    {
        $types = static::getEnvProcessorTypes();

        if (!\is_array($types)) {
            $types = [$types];
        }

        return [
            static::doGetEnvProcessorName() => \implode('|', $types),
        ];
    }

    /**
     * @internal
     */
    private static function doGetEnvProcessorName(): string
    {
        return static::getEnvProcessorPrefix() . static::getEnvProcessorName();
    }

    /**
     * Helper
     */
    protected function trans(
        string $message,
        array  $parameters = [],
    ): string
    {
        return $this->serviceLocator->get('t')->trans(
            $message,
            parameters: $parameters,
        );
    }
}
