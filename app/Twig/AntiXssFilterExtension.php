<?php

declare(strict_types=1);

namespace app\Twig;

use Stringable;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use voku\helper\AntiXSS;

final class AntiXssFilterExtension extends AbstractExtension
{
    public function __construct(
        private readonly AntiXSS $antiXSS
    ) {
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('anti_xss', [$this, 'clean']),
        ];
    }

    public function clean(mixed $value): string
    {
        if ($value === null) {
            return '';
        }

        if (!\is_scalar($value) && !$value instanceof Stringable) {
            return '';
        }

        return $this->antiXSS->xss_clean((string) $value);
    }
}
