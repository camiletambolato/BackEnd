<?php
declare(strict_types=1);

$produto = "Teclado Mecânico";
$preco = 250.00;

// 1. Usando concatenação com o operador ponto (.)
echo "O produto " . $produto . " custa R$ " . number_format($preco, 2, ',', '.') . PHP_EOL;

// 2. Usando interpolação direta com aspas duplas e chaves
$precoFormatado = number_format($preco, 2, ',', '.');
echo "O produto {$produto} custa R$ {$precoFormatado}" . PHP_EOL;