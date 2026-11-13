<?php
declare(strict_types=1);

// Definição de constantes em tempo de execução (define) e compilação (const)
define("TAXA_CONVERSAO", 5.25);
const NOME_SISTEMA = "Sistema ERP Senai";

// Exibição formatada das constantes
echo "Sistema: " . NOME_SISTEMA . PHP_EOL;
echo "Taxa de Conversão: R$ " . number_format(TAXA_CONVERSAO, 2, ',', '.') . PHP_EOL;