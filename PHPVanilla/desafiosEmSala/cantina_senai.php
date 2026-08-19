<?php
// este exercício não foi concluído
declare (strict_types = 1);

$produtos = [
1 => ["nome" => "Coxinha", "preco" => 6.00, "estoque" => 10],
2 => ["nome" => "Suco", "preco" => 5.00, "estoque" => 8],
3 => ["nome" => "Sanduíche", "preco" => 12.00, "estoque" => 5],
4 => ["nome" => "Bolo", "preco" => 7.50, "estoque" => 6]
];

$pedido = [];
$opcao = 0;

do {
    echo "1 - Listar produtos";
    echo "2 - Adicionar produto ao pedido";
    echo "3 - Exibir resumo do pedido";
    echo "4 - Finalizar compra";
    echo "0 - Sair sem finalizar";

     $opcao = (int) readline("Escolha uma opção: ");
    
} while ($opcao != 4 && $opcao != 0);

match ($opcao) {
    1, 2, 3, 4, 0 => null,
    default => null,
};

foreach ($produtos as $codigo => $produto) {
    echo "$codigo - {$produto['nome']} - R$ {$produto['preco']} - Estoque: {$produto['estoque']}\n";
}

    $codigo = (int) readline("Digite o código do produto: ");

    if (!isset($produtos[$codigo])) {
        echo "Produto inexistente!\n";
        exit;
    }

    do {
        $quantidade = (int) readline("Digite a quantidade: ");

        if ($quantidade <= 0 || $quantidade > $produtos[$codigo]['estoque']) {
            echo "Quantidade inválida!\n";
        }

    } while ($quantidade <= 0 || $quantidade > $produtos[$codigo]['estoque']);

    $produtos[$codigo]['estoque'] -= $quantidade;

    $pedido[] = [
    "nome" => $produtos[$codigo]['nome'],
    "preco" => $produtos[$codigo]['preco'],
    "quantidade" => $quantidade
];

foreach ($pedido as $item) {
    $subtotal = $item['preco'] * $item['quantidade'];

    echo "Produto: {$item['nome']}\n";
    echo "Quantidade: {$item['quantidade']}\n";
    echo "Preço unitário: R$ " . number_format($item['preco'], 2, ',', '.') . "\n";
    echo "Subtotal: R$ " . number_format($subtotal, 2, ',', '.') . "\n";
}

$total = 0;

for ($i = 0; $i < count($pedido); $i++) {
    $total += $pedido[$i]['preco'] * $pedido[$i]['quantidade'];
}

    

?>