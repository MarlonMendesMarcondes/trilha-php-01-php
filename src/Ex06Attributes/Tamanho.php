<?php

declare(strict_types=1);

namespace App\Ex06Attributes;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
final readonly class Tamanho
{
    public function __construct(
        public int $min = 0,
        public int $max = PHP_INT_MAX,
    ) {
    }
}
