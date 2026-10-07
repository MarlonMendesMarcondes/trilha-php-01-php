# Fase 1 — PHP moderno

Cada exercício tem o enunciado no arquivo em `src/` e os testes em `tests/`.
Substitua os `throw new \LogicException('TODO')` até os testes ficarem verdes.

## Como começar

**Opção A — no navegador, sem instalar nada (GitHub Codespaces):**
no topo deste repositório, clique em **Code → Codespaces → Create codespace**.
Em 1–2 minutos abre um VS Code com PHP, Composer e as dependências prontos.
Quando o terminal mostrar "Tudo certo!", é só começar.

**Opção B — no seu computador:** no Windows, siga o [INSTALACAO-WINDOWS.md](INSTALACAO-WINDOWS.md). Depois:

```bash
composer install                       # só na primeira vez
php bin/verificar-ambiente.php         # confere PHP, extensões e dependências
```

## Rodando os testes

```bash
composer test                          # roda tudo
composer test -- --filter Ex01         # roda só o exercício 1
```

## Ordem

| # | Exercício | Arquivo | Conceitos |
|---|-----------|---------|-----------|
| 01 | Tipos | `src/Ex01Tipos/Tipos.php` | union types, nullable, `never`, `match`, named args, `strict_types` |
| 02 | Enums | `src/Ex02Enums/StatusPedido.php` | backed enums, métodos em enum, `cases()` |
| 03 | Readonly | `src/Ex03Readonly/Dinheiro.php` | `readonly class`, promotion, value object, construtor nomeado |
| 04 | Closures | `src/Ex04Closures/Colecoes.php` | `array_map/filter/reduce`, `fn`, `strlen(...)`, composição |
| 05 | Property hooks | `src/Ex05PropertyHooks/Usuario.php` | hooks `get`/`set`, `private(set)`, propriedade virtual |
| 06 | Attributes | `src/Ex06Attributes/Validador.php` | attributes + Reflection (base do Symfony Validator e do Doctrine) |
| 07 | Projeto | `projeto/` (você cria) | tudo junto |

Alguns testes já passam desde o início (ex.: `strict_types`, `readonly`, `from()` do enum).
Eles estão lá para mostrar o que a linguagem já faz por você — leia os comentários.

## Dicas

- Leia a mensagem do teste que falhou antes de ler o código: `testdox` deixa a saída legível.
- Use o Xdebug: ponha um breakpoint no teste e rode `XDEBUG_SESSION=1 vendor/bin/phpunit --filter ...`.
- Referência: https://www.php.net/manual/pt_BR/ e https://php.watch (novidades por versão).

## 07 — Projeto: CLI de tarefas

Crie `bin/tarefas` (script PHP executável) que salva as tarefas em `tarefas.json`:

```bash
php bin/tarefas adicionar "Estudar enums" --prioridade=alta
php bin/tarefas listar
php bin/tarefas listar --status=pendente
php bin/tarefas concluir 3
php bin/tarefas remover 3
```

Requisitos:
- `Tarefa` como classe com `readonly` onde fizer sentido (id, criadaEm).
- `Prioridade` e `StatusTarefa` como enums.
- Um `RepositorioTarefas` (interface) com implementação `RepositorioJson` — você vai reencontrar esse padrão no Doctrine.
- Entrada inválida gera mensagem amigável e código de saída ≠ 0 (`exit(1)`).
- Testes PHPUnit para o repositório e as regras (o CLI em si pode ficar sem teste).

Bônus: depois de pronto, reescreva o CLI usando o componente `symfony/console`
(`composer require symfony/console`) e compare. É a ponte para as Fases 2 e 3.
