<?php
declare(strict_types=1);

// Produtos do carrinho
$carrinho = [
    ["produto" => "Notebook", "preco" => 4000.00],
    ["produto" => "Mouse", "preco" => 150.00],
    ["produto" => "Teclado", "preco" => 300.00]
];

// Aplica 20% de desconto em todos os produtos
$carrinhoBlackFriday = array_map(function ($item) {

    // Multiplica o preço por 0.80 para retirar 20%
    $item["preco"] = $item["preco"] * 0.80;

    // Retorna o produto com o novo preço
    return $item;

}, $carrinho);

// Mostra os novos preços
echo '<h2 style="
    color: rgb(116, 95, 76);
    background-color: rgb(238, 225, 184);
    padding: 10px 20px;
    border-radius: 15px;
    display: inline-block;
">
    Preços da Black Friday
</h2>';
echo '<div class="PHP_EOL"></div>';
foreach ($carrinhoBlackFriday as $item) {
    echo "Produto: " . $item["produto"] . "<br>";

    echo "Preço com desconto: R$ "
        . number_format($item["preco"], 2, ',', '.')
        . "<br><br>";
}
?>