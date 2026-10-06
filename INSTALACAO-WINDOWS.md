# Instalação no Windows (do zero)

Tempo estimado: 20–30 minutos. Funciona no Windows 10 e 11 e **não precisa de administrador**.

Vamos instalar: **Scoop** (gerenciador de programas) → **Git** → **PHP 8.4+** → **Composer** → **VS Code**.

---

## 1. Instalar o Scoop

Abra o **PowerShell** (menu Iniciar → digite "PowerShell" → Enter; *não* precisa ser como administrador) e rode:

```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
Invoke-RestMethod -Uri https://get.scoop.sh | Invoke-Expression
```

Se perguntar algo, responda `S` (ou `Y`).

## 2. Instalar Git, PHP e Composer

```powershell
scoop install git
scoop install php composer
```

**Feche e abra o PowerShell de novo** e confira:

```powershell
php -v          # deve mostrar PHP 8.4 ou mais novo
composer -V     # deve mostrar Composer 2.x
git --version
```

## 3. Ativar as extensões do PHP (php.ini)

Rode:

```powershell
php --ini
```

Veja a linha **Loaded Configuration File**.

**a) Se aparecer `(none)`** — não existe php.ini ainda. Crie a partir do modelo:

```powershell
$phpDir = Split-Path (Get-Command php).Source
Copy-Item "$phpDir\php.ini-development" "$phpDir\php.ini"
```

> Se o comando acima não achar o arquivo, rode `scoop prefix php` para ver a pasta do PHP e copie
> `php.ini-development` para `php.ini` nessa pasta (pode ser pelo Explorer).

**b) Abra o php.ini** (o caminho que o `php --ini` mostrou) no Bloco de Notas ou VS Code e
**apague o `;` do começo** destas linhas:

```ini
extension_dir = "ext"
extension=curl
extension=mbstring
extension=openssl
extension=zip
```

Salve, e rode `php -m` — a lista deve incluir `curl`, `mbstring`, `openssl` e `zip`.

## 4. Instalar o VS Code

```powershell
scoop bucket add extras
scoop install vscode
```

(ou baixe em https://code.visualstudio.com)

Abra o VS Code e instale estas extensões (ícone de blocos na barra lateral):

- **PHP Intelephense** (Ben Mewburn) — autocompletar e erros enquanto digita
- **PHP Debug** (Xdebug) — opcional, para depurar com breakpoints

## 5. Baixar o projeto e instalar as dependências

```powershell
cd ~\Documents
git clone <URL-DO-REPOSITORIO> fase1-php-moderno
cd fase1-php-moderno
composer install
php bin/verificar-ambiente.php
```

O último comando confere tudo. Se aparecer **"Tudo certo!"**, você está pronto.

## 6. Rodar os testes

```powershell
composer test                       # roda todos
composer test -- --filter Ex01      # só o exercício 1
```

> No Windows, `vendor/bin/phpunit` também funciona como `vendor\bin\phpunit`,
> mas `composer test` funciona igual em qualquer sistema.

No começo quase tudo aparece em **vermelho** — é esperado. Sua missão é deixar verde.
Abra o `README.md` para ver a ordem dos exercícios.

---

## Problemas comuns

| Sintoma | Causa | Solução |
|---|---|---|
| `php` não é reconhecido como comando | PowerShell aberto antes da instalação | Feche e abra o PowerShell |
| `The openssl extension is required` ao usar o Composer | `extension=openssl` comentada | Passo 3 |
| `Call to undefined function mb_strlen()` | `extension=mbstring` comentada | Passo 3 |
| `composer install` reclama da versão do PHP | PHP abaixo de 8.4 | `scoop update php` |
| Editei o php.ini e nada mudou | Editou um php.ini diferente | Confira o caminho com `php --ini` |
| Script do Scoop bloqueado | Política de execução | Rode de novo a 1ª linha do passo 1 |
