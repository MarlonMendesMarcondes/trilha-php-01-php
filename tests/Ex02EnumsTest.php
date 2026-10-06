<?php

declare(strict_types=1);

namespace Tests;

use App\Ex02Enums\StatusPedido;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

final class Ex02EnumsTest extends TestCase
{
    #[TestDox('from/tryFrom convertem string em enum (já funciona: vem de graça no backed enum)')]
    public function testFromTryFrom(): void
    {
        $this->assertSame(StatusPedido::Pago, StatusPedido::from('pago'));
        $this->assertNull(StatusPedido::tryFrom('inexistente'));
        $this->assertSame('enviado', StatusPedido::Enviado->value);
    }

    #[TestDox('rotulo devolve o texto de exibição')]
    public function testRotulo(): void
    {
        $this->assertSame('Aguardando pagamento', StatusPedido::Pendente->rotulo());
        $this->assertSame('Pago', StatusPedido::Pago->rotulo());
        $this->assertSame('Em transporte', StatusPedido::Enviado->rotulo());
        $this->assertSame('Cancelado', StatusPedido::Cancelado->rotulo());
    }

    #[TestDox('transições válidas')]
    public function testTransicoesValidas(): void
    {
        $this->assertTrue(StatusPedido::Pendente->podeTransicionarPara(StatusPedido::Pago));
        $this->assertTrue(StatusPedido::Pendente->podeTransicionarPara(StatusPedido::Cancelado));
        $this->assertTrue(StatusPedido::Pago->podeTransicionarPara(StatusPedido::Enviado));
        $this->assertTrue(StatusPedido::Pago->podeTransicionarPara(StatusPedido::Cancelado));
    }

    #[TestDox('transições inválidas')]
    public function testTransicoesInvalidas(): void
    {
        $this->assertFalse(StatusPedido::Pendente->podeTransicionarPara(StatusPedido::Enviado));
        $this->assertFalse(StatusPedido::Pago->podeTransicionarPara(StatusPedido::Pendente));
        $this->assertFalse(StatusPedido::Enviado->podeTransicionarPara(StatusPedido::Cancelado));
        $this->assertFalse(StatusPedido::Cancelado->podeTransicionarPara(StatusPedido::Pendente));
    }

    #[TestDox('ativos lista tudo menos Cancelado')]
    public function testAtivos(): void
    {
        $this->assertSame(
            [StatusPedido::Pendente, StatusPedido::Pago, StatusPedido::Enviado],
            StatusPedido::ativos(),
        );
    }
}
