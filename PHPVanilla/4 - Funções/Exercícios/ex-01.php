<?php
// Exercício 1 — Calculadora de IMC
declare(strict_types=1);

function calcularIMC(float $peso, float $altura): float {
    return $peso / ($altura * $altura);
}

$peso1 = 70.0;
$altura1 = 1.75;

$peso2 = 80.0;
$altura2 = 1.85;

$peso3 = 50.0;
$altura3 = 1.50;

echo "IMC 1: " . number_format(calcularIMC($peso1, $altura1), 2) . PHP_EOL;
echo "IMC 2: " . number_format(calcularIMC($peso2, $altura2), 2) . PHP_EOL;
echo "IMC 3: " . number_format(calcularIMC($peso3, $altura3), 2) . PHP_EOL;
?>