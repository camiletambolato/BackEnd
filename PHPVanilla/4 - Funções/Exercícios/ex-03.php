<?php
//Exercício 3 — Validador de Senha
declare(strict_types=1);

function senhaForte(string $senha): bool {
    return strlen($senha) > 8;
}

$senha = "MinhaSenha123";

if (senhaForte($senha)) {
    echo "A senha é forte.";
} else {
    echo "A senha é fraca.";
}
?>