<?php
declare(strict_types=1);

// Declaração das variáveis escalares da ficha cadastral
$nome = "Carlos Eduardo";
$idade = 19;
$altura = 1.78;
$isEstudante = true;

// Exibição dos dados formatados em linhas separadas
echo "Nome: {$nome}" . PHP_EOL;
echo "Idade: {$idade} anos" . PHP_EOL;
echo "Altura: {$altura}m" . PHP_EOL;
echo "Estudante: " . ($isEstudante ? "Sim" : "Não") . PHP_EOL;