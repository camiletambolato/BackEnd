<?php
declare(strict_types=1);

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

$mensagemErro = '';
$sucesso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailValido = filter_var($email, FILTER_VALIDATE_EMAIL);
    
    if ($emailValido === false) {
        $mensagemErro = "Por favor, informe um e-mail válido.";
    } elseif (mb_strlen($senha) < 6) {
        $mensagemErro = "A senha deve conter no mínimo 6 caracteres.";
    } else {
        if ($email === 'admin@senai.br' && $senha === 'senhaSegura123') {
            $sucesso = true;
        } else {
            $mensagemErro = "Credenciais inválidas.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login Seguro</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .card-sucesso { background-color: #e2f0d9; border: 1px solid #b2d8b2; padding: 20px; width: 300px; border-radius: 5px; }
        .erro { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Autenticação</h2>

    <?php if ($sucesso): ?>
        <div class="card-sucesso">
            <h3>Bem-vindo, Administrador!</h3>
            <p>Sua autenticação foi realizada com sucesso.</p>
        </div>
    <?php else: ?>
        <?php if ($mensagemErro !== ''): ?>
            <p class="erro"><?= htmlspecialchars($mensagemErro) ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <p>
                <label>E-mail:<br>
                    <input type="email" name="email" value="<?= htmlspecialchars($email) ?>">
                </label>
            </p>
            <p>
                <label>Senha:<br>
                    <!-- Campo de senha propositalmente não mantido por motivos de segurança -->
                    <input type="password" name="senha" value="">
                </label>
            </p>
            <button type="submit">Entrar</button>
        </form>
    <?php endif; ?>
</body>
</html>