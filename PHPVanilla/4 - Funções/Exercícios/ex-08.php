<?php
declare(strict_types=1);

function limparCPF(string $cpf): string {
    return str_replace([".", "-"], "", $cpf);
}

function cpfValido(string $cpf): bool {
    return strlen($cpf) === 11 && is_numeric($cpf);
}

$cpf="123.456.789-00";$cpfLimpo=limparCPF($cpf);echo"CPF limpo: ".$cpfLimpo. PHP_EOL;if (cpfValido($cpfLimpo)) {echo"CPF válido!";}
else {echo"CPF inválido!";
}