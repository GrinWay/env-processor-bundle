<?php

namespace GrinWay\EnvProcessor\EnvProcessor;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\Attribute\AutowireLocator;
use Symfony\Component\DependencyInjection\ServiceLocator;

/**
 * Usage:
 * '%env(<THIS_ENV_PROCESSOR_NAME>:parameter1:ENV_PATH)%'
 * '%env(<THIS_ENV_PROCESSOR_NAME>:parameter1:parameter2:ENV_PATH)%'
 * '%env(<THIS_ENV_PROCESSOR_NAME>::parameter2:ENV_PATH)%' null, and parameter2
 * '%env(<THIS_ENV_PROCESSOR_NAME>::ENV_PATH)%' # default behaviour
 *
 * In your "get" method you will get an array of passed to the env processor parameters
 * Think about parameters like arguments to the method/function
 *
 * @author Grigory Koblitskiy <grin180898@outlook.com>
 */
abstract class AbstractWithParamsVarProcessor extends AbstractEnvProcessor
{
    public function __construct(
        #[AutowireLocator([
            't' => new Autowire('@.grinway_env_processor.translator'),
            'parameterBag' => new Autowire('@parameter_bag'),
        ])]
        ServiceLocator $serviceLocator,
    )
    {
        parent::__construct(
            serviceLocator: $serviceLocator,
        );
    }

    /**
     * How many parameters accept your env processor
     *
     * For instance 1 parameter:
     * %env(env_processor_name:first_parameter:ENV_VALUE)%
     *
     * For instance 2 parameters:
     * %env(env_processor_name:first_parameter:second_parameter:ENV_VALUE)%
     */
    abstract protected static function getCountOfParameters(): int;

    abstract protected function get(string $prefix, string $nameWithoutParameters, \Closure $getEnv, array $parameters): mixed;

    public function getEnv(
        string   $prefix,
        string   $name,
        \Closure $getEnv,
    ): mixed
    {
        $parameters = [];

        for ($i = 0; static::getCountOfParameters() > $i; ++$i) {
            $parameters[] = $this->getParameter(
                $prefix,
                $name,
            );

            $name = $this->getNameWithoutFirstEl($prefix, $name);
        }

        return $this->get(
            $prefix,
            $name,
            $getEnv,
            $parameters,
        );
    }

    /**
     * @internal
     */
    private function getNameWithoutFirstEl(
        string $prefix,
        string $name,
    ): string
    {
        //###> check parameter name
        $i = \strpos($name, ':');
        if (false === $i) {
            throw new \RuntimeException(\sprintf(
                'Invalid env "' . $prefix . ':%s": a key specifier should be provided.',
                $name,
            ));
        }

        return \substr($name, $i + 1);
    }

    /**
     * @internal
     */
    private function getParameter(
        string $prefix,
        string $name,
    ): mixed
    {
        $i = \strpos($name, ':');

        //###> get parameter
        $parameter = null;
        $parameterName = \substr($name, 0, $i);
        if (!empty($parameterName) && !$this->serviceLocator->get('parameterBag')->has($parameterName)) {
            throw new \RuntimeException(\sprintf(
                'Invalid env fallback in "' . $prefix . ':%s": parameter "%s" not found.',
                $name,
                $parameterName,
            ));
        }

        if (!empty($parameterName)) {
            $parameter = $this->serviceLocator->get('parameterBag')->get($parameterName);
        }

        return $parameter;
    }
}
