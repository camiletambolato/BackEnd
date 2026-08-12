<?php
//1. declare => Evitar operações entre variáveis de tipos diferentes
declare(strict_types=1);

//Criar um cáculo de holerite em PHP

//2. Declarar as constantes
const TAXA_INSS = 0.08; //8% => 8/100
const DESCONTO_VT = 150.00;

//3. Declarar a variáveis
//Dados do Empregado
$nomeFuncionario = "Maria Silva";
$salarioBase = 3200.50;
$horasExtras = 10;

//Declaração de variáveis usando LowerCamelCase
// regra => primeira palvra tudo minúsculo e depois as demais palavras usa-se maiúscula na primeira letra
// exemplo: $hojeEstaUmDiaBonito

//4. Cálculos dos salários
$valorHoraExtra = ($salarioBase / 220) * 1.6;

// => Crie a variável $totalDeHorasExtras
$totalDeHorasExtras = $valorHoraExtra * $horasExtras;

// => Crie a variável $salarioBruto
$salarioBruto = $totalDeHorasExtras + $salarioBase;

// => Crie e variável $descontosInss
$descontoInss = $salarioBruto * TAXA_INSS;

// => Crie a variável $salarioLiquido
$salarioLiquido = ($salarioBruto - $descontoInss) - DESCONTO_VT;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holerite - <?php $nomeFuncionario ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Demonstratico de Pagamento</h2>
    <!-- Saída de Dados Misturando Html e PHP -->
     <table>  
        <tr>
            <th>Colaborador(a)</th>
            <td><?php echo $nomeFuncionario ?></td>
        </tr>
        <tr>
            <th>Salário Base</th>
            <!-- Usar uma função chamada number format (formata saida de numeros) -->
             <td>R$ <?php echo number_format($salarioBase,2,",","."); ?></td>
        </tr>
        <!-- fazer as demais linhas da tabela utilizando as variáveis criadas -->
         <tr>
            <th>Valor das Horas Extras</th>
            <td>R$ <?php echo number_format($valorHoraExtra,2,",",".") ?></td>
        </tr>
         <tr>
            <th>Total de Horas Extras</th>
            <td><?php echo number_format($totalDeHorasExtras,2,",","."); ?></td>
         </tr>
         <tr>
            <th>Salário Bruto</th>
            <td><?php echo number_format($salarioBruto,2,",","."); ?></td>
         </tr>
         <tr>
            <th>Desconto do INSS</th>
            <td><?php echo number_format($descontoInss,2,",","."); ?></td>
         </tr>
         <tr>
            <th>Salário Líquido</th>
            <td><?php echo number_format($salarioBruto,2,",","."); ?></td>
         </tr>
     </table>
</body>
</html>
<!--  php -S localhost:8080 -->
<!-- (http://localhost:8080) -->