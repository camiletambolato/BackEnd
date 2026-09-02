<?php
declare(strict_types=1);

function buscarCliente(array $clientes, string $nome): ?array
{foreach ($clientes as $cliente) {if ($cliente["nome"] === $nome) {return $cliente;
        }
    } return null;
}$clientes= [
    ["nome" =>"Camile","email" =>"camile@email.com"],
    ["nome" =>"Ana","email" =>"ana@email.com"]
];$cliente=buscarCliente($clientes,"Camile");if ($cliente!==null) {echo"Cliente encontrado: ".$cliente["nome"]. PHP_EOL;echo"E-mail: ".$cliente["email"];
}else {echo"Cliente não encontrado.";
}echo PHP_EOL;$cliente=buscarCliente($clientes,"Carlos");if ($cliente!==null) {echo"Cliente encontrado: ".$cliente["nome"];
}else {echo"Cliente não encontrado.";
}