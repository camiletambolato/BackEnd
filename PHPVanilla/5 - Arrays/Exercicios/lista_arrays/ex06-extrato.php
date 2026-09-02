<?php
declare(strict_types=1);

// Produtos do carrinho
$carrinho = [
    ["produto" => "Notebook", "preco" => 4000.00],
    ["produto" => "Mouse", "preco" => 150.00],
    ["produto" => "Teclado", "preco" => 300.00]
];

// Aplica 20% de desconto
$carrinhoBlackFriday = array_map(function ($item) {
    $item["preco"] *= 0.80;
    return $item;
}, $carrinho);
?>

<table border="1">
    <tr>
        <th style="color: rgb(145, 125, 113); background-color: rgb(235, 228, 211);">Produto</th>
        <th style="color: rgb(145, 125, 113); background-color: rgb(235, 228, 211);">Preço Black Friday</th>
    </tr>

    <?php foreach ($carrinhoBlackFriday as $item) { ?>
        <tr>
            <td style="color: rgb(145, 125, 113);"><?php echo $item["produto"]; ?></td>
            <td style="color: rgb(145, 125, 113);">
                R$ <?php echo number_format($item["preco"], 2, ',', '.'); ?>
            </td>
        </tr>
    <?php } ?>
</table>