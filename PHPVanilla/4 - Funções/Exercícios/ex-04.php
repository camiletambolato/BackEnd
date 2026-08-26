<?php
//Exercício 4 — Formatador de Nome
declare(strict_types=1);

function formatarNome(string $nome): string {
    $nome = trim($nome);
    $nome = strtolower($nome);
    return ucfirst($nome);
}

echo formatarNome("   MARIA   ") . PHP_EOL;
echo formatarNome("JOÃO") . PHP_EOL;
echo formatarNome("   ana   ") . PHP_EOL;
?>