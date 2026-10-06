<?php

declare(strict_types=1);

namespace App\Ex01Tipos;

/**
 * Exercício 01 — Sistema de tipos
 *
 * Conceitos: union types, nullable, never, match, named arguments, strict_types.
 *
 * Substitua cada `throw new \LogicException('TODO')` pela implementação.
 * Rode: vendor/bin/phpunit --filter Tipos
 */
final class Tipos
{
    /**
     * Soma dois números. Se ambos forem int, o resultado é int; se algum for float, é float.
     * Ex.: somar(1, 2) === 3; somar(1.5, 2) === 3.5
     */
    public static function somar(int|float $a, int|float $b): int|float
    {
        throw new \LogicException('TODO');
    }

    /**
     * Retorna a média dos números, ou null se a lista estiver vazia.
     * Ex.: media([1, 2, 3]) === 2.0; media([]) === null
     *
     * @param list<int|float> $numeros
     */
    public static function media(array $numeros): ?float
    {
        throw new \LogicException('TODO');
    }

    /**
     * Use `match (true)` para classificar:
     *   0..9    => 'pequeno'
     *   10..99  => 'médio'
     *   >= 100  => 'grande'
     *   negativo => lança \InvalidArgumentException
     */
    public static function classificar(int $n): string
    {
        throw new \LogicException('TODO');
    }

    /**
     * Sempre lança \RuntimeException com a mensagem recebida.
     * Repare no tipo de retorno `never`: a função nunca retorna normalmente.
     */
    public static function falhar(string $mensagem): never
    {
        throw new \LogicException('TODO');
    }

    /**
     * Junta primeiro e último nome com o separador; se $maiusculas, tudo em maiúsculas (use mb_strtoupper).
     * Os testes chamam com named arguments: formatarNome(primeiro: 'ada', ultimo: 'lovelace', separador: '_')
     */
    public static function formatarNome(
        string $primeiro,
        string $ultimo,
        bool $maiusculas = false,
        string $separador = ' ',
    ): string {
        throw new \LogicException('TODO');
    }
}
