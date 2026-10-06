<?php

declare(strict_types=1);

namespace Tests;

use App\Ex05PropertyHooks\Usuario;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

final class Ex05PropertyHooksTest extends TestCase
{
    #[TestDox('hook set normaliza o e-mail')]
    public function testNormaliza(): void
    {
        $u = new Usuario('Ada', 'Lovelace', '  ADA@Example.COM ');
        $this->assertSame('ada@example.com', $u->email);
    }

    #[TestDox('hook set rejeita e-mail inválido')]
    public function testEmailInvalido(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Usuario('Ada', 'Lovelace', 'nao-e-email');
    }

    #[TestDox('private(set): não dá para alterar o e-mail de fora da classe')]
    public function testPrivateSet(): void
    {
        $u = new Usuario('Ada', 'Lovelace', 'ada@example.com');
        $this->expectException(\Error::class);
        $u->email = 'outro@example.com';
    }

    #[TestDox('alterarEmail passa pelo hook')]
    public function testAlterarEmail(): void
    {
        $u = new Usuario('Ada', 'Lovelace', 'ada@example.com');
        $u->alterarEmail(' NOVO@Example.com');
        $this->assertSame('novo@example.com', $u->email);
    }

    #[TestDox('nomeCompleto é uma propriedade virtual que reflete mudanças')]
    public function testNomeCompleto(): void
    {
        $u = new Usuario('Ada', 'Lovelace', 'ada@example.com');
        $this->assertSame('Ada Lovelace', $u->nomeCompleto);

        $u->sobrenome = 'King';
        $this->assertSame('Ada King', $u->nomeCompleto);

        $this->assertTrue((new \ReflectionProperty(Usuario::class, 'nomeCompleto'))->isVirtual());
    }
}
