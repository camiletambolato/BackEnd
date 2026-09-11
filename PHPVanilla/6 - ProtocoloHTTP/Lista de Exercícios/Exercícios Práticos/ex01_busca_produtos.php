<?php
declare(strict_types=1);

$produtos = [
    ['nome' => 'Teclado Mecânico', 'categoria' => 'Periféricos', 'preco' => 250.00],
    ['nome' => 'Mouse Gamer', 'categoria' => 'Periféricos', 'preco' => 120.00],
    ['nome' => 'Monitor 24"', 'categoria' => 'Monitores', 'preco' => 850.00],
    ['nome' => 'Cadeira Ergonômica', 'categoria' => 'Móveis', 'preco' => 1200.00],
    ['nome' => 'Headset USB', 'categoria' => 'Áudio', 'preco' => 180.00],
    ['nome' => 'Webcam Full HD', 'categoria' => 'Vídeo', 'preco' => 310.00],
];

$buscaNome = trim($_GET['nome'] ?? '');
$precoMaximo = filter_var($_GET['preco_maximo'] ?? '', FILTER_VALIDATE_FLOAT);

$produtosFiltrados = array_filter($produtos, function (array $p) use ($buscaNome, $precoMaximo): bool {
    $matchNome = ($buscaNome === '') || (mb_strpos(mb_strtolower($p['nome']), mb_strtolower($buscaNome)) !== false);
    $matchPreco = ($precoMaximo === false || $precoMaximo === null) || ($p['preco'] <= $precoMaximo);
    return $matchNome && $matchPreco;
});
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Busca de Produtos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; max-width: 600px; margin-top: 15px; }
        th, td { border: 1px solid #383838; padding: 8px; text-align: left; }
        th { background-color: rgb(214, 214, 214); }
    </style>
</head>
<body style="background-color: rgb(244, 244, 245);">
    <h2 style="
    color: rgb(0, 0, 0);
    background-color: rgb(179, 179, 179);
    padding: 10px 20px;
    border-radius: 15px;
    display: inline-block;
">
    Buscar Produto
</h2>
    <form method="GET" action="">
        <label style="color: rgb(2, 2, 2);">Nome: <input type="text" name="nome" value="<?= htmlspecialchars($buscaNome) ?>"></label>
        <label style="color: rgb(0, 0, 0);">Preço Máximo: <input type="number" step="0.01" name="preco_maximo" value="<?= htmlspecialchars((string)($precoMaximo ?: '')) ?>"></label>
        <button type="submit"; style="color: rgb(2, 2, 2);">Filtrar</button>
        <a href="ex01_busca_produtos.php"; style="color: rgb(8, 8, 8);">Limpar</a>
    </form>

    <h3 style="color: rgb(3, 3, 3);">Catálogo</h3>
    <?php if (empty($produtosFiltrados)): ?>
        <p>Nenhum produto encontrado com os filtros aplicados.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr><th style="color: rgb(3, 3, 3);">Nome</th><th style="color: rgb(5, 5, 5);">Categoria</th><th style="color: rgb(5, 5, 5);">Preço</th></tr>
            </thead>
            <tbody>
                <?php foreach ($produtosFiltrados as $prod): ?>
                    <tr>
                        <td style="color: rgb(49, 49, 49);"><?= htmlspecialchars($prod['nome']) ?></td>
                        <td style="color: rgb(59, 59, 59);"><?= htmlspecialchars($prod['categoria']) ?></td>
                        <td style="color: rgb(59, 59, 59);">R$ <?= number_format($prod['preco'], 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>