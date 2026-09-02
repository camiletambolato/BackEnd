<?php
declare(strict_types=1);

// Lista de filmes
$filmes = [
    ["titulo" => "Matrix", "genero" => "Ficção", "classificacao_idade" => 16],
    ["titulo" => "Shrek", "genero" => "Animação", "classificacao_idade" => 0],
    ["titulo" => "Deadpool", "genero" => "Ação", "classificacao_idade" => 18],
    ["titulo" => "Procurando Nemo", "genero" => "Animação", "classificacao_idade" => 0],
    ["titulo" => "Vingadores", "genero" => "Ação", "classificacao_idade" => 12]
];

// Filtra somente os filmes para até 12 anos
// A arrow function verifica a classificação de cada filme
$filmesInfantis = array_filter(
    $filmes,
    fn($filme) => $filme["classificacao_idade"] <= 12
);

// Mostra os filmes encontrados
echo '<h2 style="
    color: rgb(116, 95, 76);
    background-color: rgb(238, 225, 184);
    padding: 10px 20px;
    border-radius: 15px;
    display: inline-block;
">
    Filmes para Crianças
</h2>';
echo '<div class="PHP_EOL"></div>';

foreach ($filmesInfantis as $filme) {
    echo "<p>Título: " . $filme["titulo"] . "<br></p>";
    echo "Gênero: " . $filme["genero"] . "<br>";
    echo "Classificação: " . $filme["classificacao_idade"] . " anos<br><br>";
}
?>