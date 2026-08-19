<?php
declare (strict_types=1);
{
    // Valor inicial da dívida
    // Você pode mudar esse valor para testar o programa
    $divida = 1000; 

    // Define a categoria do cliente
    // Você pode trocar para "categoria B" ou "categoria C"
    $categoria = "categoria A"; 

    // Define a taxa de juros de acordo com a categoria
    $taxa = match ($categoria) {
        "categoria A" => 0.01, // 1% de juros ao mês
        "categoria B" => 0.02, // 2% de juros ao mês
        "categoria C" => 0.03, // 3% de juros ao mês
        // Se a categoria não for nenhuma das anteriores
        default => 0.05, // 5% de juros ao mês
    };

    // Mostra a categoria escolhida
    echo "Categoria: $categoria" . PHP_EOL;
    // Mostra a taxa de juros em porcentagem
    echo "Taxa de juros: " . ($taxa * 100) . "% ao mês" . PHP_EOL;

    // for é a repetição que calcula a dívida durante 12 meses, o codigo continua enquanto $mes for menor ou igual a 12
    for ($mes = 1; $mes <= 12; $mes++) {

        // Verifica se o mês atual é o mês 6
        if ($mes == 6) {

            // No mês 6 não são cobrados juros, number_format deixa o valor no formato brasileiro
            echo "Mês $mes: Insenção de juros - R$ "
                . number_format($divida, 2, ',', '.')
                . PHP_EOL;

            // Interrompe apenas a repetição atual e continua para o próximo mês
            continue;
        }

        // Calcula o valor dos juros
        $juros = $divida * $taxa;
        // Soma os juros à dívida
        $divida = $divida + $juros;

        // Mostra o resultado daquele mês
        echo "Mês $mes: Juros = R$"
            . number_format($juros, 2, ',', '.') // Mostra os juros com 2 casas decimais e deixa o valor em formato brasileiro
            . " | Dívida = R$ " // Separador visual
            . number_format($divida, 2, ',', '.') // Mostra o valor atualizado da dívida
            . PHP_EOL; // PHP_EOL pula para a próxima linha
    }
}

?>