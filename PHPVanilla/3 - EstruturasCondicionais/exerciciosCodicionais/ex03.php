<?php
declare(strict_types=1);

$peso = 85.5;
$altura = 1.75;

$imc = $peso / ($altura * $altura);

if ($imc < 18.5) {
    $classificacao = "Abaixo do Peso";
} elseif ($imc < 25) {
    $classificacao = "Peso Normal";
} elseif ($imc < 30) {
    $classificacao = "Sobrepeso";
} elseif ($imc < 35) {
    $classificacao = "Obesidade Grau I";
} else {
    $classificacao = "Obesidade Grau II ou III";
}

echo "Peso: $peso kg<br>";
echo "Altura: $altura m<br>";
echo "IMC: " . number_format($imc, 2, "," , ".");
echo "Classificação: $classificacao";

?>