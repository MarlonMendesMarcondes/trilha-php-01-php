<?php

declare(strict_types=1);

namespace Tests;

use App\Ex03Readonly\Dinheiro;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

final class Ex03ReadonlyTest extends TestCase
{
    #[TestDox('propriedades readonly não podem ser alteradas (já funciona graças ao readonly)')]
    public function testImutavel(): void
    {
        $d = new Dinheiro(100);
        $this->expectException(\Error::class);
        $d->centavos = 200;
    }

    #[TestDox('rejeita centavos negativos')]
    public function testNegativo(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Dinheiro(-1);
    }

    #[TestDox('rejeita código de moeda inválido')]
    public function testMoedaInvalida(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Dinheiro(100, 'real');
    }

    #[TestDox('deReais converte para centavos sem erro de arredondamento')]
    public function testDeReais(): void
    {
        $this->assertSame(1050, Dinheiro::deReais('10.50')->centavos);
        $this->assertSame(30, Dinheiro::deReais(0.1 + 0.2)->centavos);
        $this->assertSame('USD', Dinheiro::deReais(1, 'USD')->moeda);
    }

    #[TestDox('somar devolve uma nova instância e não altera as originais')]
    public function testSomar(): void
    {
        $a = new Dinheiro(1000);
        $b = new Dinheiro(250);
        $c = $a->somar($b);

        $this->assertSame(1250, $c->centavos);
        $this->assertSame(1000, $a->centavos);
        $this->assertNotSame($a, $c);
    }

    #[TestDox('somar moedas diferentes lança exceção')]
    public function testSomarMoedasDiferentes(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        (new Dinheiro(100, 'BRL'))->somar(new Dinheiro(100, 'USD'));
    }

    #[TestDox('formatar usa padrão brasileiro')]
    public function testFormatar(): void
    {
        $this->assertSame('BRL 1.234,56', (new Dinheiro(123456))->formatar());
        $this->assertSame('USD 0,05', (new Dinheiro(5, 'USD'))->formatar());
    }
}
