<?php
declare(strict_types=1);

$usuario = [
    "nome" => "Carlos Eduardo",
    "idade" => 28,
    "cidade" => "Americana",
    "estado" => "SP",
    "premium" => true
];

if ($usuario["premium"] === true) {
    $estrela = "⭐";
} else {
    $estrela = "";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
<div style="
    color: rgb(121, 98, 84);
    background-color: rgb(228, 216, 184);
    padding: 10px 20px;
    border-radius: 15px;
    display: inline-block;
">

    <h2>
        <?php echo $usuario["nome"] . $estrela; ?>
    </h2>

    <p>Idade: <?php echo $usuario["idade"]; ?></p>

    <p>
        Cidade:
        <?php echo $usuario["cidade"] . " - " . $usuario["estado"]; ?>
    </p>

</div>
</body>
</html>