<?php
declare(strict_types=1);

$notas = [7.5, 8.0, 6.5, 9.0, 5.5];

$soma = 0;

foreach ($notas as $nota) {
    $soma += $nota;
}

$totalNotas = count($notas); // Retorna 5
$media = $soma / $totalNotas; // 36.5 / 5 = 7.3
echo "A média final do aluno é: $media";
echo PHP_EOL;

if ($media >= 7) {
    echo "\033[32mAprovado\033[0m\n";
} else {
    echo "\033[31mReprovado\033[0m\n";
}
?>
