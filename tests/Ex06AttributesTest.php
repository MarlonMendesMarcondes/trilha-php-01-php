<?php

declare(strict_types=1);

namespace Tests;

use App\Ex06Attributes\Obrigatorio;
use App\Ex06Attributes\Tamanho;
use App\Ex06Attributes\Validador;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

final class CadastroDto
{
    #[Obrigatorio]
    public ?string $nome = null;

    #[Obrigatorio('E-mail é obrigatório')]
    #[Tamanho(max: 20)]
    public ?string $email = null;

    #[Tamanho(min: 3, max: 5)]
    public ?string $apelido = null;
}

final class Ex06AttributesTest extends TestCase
{
    #[TestDox('objeto válido não tem erros')]
    public function testValido(): void
    {
        $dto = new CadastroDto();
        $dto->nome = 'Ada';
        $dto->email = 'ada@example.com';
        $dto->apelido = 'ada';

        $this->assertSame([], (new Validador())->validar($dto));
    }

    #[TestDox('Obrigatorio usa a mensagem padrão ou a personalizada; Tamanho ignora valor vazio')]
    public function testObrigatorio(): void
    {
        $dto = new CadastroDto();
        $dto->email = '';

        $this->assertSame(
            [
                'nome' => ['Campo obrigatório'],
                'email' => ['E-mail é obrigatório'],
            ],
            (new Validador())->validar($dto),
        );
    }

    #[TestDox('Tamanho valida min e max contando caracteres multibyte')]
    public function testTamanho(): void
    {
        $dto = new CadastroDto();
        $dto->nome = 'Ada';
        $dto->email = 'um-email-bem-comprido@example.com';
        $dto->apelido = 'jó';

        $this->assertSame(
            [
                'email' => ['Deve ter entre 0 e 20 caracteres'],
                'apelido' => ['Deve ter entre 3 e 5 caracteres'],
            ],
            (new Validador())->validar($dto),
        );
    }
}
