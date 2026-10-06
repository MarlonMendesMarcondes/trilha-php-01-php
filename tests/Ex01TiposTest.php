<?php

declare(strict_types=1);

namespace Tests;

use App\Ex01Tipos\Tipos;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

final class Ex01TiposTest extends TestCase
{
    #[TestDox('somar preserva int quando os dois são int')]
    public function testSomarInteiros(): void
    {
        $this->assertSame(3, Tipos::somar(1, 2));
    }

    #[TestDox('somar retorna float quando algum é float')]
    public function testSomarFloat(): void
    {
        $this->assertSame(3.5, Tipos::somar(1.5, 2));
    }

    #[TestDox('strict_types: passar string para int|float lança TypeError')]
    public function testStrictTypes(): void
    {
        // Este teste já passa: é o declare(strict_types=1) DESTE arquivo que impede a conversão '1' -> 1.
        // Remova o declare lá em cima e veja o que acontece.
        $this->expectException(\TypeError::class);
        Tipos::somar('1', 2);
    }

    #[TestDox('media de lista vazia é null')]
    public function testMediaVazia(): void
    {
        $this->assertNull(Tipos::media([]));
    }

    #[TestDox('media calcula a média como float')]
    public function testMedia(): void
    {
        $this->assertSame(2.0, Tipos::media([1, 2, 3]));
        $this->assertSame(2.5, Tipos::media([2, 3]));
    }

    #[TestDox('classificar usa as faixas pequeno/médio/grande')]
    public function testClassificar(): void
    {
        $this->assertSame('pequeno', Tipos::classificar(0));
        $this->assertSame('pequeno', Tipos::classificar(9));
        $this->assertSame('médio', Tipos::classificar(10));
        $this->assertSame('médio', Tipos::classificar(99));
        $this->assertSame('grande', Tipos::classificar(100));
    }

    #[TestDox('classificar rejeita negativos')]
    public function testClassificarNegativo(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Tipos::classificar(-1);
    }

    #[TestDox('falhar lança RuntimeException com a mensagem')]
    public function testFalhar(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('deu ruim');
        Tipos::falhar('deu ruim');
    }

    #[TestDox('formatarNome aceita named arguments')]
    public function testFormatarNome(): void
    {
        $this->assertSame('ada lovelace', Tipos::formatarNome('ada', 'lovelace'));
        $this->assertSame('ada_lovelace', Tipos::formatarNome(primeiro: 'ada', ultimo: 'lovelace', separador: '_'));
        $this->assertSame('ÁUREA SILVA', Tipos::formatarNome(ultimo: 'silva', primeiro: 'áurea', maiusculas: true));
    }
}
