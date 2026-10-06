<?php

declare(strict_types=1);

namespace App\Ex04Closures;

/**
 * Exercício 04 — Closures e funções de array
 *
 * Conceitos: array_map/filter/reduce, usort + <=>, arrow functions (fn),
 * first-class callables (strlen(...)), retorno de \Closure, composição.
 * Desafio extra: resolva sem nenhum foreach.
 * Rode: vendor/bin/phpunit --filter Closures
 *
 * @phpstan-type Produto array{nome: string, preco: float, categoria: string}
 */
final class Colecoes
{
    /**
     * Nomes dos produtos ordenados do mais barato ao mais caro.
     *
     * @param list<Produto> $produtos
     * @return list<string>
     */
    public static function nomesOrdenadosPorPreco(array $produtos): array
    {
        throw new \LogicException('TODO');
    }

    /**
     * Soma dos preços agrupada por categoria: ['livros' => 80.0, 'jogos' => 200.0]
     * A ordem das chaves segue a primeira aparição de cada categoria. Dica: array_reduce.
     *
     * @param list<Produto> $produtos
     * @return array<string, float>
     */
    public static function totalPorCategoria(array $produtos): array
    {
        throw new \LogicException('TODO');
    }

    /**
     * Retorna uma função que multiplica seu argumento por $fator.
     * Ex.: Colecoes::multiplicador(3)(5) === 15
     */
    public static function multiplicador(int $fator): \Closure
    {
        throw new \LogicException('TODO');
    }

    /**
     * Comprimento de cada palavra, usando um first-class callable: mb_strlen(...)
     *
     * @param list<string> $palavras
     * @return list<int>
     */
    public static function comprimentos(array $palavras): array
    {
        throw new \LogicException('TODO');
    }

    /**
     * Compõe funções da esquerda para a direita:
     * pipeline(f, g, h)($x) === h(g(f($x)))
     * Sem funções, devolve a função identidade.
     */
    public static function pipeline(callable ...$funcoes): \Closure
    {
        throw new \LogicException('TODO');
    }
}
