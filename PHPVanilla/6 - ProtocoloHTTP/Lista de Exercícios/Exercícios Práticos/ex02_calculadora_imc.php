<?php

// Define que o PHP deve usar tipos estritos.
// Isso ajuda a evitar erros relacionados aos tipos das variáveis.
declare(strict_types=1);


// Função responsável por calcular o IMC.
// Recebe o peso e a altura e retorna o resultado do cálculo.
function calcularIMC(float $peso, float $altura): float
{
    // Fórmula do IMC: peso dividido pela altura ao quadrado.
    return $peso / ($altura ** 2);
}


// Função responsável por classificar o resultado do IMC.
function classificarIMC(float $imc): string
{
    // Se o IMC for menor que 18.5, está abaixo do peso.
    if ($imc < 18.5) {
        return 'Abaixo do peso';
    }

    // Se o IMC for menor que 25, é considerado normal.
    if ($imc < 25.0) {
        return 'Normal';
    }

    // Se o IMC for menor que 30, é considerado sobrepeso.
    if ($imc < 30.0) {
        return 'Sobrepeso';
    }

    // Caso nenhuma das condições anteriores seja verdadeira,
    // o resultado será classificado como obesidade.
    return 'Obesidade';
}


// Pega o nome enviado pelo formulário.
// O trim() remove espaços desnecessários no começo e no final.
$nome = trim($_POST['nome'] ?? '');


// Pega o peso enviado pelo formulário.
// Caso não exista, deixa uma string vazia.
$pesoInput = $_POST['peso'] ?? '';


// Pega a altura enviada pelo formulário.
// Caso não exista, deixa uma string vazia.
$alturaInput = $_POST['altura'] ?? '';


// Array que vai armazenar possíveis mensagens de erro.
$erros = [];


// Variável que vai armazenar o resultado do cálculo.
// Começa como null porque ainda não foi calculado.
$resultado = null;


// Guarda a classe CSS que será utilizada no resultado.
$classeEstilo = '';


// Verifica se o formulário foi enviado pelo método POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Converte e valida o peso recebido.
    $peso = filter_var($pesoInput, FILTER_VALIDATE_FLOAT);

    // Converte e valida a altura recebida.
    $altura = filter_var($alturaInput, FILTER_VALIDATE_FLOAT);


    // Verifica se o nome foi preenchido.
    if (empty($nome)) {
        $erros[] = "O campo nome é obrigatório.";
    }


    // Verifica se o peso é inválido ou está fora do limite permitido.
    if ($peso === false || $peso < 20.0 || $peso > 300.0) {
        $erros[] = "O peso deve ser um valor numérico entre 20kg e 300kg.";
    }


    // Verifica se a altura é inválida ou está fora do limite permitido.
    if ($altura === false || $altura < 0.5 || $altura > 2.5) {
        $erros[] = "A altura deve ser um valor numérico entre 0.5m e 2.5m.";
    }


    // Só realiza o cálculo se não houver nenhum erro.
    if (empty($erros)) {

        // Calcula o IMC usando a função criada anteriormente.
        $imcVal = calcularIMC($peso, $altura);


        // Classifica o IMC.
        $classificacao = classificarIMC($imcVal);


        // Define uma classe CSS para cada classificação.
        $mapEstilos = [
            'Abaixo do peso' => 'amarelo',
            'Normal' => 'verde',
            'Sobrepeso' => 'amarelo',
            'Obesidade' => 'vermelho'
        ];


        // Pega a classe correspondente à classificação.
        $classeEstilo = $mapEstilos[$classificacao] ?? '';


        // Guarda os dados do resultado em um array.
        $resultado = [
            'imc' => $imcVal,
            'classificacao' => $classificacao
        ];
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <!-- Define a codificação dos caracteres da página. -->
    <meta charset="UTF-8">

    <!-- Título que aparece na aba do navegador. -->
    <title>Calculadora de IMC</title>


    <style>

        /* Estilização geral do corpo da página. */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }


        /* Caixa onde o resultado do IMC será exibido. */
        .box {
            padding: 15px;
            margin-top: 15px;
            width: 300px;
            font-weight: bold;
            border-radius: 5px;
        }


        /* Estilo para resultado considerado normal. */
        .verde {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }


        /* Estilo para abaixo do peso ou sobrepeso. */
        .amarelo {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }


        /* Estilo para obesidade. */
        .vermelho {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }


        /* Estilo das mensagens de erro. */
        .erro {
            color: red;
        }

    </style>

</head>


<body>

    <!-- Título principal da página. -->
    <h2>Calculadora de IMC</h2>


    <!--
        Verifica se existe algum erro.
        Se existir, mostra todos os erros em uma lista.
    -->
    <?php if (!empty($erros)): ?>

        <ul class="erro">

            <?php foreach ($erros as $e): ?>

                <!--
                    htmlspecialchars() protege o conteúdo
                    antes de colocá-lo no HTML.
                -->
                <li><?= htmlspecialchars($e) ?></li>

            <?php endforeach; ?>

        </ul>

    <?php endif; ?>


    <!-- Formulário responsável por enviar os dados. -->
    <form method="POST" action="">


        <!-- Campo para informar o nome. -->
        <p>
            <label>
                Nome:
                <input
                    type="text"
                    name="nome"
                    value="<?= htmlspecialchars($nome) ?>"
                >
            </label>
        </p>


        <!-- Campo para informar o peso. -->
        <p>
            <label>
                Peso (kg):
                <input
                    type="number"
                    step="0.1"
                    name="peso"
                    value="<?= htmlspecialchars((string)$pesoInput) ?>"
                >
            </label>
        </p>


        <!-- Campo para informar a altura. -->
        <p>
            <label>
                Altura (m):
                <input
                    type="number"
                    step="0.01"
                    name="altura"
                    value="<?= htmlspecialchars((string)$alturaInput) ?>"
                >
            </label>
        </p>


        <!-- Botão que envia o formulário. -->
        <button type="submit">Calcular</button>

    </form>


    <!--
        Só mostra o resultado se o cálculo tiver sido realizado.
    -->
    <?php if ($resultado !== null): ?>

        <!--
            A classe CSS muda de acordo com a classificação:
            verde, amarelo ou vermelho.
        -->
        <div class="box <?= $classeEstilo ?>">


            <!-- Exibe o nome do paciente. -->
            <p>
                Paciente:
                <?= htmlspecialchars($nome) ?>
            </p>


            <!--
                Exibe o IMC com duas casas decimais.
                number_format() também troca o ponto pela vírgula.
                Exemplo: 22,45
            -->
            <p>
                IMC:
                <?= number_format($resultado['imc'], 2, ',', '.') ?>
            </p>


            <!-- Exibe a classificação do IMC. -->
            <p>
                Classificação:
                <?= htmlspecialchars($resultado['classificacao']) ?>
            </p>


        </div>

    <?php endif; ?>

</body>

</html>