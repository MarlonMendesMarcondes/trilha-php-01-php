<?php

declare(strict_types=1);

namespace Tests;

use App\Ex04Closures\Colecoes;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

final class Ex04ClosuresTest extends TestCase
{
    private const PRODUTOS = [
        ['nome' => 'Clean Code', 'preco' => 50.0, 'categoria' => 'livros'],
        ['nome' => 'Zelda', 'preco' => 300.0, 'categoria' => 'jogos'],
        ['nome' => 'DDD', 'preco' => 30.0, 'categoria' => 'livros'],
        ['nome' => 'Tetris', 'preco' => 10.0, 'categoria' => 'jogos'],
    ];

    #[TestDox('nomesOrdenadosPorPreco ordena do mais barato ao mais caro')]
    public function testOrdenar(): void
    {
        $this->assertSame(
            ['Tetris', 'DDD', 'Clean Code', 'Zelda'],
            Colecoes::nomesOrdenadosPorPreco(self::PRODUTOS),
        );
    }

    #[TestDox('totalPorCategoria agrupa e soma')]
    public function testTotalPorCategoria(): void
    {
        $this->assertSame(
            ['livros' => 80.0, 'jogos' => 310.0],
            Colecoes::totalPorCategoria(self::PRODUTOS),
        );
        $this->assertSame([], Colecoes::totalPorCategoria([]));
    }

    #[TestDox('multiplicador retorna uma closure que captura o fator')]
    public function testMultiplicador(): void
    {
        $triplo = Colecoes::multiplicador(3);
        $this->assertInstanceOf(\Closure::class, $triplo);
        $this->assertSame(15, $triplo(5));
        $this->assertSame([2, 4, 6], array_map(Colecoes::multiplicador(2), [1, 2, 3]));
    }

    #[TestDox('comprimentos conta caracteres multibyte corretamente')]
    public function testComprimentos(): void
    {
        $this->assertSame([3, 4, 5], Colecoes::comprimentos(['php', 'ação', 'olá!!']));
    }

    #[TestDox('pipeline compõe da esquerda para a direita')]
    public function testPipeline(): void
    {
        $f = Colecoes::pipeline(
            trim(...),
            strtoupper(...),
            fn (string $s): string => $s . '!',
        );
        $this->assertSame('OI!', $f('  oi  '));
        $this->assertSame(42, Colecoes::pipeline()(42));
    }
}
