<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudo de Váriaveis</title>
</head>
<body>
    <h1>Estudo de Variáveis</h1>
    <hr>
    <?php
    // para criar variáveis em PHP basta usar o sinal de $
    // variáveis em PHP são NÃO tipadas, não precisa declarar o tipo (texto, números, booleanas)
    // ao atribuir valor para a variável a tipagem é automática
    $nome = "João"; // criação da variável com o valor textural "João"
    $idade = 25; // criação de variável com o valor numérico 25
    $ativo = true; //criação da variável ativo com o valor booleano true
    $salario = 1520.68; // variavel numérica - decimal (float - double)
    $status = null; // variável null
    //$endereço; // Variável Undefined, não é possível declarar uma variável sem atribuir um valor a ela, não existe Undefined em PHP

    // Dicas para Criação de Variáveis
    // Não inicie o nome de uma variável com números 
    // Não utilize espaços em branco
    // Não utilize caracteres especiais, somente o underline
    // Crie variáveis com nomes que ajudarão a identificar melhor a mesma
    // Evite utilizar letras maiúsculas.
    
    //Exibir as variáveis na tela
    echo "Nome: $nome <br>";
    echo "Idade: $idade <br>";
    echo "Ativo: $ativo <br>";
    echo "Salario: $salario <br>";
    echo "Status: $status <br>";

    echo "<br><h3> Constantes </h3>";
    // Constantes são representadas pela palavra "const" ou "define" seguidas do nome da constante
    // Exemplo de constantes
    const PI = 3.14; //  Constante do tipo Number (float)
    const EMPRESA = "Google"; //Constante do tipo String
    define("SITE", "www.google.com"); //Declarção de constante do tipo String usando define 
    // Uma boa prática é utilizar letras maisúsculas para nomear constantes, para diferenciar das variáveis

    // Exibir as constantes na tela
    echo "Valor de PI: " . PI . "<br>";
    echo "Nome da Empresa: " . EMPRESA . "<br>";
    echo "Site: " . SITE . "<br>";

    // tentar alterar o valor de uma constante, isso irá gerar um errro de código, pois constantes não podem ser alteradas
    // PI = 3.14159; //isso é um erro
    // redeclarar uma constante também irá gerar um erro
    // const SITE = "www.google.com.br"; //isso é um erro

    // Regra de ouro: sempre coloque a instrção "declare(strict_types=1);" no início do seu código PHP
    // Isso blindará o seu sistema contra a mistura de tipos de dados.

    // Utilização de textos (Contatenação Vs Interpolação)

    // Exemplo de Contatenação => Juntar duas ou mais Strings utilizando p operador "."(ponto)
    echo "Olá, ".$nome ."! Seja bem-vindo ao nosso site! <br>";

    // Exemplo de Interpolação => Utilizando de variáveis entro de um texto, utilizando aspas duplas no texto
    echo "$nome, tem $idade anos e seu salário é r$ $salario reais. <br>"; //forma mais correta de misturar textos e variáveis

    ?>
    
</body>
</html>