<?php
declare(strict_types=1);

// função e(string $texto): string para escapamento universal 
function e(string $texto): string {
    return htmlspecialchars($texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}
// Salvar a mensagem feita pelo usuário
function salvarMensagem(string $nome, string $msg, string $arquivo = 'mural.json'): void {
    $mensagens = file_exists($arquivo) ? json_decode(file_get_contents($arquivo), true) : [];
    // Exibe a data em que a mensagem foi postada
    $mensagens[] = ['nome' => $nome, 'mensagem' => $msg, 'data' => date('d/m/Y H:i')];
    file_put_contents($arquivo, json_encode($mensagens, JSON_PRETTY_PRINT));
}
// Exibir Mensagem de erro ou como o campo deve ser preencido pelo usuário
$erros = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    // Exige o nome e com mínimo de 3 caracteres
    if (mb_strlen($nome) < 3) $erros[] = "Nome deve ter no mínimo 3 caracteres.";
    // Exige a mensagem e com o mínimo de 5 caracteres
    if (mb_strlen($mensagem) < 5) $erros[] = "Mensagem deve ter no mínimo 5 caracteres.";
    // Verifica se o formulário passou sem problemas
    if (empty($erros)) {
        salvarMensagem($nome, $mensagem);
        header('Location: ex01_mural.php');
        exit;
    }
}

$mensagens = file_exists('mural.json') ? json_decode(file_get_contents('mural.json'), true) : [];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Mural de Recados</title>
</head>
<body>
    <h1 style="color:#a15a78;">Mural de Recados</h1>
    <?php foreach ($erros as $erro): ?>
        <p style="color: red;"><?= e($erro) ?></p>
    <?php endforeach; ?>

    <form method="POST">
        <input type="text" name="nome" placeholder="Seu nome" required><br><br>
        <textarea name="mensagem" placeholder="Sua mensagem" required></textarea><br><br>
        <button style="color: #a15a78;" type="submit">Enviar</button>
    </form>

    <h2 style="color:#a15a78;">Mensagens Salvas</h2>
    <?php foreach ($mensagens as $m): ?>
        <div style="border: 1px solid #ffe0e0; border-radius: 8px; padding: 15px; margin-bottom: 15px; background-color: #faeaea;">
            <strong><?= e($m['nome']) ?></strong> (<?= e($m['data']) ?>):<br>
            <?= nl2br(e($m['mensagem'])) ?>
        </div>
    <?php endforeach; ?>
</body>
</html>
