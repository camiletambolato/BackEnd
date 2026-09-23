<?php
declare(strict_types=1); // Tipagem estrita

// Sanitiza a saída no HTML para evitar ataques XSS
function e(string $texto): string {
    return htmlspecialchars($texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

// Remove espaços extras e tags HTML de uma string
function sanitizarTexto(string $dado): string {
    return trim(strip_tags($dado));
}

// Valida os dados enviados e os retorna tratados junto com os erros
function validarColaborador(array $dados): array {
    $erros = [];
    $nome = sanitizarTexto($dados['nome'] ?? '');
    
    // Validação de cada campo
    if (empty($nome)) $erros[] = "Nome é obrigatório.";
    if (!filter_var($dados['email'] ?? '', FILTER_VALIDATE_EMAIL)) $erros[] = "E-mail inválido.";
    if (filter_var($dados['matricula'] ?? null, FILTER_VALIDATE_INT) === false) $erros[] = "Matrícula deve ser um número inteiro.";
    if (filter_var($dados['salario'] ?? null, FILTER_VALIDATE_FLOAT) === false) $erros[] = "Salário deve ser um valor numérico válido.";

    return [
        'valido' => empty($erros),
        'erros' => $erros,
        'dados' => [
            'nome' => $nome,
            'email' => $dados['email'] ?? '',
            'matricula' => (int)($dados['matricula'] ?? 0),
            'salario' => (float)($dados['salario'] ?? 0.0)
        ]
    ];
}

// Processa a validação apenas quando o formulário for enviado via POST
$resultado = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = validarColaborador($_POST);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><title>Cadastro de Colaborador</title></head>
<body>
    <h1 style="color: #a15a78;">Cadastro de Colaborador</h1>

    <!-- Exibe a lista de erros de validação -->
    <?php if ($resultado && !$resultado['valido']): ?>
        <ul style="color: red;">
            <?php foreach ($resultado['erros'] as $erro): ?>
                <li><?= e($erro) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="nome" placeholder="Nome Completo"><br><br>
        <input type="text" name="email" placeholder="E-mail"><br><br>
        <input type="number" name="matricula" placeholder="Matrícula"><br><br>
        <input type="text" name="salario" placeholder="Salário (ex: 3500.50)"><br><br>
        <button style="color: #e6b9b9;" type="submit">Cadastrar</button>
    </form>

    <!-- Exibe os dados cadastrados após a validação com sucesso -->
    <?php if ($resultado && $resultado['valido']): ?>
        <div style="border: 1px solid green; padding: 10px; margin-top: 15px;">
            <h3 style="color: #ac758c;">Colaborador Cadastrado!</h3>
            <p><strong style="color: #a15a78;">Nome:</strong> <?= e($resultado['dados']['nome']) ?></p>
            <p><strong style="color: #a15a78;">E-mail:</strong> <?= e($resultado['dados']['email']) ?></p>
            <p><strong style="color: #a15a78;">Matrícula:</strong> <?= e((string)$resultado['dados']['matricula']) ?></p>
            <p><strong style="color: #a15a78;">Salário:</strong> R$ <?= e(number_format($resultado['dados']['salario'], 2, ',', '.')) ?></p>
        </div>
    <?php endif; ?>
</body>
</html>