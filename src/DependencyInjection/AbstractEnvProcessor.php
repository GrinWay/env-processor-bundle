<?php

namespace GrinWay\EnvProcessor\DependencyInjection;

use Symfony\Component\Filesystem\Path;
use GrinWay\EnvProcessor\Contracts\GrinWayEnvProcessorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

abstract class AbstractEnvProcessor implements GrinWayEnvProcessorInterface
{
    private const ENV_PROCESSOR_PREFIX = 'grin_way_env_';

    public function __construct(
        protected readonly TranslatorInterface $t,
    ) {
    }

    //###> CHANGE ME ###

    /* You can already use this env processor name

    // Uses with PREFIX!
    public const ENV_PROCESSOR_NAME = '!CHANGE_ME!';

    public const ENV_PROCESSOR_TYPES = [
        '!CHANGE_ME!',
    ]; // or JUST STRING
    */

    //###< CHANGE ME ###


    //###> REALIZED ABSTRACT ###

    /*
        [
            'NAME_ENV_PROCESSOR' => 'ALL|ITS|TYPES',
        ]
    */
    public static function getProvidedTypes(): array
    {
        $types = static::ENV_PROCESSOR_TYPES;

        if (!\is_array($types)) {
            $types = [$types];
        }

        return [
            static::getEnvProcessorName() => \implode('|', $types),
        ];
    }

    //###< REALIZED ABSTRACT ###


    //###> PUBLIC API ###

    public static function getEnvProcessorName(): string
    {
        return self::ENV_PROCESSOR_PREFIX . static::ENV_PROCESSOR_NAME;
    }

    //###< PUBLIC API ###


    //###> API ###

    protected function trans(
        string $message,
        array $parameters = [],
    ): string {
        return $this->t->trans(
            $message,
            parameters: $parameters,
        );
    }

    //###< API ###
}
