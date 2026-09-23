<?php
declare(strict_types=1); // Tipagem estrita

// Escapa código malicioso mantendo caracteres seguros para HTML
function e(string $texto): string {
    return htmlspecialchars($texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

// Salva a mensagem no arquivo JSON se passar na validação de tamanho/conteúdo
function salvarMensagemChat(string $mensagem, string $arquivo = 'chat.json'): bool {
    if (mb_strlen($mensagem) > 250 || empty(trim($mensagem))) {
        return false;
    }
    $mensagens = file_exists($arquivo) ? json_decode(file_get_contents($arquivo), true) : [];
    $mensagens[] = ['mensagem' => $mensagem, 'hora' => date('H:i:s')];
    return (bool) file_put_contents($arquivo, json_encode($mensagens, JSON_PRETTY_PRINT));
}

// Processa o envio da mensagem (POST) e redireciona em caso de sucesso
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $msg = $_POST['mensagem'] ?? '';
    if (!salvarMensagemChat($msg)) {
        $erro = 'A mensagem deve ter entre 1 e 250 caracteres.';
    } else {
        header('Location: ex05_chat_operacao.php');
        exit;
    }
}

// Carrega as mensagens salvas para exibição
$chatLog = file_exists('chat.json') ? json_decode(file_get_contents('chat.json'), true) : [];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><title>Chat Industrial</title></head>
<body>
    <h1 style="color: #a15a78;">Chat de Operação</h1>
    <?php if ($erro): ?>
        <p style="color: red;"><?= e($erro) ?></p>
    <?php endif; ?>

    <form method="POST">
        <textarea name="mensagem" maxlength="250" placeholder="Digite a mensagem para a operação..." required></textarea><br><br>
        <button style="color: #e6b9b9;" type="submit">Enviar Mensagem</button>
    </form>

    <h2 style="color: #ac758c;">Histórico</h2>
    <?php foreach ($chatLog as $c): ?>
        <p>
            <small style="color: #e6b9b9;">[<?= e($c['hora']) ?>]</small><br>
            <?php
            
            echo nl2br(e($c['mensagem']));
            ?>
        </p>
        <hr>
    <?php endforeach; ?>
</body>
</html>