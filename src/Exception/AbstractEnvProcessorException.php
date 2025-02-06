<?php

namespace GrinWay\EnvProcessor\Exception;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @author Grigory Koblitskiy <grin180898@outlook.com>
 */
abstract class AbstractEnvProcessorException extends \Exception
{
    abstract protected function doGetMessage(mixed $code, mixed $previous): string;

    public function __construct(
        protected readonly TranslatorInterface                                       $translator,
        protected readonly array                                                     $parameters = [],
        #[LanguageLevelTypeAware(['8.0' => 'int'], default: '')]                     $code = 0,
        #[LanguageLevelTypeAware(['8.0' => 'Throwable|null'], default: 'Throwable')] $previous = null
    )
    {
        $message = $this->doGetMessage($code, $previous);

        parent::__construct(
            message: $this->translator->trans($message, $this->parameters),
            code: $code,
            previous: $previous,
        );
    }
}
