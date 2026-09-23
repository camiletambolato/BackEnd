<?php
declare(strict_types=1); // Tipagem estrita

// Evita ataques XSS
function e(string $texto): string {
    return htmlspecialchars($texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

$busca = $_GET['q'] ?? ''; // Pega a busca da URL
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><title>Busca Blindada</title></head>
<body>
    <h1 style="color: #a15a78;">Busca de Produtos</h1>
    
    <form method="GET">
        <input type="text" name="q" value="<?= e($busca) ?>" placeholder="Digite sua busca...">
        <button style="color: #e6b9b9;" type="submit">Buscar</button>
    </form>

    <?php if ($busca !== ''): ?>
        <p>Você buscou por: <strong style="color: #b89191;"><?= e($busca) ?></strong></p>
    <?php endif; ?>
</body>
</html>