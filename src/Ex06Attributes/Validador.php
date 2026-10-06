<?php

declare(strict_types=1);

namespace App\Ex06Attributes;

/**
 * Exercício 06 — Attributes + Reflection (é assim que #[Assert\NotBlank] do Symfony funciona por baixo)
 *
 * Os attributes #[Obrigatorio] e #[Tamanho] já estão prontos. Implemente validar():
 *
 * - Percorra as propriedades do objeto com new \ReflectionObject($objeto)->getProperties().
 * - Para cada propriedade, leia os attributes com $prop->getAttributes() e instancie com ->newInstance().
 * - #[Obrigatorio]: valor null ou '' gera o erro $attr->mensagem.
 * - #[Tamanho]: só é checado se o valor for string não vazia; se mb_strlen estiver fora de [min, max],
 *   gera o erro "Deve ter entre {min} e {max} caracteres".
 * - Ignore attributes que não sejam desses dois tipos.
 *
 * Retorno: ['nomeDaPropriedade' => ['erro 1', 'erro 2'], ...] — só propriedades com erro, na ordem de declaração.
 * Objeto válido => [].
 *
 * Rode: vendor/bin/phpunit --filter Attributes
 */
final class Validador
{
    /**
     * @return array<string, list<string>>
     */
    public function validar(object $objeto): array
    {
        throw new \LogicException('TODO');
    }
}
