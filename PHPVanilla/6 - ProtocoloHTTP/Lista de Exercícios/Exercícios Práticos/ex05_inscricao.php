<?php
declare(strict_types=1);

$cursosValidos = [
    'Desenvolvimento de Sistemas',
    'Mecatrônica',
    'Redes'
];

$nome = trim($_POST['nome_candidato'] ?? '');
$idadeRaw = $_POST['idade'] ?? '';
$cursoDesejado = $_POST['curso_desejado'] ?? '';
$aceiteTermos = isset($_POST['aceite_termos']);

$erros = [];
$sucesso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idade = filter_var($idadeRaw, FILTER_VALIDATE_INT);

    if (mb_strlen($nome) < 5) {
        $erros['nome'] = "O nome deve conter pelo menos 5 caracteres.";
    }

    if ($idade === false || $idade < 16) {
        $erros['idade'] = "A idade deve ser um número inteiro igual ou superior a 16 anos.";
    }

    if (!in_array($cursoDesejado, $cursosValidos, true)) {
        $erros['curso'] = "Por favor, selecione um curso válido da lista.";
    }

    if (!$aceiteTermos) {
        $erros['termos'] = "Você deve aceitar os termos do processo seletivo.";
    }

    if (empty($erros)) {
        $sucesso = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Inscrição SENAI</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .msg-erro { color: red; font-size: 0.9em; display: block; margin-top: 3px; }
        .campo { margin-bottom: 15px; }
        .sucesso { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 15px; width: 400px; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>Inscrição em Cursos Técnicos - SENAI</h2>

    <?php if ($sucesso): ?>
        <div class="sucesso">
            <h3>Inscrição realizada com sucesso!</h3>
            <p><strong>Candidato:</strong> <?= htmlspecialchars($nome) ?></p>
            <p><strong>Idade:</strong> <?= htmlspecialchars((string)$idadeRaw) ?> anos</p>
            <p><strong>Curso:</strong> <?= htmlspecialchars($cursoDesejado) ?></p>
        </div>
    <?php else: ?>
        <form method="POST" action="">
            <div class="campo">
                <label>Nome Completo:<br>
                    <input type="text" name="nome_candidato" value="<?= htmlspecialchars($nome) ?>">
                </label>
                <?php if (isset($erros['nome'])): ?>
                    <span class="msg-erro"><?= htmlspecialchars($erros['nome']) ?></span>
                <?php endif; ?>
            </div>

            <div class="campo">
                <label>Idade:<br>
                    <input type="number" name="idade" value="<?= htmlspecialchars((string)$idadeRaw) ?>">
                </label>
                <?php if (isset($erros['idade'])): ?>
                    <span class="msg-erro"><?= htmlspecialchars($erros['idade']) ?></span>
                <?php endif; ?>
            </div>

            <div class="campo">
                <label>Curso Desejado:<br>
                    <select name="curso_desejado">
                        <option value="">-- Selecione --</option>
                        <?php foreach ($cursosValidos as $c): ?>
                            <option value="<?= htmlspecialchars($c) ?>" <?= ($c === $cursoDesejado) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($c) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <?php if (isset($erros['curso'])): ?>
                    <span class="msg-erro"><?= htmlspecialchars($erros['curso']) ?></span>
                <?php endif; ?>
            </div>

            <div class="campo">
                <label>
                    <input type="checkbox" name="aceite_termos" value="1" <?= $aceiteTermos ? 'checked' : '' ?>>
                    Concordo com os termos do processo seletivo
                </label>
                <?php if (isset($erros['termos'])): ?>
                    <span class="msg-erro"><?= htmlspecialchars($erros['termos']) ?></span>
                <?php endif; ?>
            </div>

            <button type="submit">Enviar Inscrição</button>
        </form>
    <?php endif; ?>
</body>
</html>