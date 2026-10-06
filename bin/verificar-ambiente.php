<?php

// Confere se o ambiente tem o necessário para a Fase 1.
// Uso: php bin/verificar-ambiente.php

$ok = true;

function linha(bool $passou, string $texto, string $dica = ''): void
{
    echo ($passou ? '[OK]   ' : '[FALTA] ') . $texto . PHP_EOL;
    if (!$passou && $dica !== '') {
        echo '        -> ' . $dica . PHP_EOL;
    }
}

$versaoOk = version_compare(PHP_VERSION, '8.4.0', '>=');
linha($versaoOk, 'PHP ' . PHP_VERSION . ' (precisa 8.4 ou mais novo)', 'Instale o PHP 8.4+ (veja INSTALACAO-WINDOWS.md).');
$ok = $ok && $versaoOk;

$extensoes = [
    'mbstring' => 'usada nos exercícios (mb_strlen, mb_strtoupper)',
    'openssl' => 'o Composer precisa para baixar pacotes',
    'curl' => 'acelera downloads do Composer',
    'zip' => 'o Composer precisa para extrair pacotes',
    'dom' => 'o PHPUnit precisa',
    'xml' => 'o PHPUnit precisa',
    'tokenizer' => 'o PHPUnit precisa',
];

foreach ($extensoes as $ext => $motivo) {
    $carregada = extension_loaded($ext);
    linha($carregada, "extensão $ext ($motivo)", "Ative 'extension=$ext' no php.ini: " . (php_ini_loaded_file() ?: 'nenhum php.ini carregado!'));
    $ok = $ok && $carregada;
}

$vendor = is_file(__DIR__ . '/../vendor/autoload.php');
linha($vendor, 'dependências instaladas (pasta vendor/)', 'Rode: composer install');
$ok = $ok && $vendor;

echo PHP_EOL . ($ok ? 'Tudo certo! Rode: composer test' : 'Corrija os itens [FALTA] acima e rode este script de novo.') . PHP_EOL;
exit($ok ? 0 : 1);
