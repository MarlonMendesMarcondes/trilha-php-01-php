<?php

declare(strict_types=1);

namespace App\Ex05PropertyHooks;

/**
 * Exercício 05 — Property hooks e visibilidade assimétrica (PHP 8.4+)
 *
 * Esta classe "funciona", mas está do jeito antigo. Reescreva usando:
 *
 * 1. `$email` com hook `set` que faz trim + minúsculas e lança \InvalidArgumentException
 *    se não for válido (filter_var(..., FILTER_VALIDATE_EMAIL)).
 * 2. `$email` com visibilidade assimétrica `public private(set)`: lê de fora, só altera por dentro.
 * 3. `$nomeCompleto` como propriedade VIRTUAL com hook `get` (sem armazenar nada): "Nome Sobrenome".
 * 4. Mantenha o método alterarEmail(): por ser interno, ele pode atribuir $this->email (e o hook roda).
 *
 * Sintaxe de referência:
 *   public private(set) string $x {
 *       set(string $valor) { $this->x = ...; }
 *   }
 *   public string $y { get => ...; }
 *
 * Rode: vendor/bin/phpunit --filter PropertyHooks
 */
final class Usuario
{
    public string $email;

    public function __construct(
        public string $nome,
        public string $sobrenome,
        string $email,
    ) {
        $this->email = $email;
    }

    public function alterarEmail(string $novo): void
    {
        $this->email = $novo;
    }
}
