<?php
declare(strict_types=1);

$valorVeiculoRaw = $_POST['valor_veiculo'] ?? '';
$valorEntradaRaw = $_POST['valor_entrada'] ?? '';
$numeroParcelasRaw = $_POST['numero_parcelas'] ?? '';

$opcoesParcelas = [12, 24, 36, 48, 60];
$erros = [];
$memoriaCalculo = null;

// verifica se o botão de envio do formulário foi disparado (handle)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // pegar o valor dos campos preenchidos
    $valorVeiculo = filter_var($valorVeiculoRaw, FILTER_VALIDATE_FLOAT);
    $valorEntrada = filter_var($valorEntradaRaw, FILTER_VALIDATE_FLOAT);
    $numeroParcelas = filter_var($numeroParcelasRaw, FILTER_VALIDATE_INT);

    // Validação 1 - Entrada mínima de 20%
    if ($valorVeiculo === false || $valorVeiculo <= 0) {
        $erros[] = "O valor do veículo deve ser positivo.";
    }
    
    if ($valorEntrada === false || $valorEntrada < 0) {
        $erros[] = "A entrada fornecida é inválida.";
    } elseif ($valorVeiculo !== false && $valorEntrada < ($valorVeiculo * 0.20)) {
        $erros[] = "A entrada deve ser de pelo menos 20% do valor do veículo (Mínimo: R$ " . number_format($valorVeiculo * 0.20, 2, ',', '.') . ").";
    }
    // Validação 2 - Nº de parcelas
    if ($numeroParcelas === false || !in_array($numeroParcelas, $opcoesParcelas, true)) {
        $erros[] = "Selecione uma quantidade válida de parcelas.";
    }

    // Regra de Negócio
    if (empty($erros)) {// Se não existir erros então faça 
        $saldoFinanciado = $valorVeiculo - $valorEntrada;
        $taxaJurosMensal = 0.015; // 1.5% ao mês

        // Calculo do Juros Simples => se fosse composto usaria um laço de repetição (FOR) 
        $totalJuros = $saldoFinanciado * $taxaJurosMensal * $numeroParcelas;
        $valorTotalComJuros = $saldoFinanciado + $totalJuros;
        $valorParcela = $valorTotalComJuros / $numeroParcelas;

        $memoriaCalculo = [
            'saldoFinanciado' => $saldoFinanciado,
            'totalJuros' => $totalJuros,
            'valorParcela' => $valorParcela,
            'parcelas' => $numeroParcelas
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Simulador de Financiamento</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 30px auto; padding: 20px; }
        .campo { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #889eb6; color: white; border: none; font-size: 16px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .erros { background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .resultado { background-color: #e2e3e5; padding: 15px; border-radius: 4px; margin-top: 20px; }
    </style>
</head>
<body>
    <h2>Simulador de Financiamento Automotivo</h2>

    <?php if (!empty($erros)): ?>
        <ul class="erro">
            <?php foreach ($erros as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST" action="">
        <p>
            <label>Valor do Veículo (R$):<br>
                <input type="number" step="0.01" name="valor_veiculo" value="<?= htmlspecialchars((string)$valorVeiculoRaw) ?>">
            </label>
        </p>
        <p>
            <label>Valor da Entrada (R$):<br>
                <input type="number" step="0.01" name="valor_entrada" value="<?= htmlspecialchars((string)$valorEntradaRaw) ?>">
            </label>
        </p>
        <p>
            <label>Número de Parcelas:<br>
                <select name="numero_parcelas">
                    <option value="">Selecione...</option>
                    <?php foreach ($opcoesParcelas as $p): ?>
                        <option value="<?= $p ?>" <?= ((string)$p === (string)$numeroParcelasRaw) ? 'selected' : '' ?>>
                            <?= $p ?>x
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
        </p>
        <button type="submit">Simular Financiamento</button>
    </form>

    <?php if ($memoriaCalculo !== null): ?>
        <div class="resumo">
            <h3>Memória de Cálculo</h3>
            <p><strong>Valor Financiado:</strong> R$ <?= number_format($memoriaCalculo['saldoFinanciado'], 2, ',', '.') ?></p>
            <p><strong>Total de Juros (1,5% a.m.):</strong> R$ <?= number_format($memoriaCalculo['totalJuros'], 2, ',', '.') ?></p>
            <p><strong>Parcelas:</strong> <?= $memoriaCalculo['parcelas'] ?>x de <strong>R$ <?= number_format($memoriaCalculo['valorParcela'], 2, ',', '.') ?></strong></p>
        </div>
    <?php endif; ?>
</body>
</html>
