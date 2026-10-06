<?php

declare(strict_types=1);

namespace App\Ex02Enums;

/**
 * Exercício 02 — Enums (backed enums)
 *
 * Conceitos: enum com valor string, métodos em enum, self, cases(), match.
 * Rode: vendor/bin/phpunit --filter Enums
 */
enum StatusPedido: string
{
    case Pendente = 'pendente';
    case Pago = 'pago';
    case Enviado = 'enviado';
    case Cancelado = 'cancelado';

    /**
     * Texto para exibir ao usuário (use match($this)):
     *   Pendente  => 'Aguardando pagamento'
     *   Pago      => 'Pago'
     *   Enviado   => 'Em transporte'
     *   Cancelado => 'Cancelado'
     */
    public function rotulo(): string
    {
        throw new \LogicException('TODO');
    }

    /**
     * Regras de transição:
     *   Pendente -> Pago ou Cancelado
     *   Pago     -> Enviado ou Cancelado
     *   Enviado e Cancelado são finais (não vão para lugar nenhum)
     */
    public function podeTransicionarPara(self $novo): bool
    {
        throw new \LogicException('TODO');
    }

    /**
     * Todos os status exceto Cancelado, na ordem de declaração e com índices 0, 1, 2...
     * Dica: self::cases(), array_filter, array_values.
     *
     * @return list<self>
     */
    public static function ativos(): array
    {
        throw new \LogicException('TODO');
    }
}
