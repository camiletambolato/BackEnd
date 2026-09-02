<?php
declare(strict_types=1);
function formatarNome(string $nome): string
{
	$nome = trim($nome);
	$nome = strtolower($nome);

	return ucfirst($nome);
}

echo formatarNome("  ANA  ") . PHP_EOL;
echo formatarNome("MARIA") . PHP_EOL;
echo formatarNome("  joao  ") . PHP_EOL;