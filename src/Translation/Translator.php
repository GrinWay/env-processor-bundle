<?php

namespace GrinWay\EnvProcessor\Translation;

use GrinWay\EnvProcessor\GrinWayEnvProcessorBundle;
use Symfony\Contracts\Translation\TranslatorInterface;

class Translator implements TranslatorInterface
{
    public function __construct(
        private readonly TranslatorInterface $t,
    )
    {
    }

    public function trans(string $id, array $parameters = [], ?string $domain = null, ?string $locale = null): string
    {
        return $this->t->trans(
            id: $id,
            parameters: $parameters,
            domain: GrinWayEnvProcessorBundle::EXTENSION_ALIAS,
            locale: $locale,
        );
    }

    public function getLocale(): string
    {
        return $this->t->getLocale();
    }
}
