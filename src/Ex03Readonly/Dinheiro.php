<?php

declare(strict_types=1);

namespace App\Ex03Readonly;

/**
 * Exercício 03 — Value Object imutável
 *
 * Conceitos: readonly class, constructor property promotion, named constructors, imutabilidade.
 * Dinheiro guarda CENTAVOS como int (nunca use float para dinheiro).
 * Rode: vendor/bin/phpunit --filter Readonly
 */
final readonly class Dinheiro
{
    public function __construct(
        public int $centavos,
        public string $moeda = 'BRL',
    ) {
        // TODO: lance \InvalidArgumentException se:
        //   - $centavos for negativo
        //   - $moeda não for exatamente 3 letras maiúsculas (ex.: 'BRL', 'USD'). Dica: preg_match('/^[A-Z]{3}$/', ...)
    }

    /**
     * Construtor nomeado a partir de reais: deReais('10.50') => 1050 centavos.
     * Dica: (int) round((float) $valor * 100)
     */
    public static function deReais(float|string $valor, string $moeda = 'BRL'): self
    {
        throw new \LogicException('TODO');
    }

    /**
     * Retorna um NOVO Dinheiro com a soma. Moedas diferentes => \InvalidArgumentException.
     */
    public function somar(self $outro): self
    {
        throw new \LogicException('TODO');
    }

    /**
     * Formato brasileiro: 'BRL 1.234,56'. Dica: number_format($valor, 2, ',', '.')
     */
    public function formatar(): string
    {
        throw new \LogicException('TODO');
    }
}
