<?php
declare(strict_types=1);

function calcularMedia(array $notas): float
{return array_sum($notas)/count($notas);
}

function verificarAprovacao(float $media): string
{if ($media>=7) {return"Aprovado";
    }else {return"Reprovado";
    }
}$notas= [8,7,9,6];$media=calcularMedia($notas);echo"Média: ".number_format($media,2). PHP_EOL;echo"Situação: ".verificarAprovacao($media). PHP_EOL;echo"Maior nota: ".max($notas). PHP_EOL;echo"Menor nota: ".min($notas). PHP_EOL;