<?php

declare(strict_types=1);

namespace App\Ex06Attributes;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
final readonly class Obrigatorio
{
    public function __construct(public string $mensagem = 'Campo obrigatório')
    {
    }
}
