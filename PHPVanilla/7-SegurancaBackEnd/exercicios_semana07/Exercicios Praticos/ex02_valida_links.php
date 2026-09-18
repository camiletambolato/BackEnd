<?php
declare(strict_types=1);

function e(string $texto): string {
    return htmlspecialchars($texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}
// Valida a URL 
function validarUrlSegura(string $url): bool {
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
    }
// Verifica o protocolo
    return str_starts_with($url, 'http://') || str_starts_with($url, 'https://');
}
// Garante que o sistema só aceite URLs seguras e envie uma mensagem de erro caso o link seja inválido.
$erro = '';
$linkValido = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $urlInput = trim($_POST['url'] ?? '');

    if (validarUrlSegura($urlInput)) {
        $linkValido = $urlInput;
    } else {
        $erro = 'URL inválida ou esquema de protocolo não permitido (use http:// ou https://).';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><title>Validador de Links</title></head>
<body>
    <h1 style="color: #a15a78;">Cadastrar Link de Portfólio</h1>
    <?php if ($erro): ?>
        <p style="color: red;"><?= e($erro) ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="url" placeholder="https://github.com/seu-usuario" style="width: 300px;" required>
        <button style="color: #e6b9b9;" type="submit">Validar e Cadastrar</button>
    </form>

    <?php if ($linkValido): ?>
        <p style="color: #ffb9b9;">Portfólio cadastrado com sucesso!</p>
        <a style="color: #e6b9b9;" href="<?= e($linkValido) ?>" target="_blank" rel="noopener noreferrer">Visitar Portfólio</a>
    <?php endif; ?>
</body>
</html>