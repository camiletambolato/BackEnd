<?php
declare(strict_types=1);
// Lista de funcionários
$funcionarios = [
    ["id" => 1, "nome" => "Ana Souza", "cargo" => "Dev Front-End", "salario" => 4500.00],
    ["id" => 2, "nome" => "Bruno Costa", "cargo" => "Dev Back-End", "salario" => 5200.00],
    ["id" => 3, "nome" => "Carla Dias", "cargo" => "Tech Lead", "salario" => 8900.00],
    ["id" => 4, "nome" => "Daniel Silva", "cargo" => "Estagiário", "salario" => 1500.00]
];

// Começa o total em zero
$totalFolha = 0;
?>

<table border=1>
    <tr>
        <th style="color: rgb(145, 125, 113); background-color: rgb(235, 228, 211);">ID</th>
        <th style="color: rgb(145, 125, 113); background-color: rgb(235, 228, 211);">Nome</th>
        <th style="color: rgb(145, 125, 113); background-color: rgb(235, 228, 211);">Cargo</th>
        <th style="color: rgb(145, 125, 113); background-color: rgb(235, 228, 211);">Salário</th>
    </tr>

    <?php
    // Percorre todos os funcionários
    foreach ($funcionarios as $funcionario) {
    ?>

        <tr>
            <td style="color: rgb(145, 125, 113);"><?php echo $funcionario["id"]; ?></td>
            <td style="color: rgb(145, 125, 113);"><?php echo $funcionario["nome"]; ?></td>
            <td style="color: rgb(145, 125, 113);"><?php echo $funcionario["cargo"]; ?></td>
            <td style="color: rgb(145, 125, 113);">
                <?php
                // Mostra o salário em reais
                echo "R$ " . number_format($funcionario["salario"], 2, ',', '.');

                // Soma o salário ao total
                $totalFolha += $funcionario["salario"];
                ?>
            </td>
        </tr>

    <?php
    }
    ?>

    <tr>
        <td style="color: rgb(145, 125, 113);">Total da folha</td>
        <td></td>
        <td></td>
        <td style="color: rgb(145, 125, 113);">
            <?php
            // Mostra o total dos salários
            echo "R$ " . number_format($totalFolha, 2, ',', '.');
            ?>
        </td>
    </tr>
</table>