# Curso BackEnd -  1º Semestre - 105h

Prof. Diogo Barbosa

Escola SENAI Americana 

2º Semestre 2026

## Objetivos do Curso

- Desenvolver Aplicações web Server Side, utilizando a linguagem PHP;
- Aplicar Sintaxe nativa Php Vanilla;
- Manipulação HTTP;
- Persistência de Dados(Armazenamento em BD);
- Segurança contra SQL Injection/CSRF;
- Refatoração em POO (Programação Orientada Objeto);
- Arquitetura MVC;
- Utilização do FrameWork Laravel;

## Cronograma do Semestre

Carga Horária: 105h

Duração: 20 Semanas

### Semana 1: Introdução ao BackEnd e Configuração do Ambiente PHP

#### O que é BackEnd

O back-end é a parte de um site ou aplicativo que o usuário não vê, mas que faz tudo funcionar por trás das telas.

- Guarda e organiza informações em um banco de dados;
- Confere se o login e a senha estão corretos;
- Calcula valores, como o frete ou o total de uma compra;
- Garante que os dados de um usuário não apareçam para outro;
- Faz o sistema suportar muitas pessoas usando ao mesmo tempo, sem travar.

As principais linguagens utilizadas no desenvolvimento back-end são PHP, JavaScript/TypeScript, Python, Java, Kotlin, Go (Golang), C# e Rust. 

O backend é o "cérebro" oculto de um site ou aplicativo. Ele roda em um servidor e cuida de tudo o que o usuário não vê na tela.

**As 3 partes básicas de todo backend:**

1. **Servidor:** o "computador" que fica ligado esperando pedidos (requisições);
2. **Banco de dados:**  onde as informações ficam guardadas (usuários, produtos, mensagens, etc.);
3. **Lógica de negócio:**  as regras do sistema (ex: "não deixa comprar se não tiver estoque").

**O Mercado de Trabalho em Back-end**

O desenvolvimento Back-end é uma das áreas mais cruciais da Tecnologia da Informação. 

- Com a transformação digital acelerada, empresas de todos os portes e setores dependem de infraestruturas sólidas e seguras. 

- Setores de Atuação: Bancos, hospitais, e-commerces, logística, indústrias, startups e órgãos públicos utilizam Back-end para suportar suas operações críticas.

- Fatores de Crescimento: O avanço da computação em nuvem, aplicativos móveis, Big Data e IA impulsiona continuamente a busca por profissionais da área.

- Modelos de Trabalho: Alta flexibilidade com vagas presenciais, híbridas e remotas (inclusive com oportunidades internacionais).

#### Ciclo de Vida da Requsição HTTP

##### O que é HTTP

**HTTP**, Hypertext Transfer Protocol, é um protocolo de comunicação utilizado para transferência de informações na WWW(World Wide Web) e em outros sistemas de Redes.

O HTTP é a base para que o cliente e um servidor web troquem informações. Ele permite a requisição e a respostas de recursos, como imagens, arquivos e as própias páginas web, por meio de mensagens padrão (protocolo).

##### Como Funciona o HTTP

1. O cliente estabele contato com o servidor, encamihando uma requisição HTTP;
2. Nessa Requisição o cliente especifica o método pretendido (read-GET, create-POST, update-PUT/PATCH, delete-DELETE)
3. o Servidor processa e responde com uma mensagem HTTP, com os recursos solicitado.

```mermaid

graph TD

    A[Navegador]
    B[HTTP]
    C[Servidor]

    A --> |Request| B
    B --> |Request| C
    C --> |Response| B
    B --> |Response| A

```
---
#### Como funciona na prática o BackEnd
- **Ação do usuário:** Envia uma solicitação pela UI (Interface do Usuário). Exemplo de UI: Tela do celular, Navegador da Internet, Alexa, ...
- **Envio da requisição:** A UI transforma ação do usuário em uma requisição HTTP.
- **O Processamento BackEnd:** o Código BackEnd recebe o pedido, valida os dados e decide o que fazer (Ex: consulta uma informação no banco de dados).
- **Resposta:** o servidor devolve o resultado para UI (Ex: Um login autorizado, uma compra confirmado, uma música, ...).

## Tipos de Requisição HTTP
Os tipos de requisição HTTP indicam uma ação que o usuário deseja executar no servidor. As principais ações são: 

- **GET**: Pede dados de um lugar especifico. "Não Faz Alterações no Servidor"
- **POST:** Envia dados novos para *criar* algo ou processar informações.
- **PUT/PATCH:** Modificar dados ja existentes. *PUT* Atualização Total dos dados. *PATCH* Atualização Parcial dos dados.
- **DELETE:** Apaga um dado do Servidor



---

### Iniciando o PHP

### O que é PHP

**PHP** (Hypertext PreProcessor) é uma liguagem de programação interpretada e open source, focada no desenvolvimento de sistemas para web, pode ser usada junto com HTML para criação de págians web dinâmicas.

### Instalando o PHP

- Fazer o Download do PHP (php.net);
- ZIP - Non Thread Safe 8.5
- Descompactar o arquivo do PHp na pasta C:\src\php (Para descompactar, usar 7zip)
- Modificar o arquivo php.ini-development para => php.ini (criar as configurações do PHP na máquina) - adicionar ou remover funcionalidades do PHP
- Adicionar a pasta do PHP (C:\src\php) as Variaveis de Ambiente do Sitema (PATH) 
- Verificar a instalação rodando o comando php --version

### Contextualizando o PHP

O PHP de fato é uma das linguagens de programação mais populares da atualidade. Ela permite que você crie aplicações web robustas, muito simplificada direto ao ponto. Sem contar que a linguagem traz diversos recursos que facilitam e aceleram o processo de desenvolvimento de sites e sistemas para web. E além do mais, ela ainda tem um ótimo ecossistema, uma excelente comunidade e um grande mercado de trabalho.

### Criando minha primeira aplicação em PHP

Criando um Hello, World!!!

### Criando o perfil de PHPVanilla

-> Profile -> New Profile
-> Extensions:
- PHP IntePhense (A do elefantinho) : Autocomplear (snipets)
- PHP Debug (Xdebug): Acha erros em linha de código
- PHP CS FIXER: Formatação padrão do código (identação)
- PHP Serve: Sobe um serivdor local para acompanhamento em tempo real
---
### Estudo de Constantes e Variáveis em PHP 

Declarar variáveis é alocar um espaço na memória que permite a inclusão e manipulaçã de dados.

**Variáveis**

- devem ser declarados usando "$" antes do nome da variável
- podem ser String, Numérica (Integer e floar), Booleanas e Nulas. Não permite a declaração de Undefined
- são não tipadas (não precisa declarar um tipo na criação), a tipagem é atribuida ao adicionar o valor
- usar o "declare(strict_types=');" na primeira linha do arquivo ; => blindar o sistema contra conflitos de tipos de variáveis.

**Constantes**

- não podem ser modificadas ou redeclaradas após a criação
- pode ser criada usando "const" ou "define"
- não permitem interpolação

---

### Semana 2 - Operadores em PHP (Aritméticos, Relacionais e Lógicos)

### Estudo de Operadores 

 **Aritméticos**: São usados para realizar cálculos.
 
 | Operador | Nome | Exemplo | Resultado |
 | - | - | - | - |
 | + | Adição| 10 + 5 | 15 |
 | - | Subtração | 10 - 5 | 5 |
 | * | Multiplicação | 10 * 5 | 50 |
 | / | Divisão | 10 / 5 | 2 |
 | % | Módulo (Resto) | 10 % 3 | 1 (10 div 3 da 3, sobra 1) |
 | **| Expoente | 2 ** 3 | 8(2 elevado a 3) |
 
 
 `obs:` O Operador é o melhor  amigo de um programador, permite ordenar listas e organizar fila e pilhas.

 **Relacionais**: São utilizados para comparar e relacionar dois ou mais valores ou informações, o resultado de uma operação relacional é sempre uma booleana (true, false)

 | Operador | Nome | Exemplo | Resultado |
 | - | - | - | - |
 | < | Menor que | 5 < 10 | True |
 | > | Maior que | 5 > 10 | False |
 | <= | Menor ou igual | 10 <= 5 | False
 | >= | Maior ou igual | 18 >= 18 | True |
 | == | Iguais | "10"==10 | False |
 | === | Igualdade Estrita | "10"===10 | False |
 | != | Diferente | "10"!=10 | False |
 | !== | Diferença Estrita |"10"!==10 | True |

 **Lógicos**: Permite a combinação entre sentenças.

 - operador `AND` (E) => && : para o resultado ser verdadeiro, TODAS as Combinações precisam ser verdadeiras
  - true && true => true
  - true && false => false

  - Operador `OR` (OU) => || : para o resultado ser verdadeiro, basta APENAS UMA condição ser verdadeira
  - false || true => true
  - false || false => false

  - Operador `NOT` (Não) => ! : Inverte a lógica da Sentença
  - !true => false
  - !false => true 
  --- 
### Semana 3 - Estrutura de Controle de Dados (Condicionais e Repetição)

- **Conteúdo**: Extruturas `if`, `else`,`elseif`, operadores ternários, `match` => substituto do `switch/case`, loops `for`, `while`, `do-while` e `foreach`

#### Estrutura de Controle de Dados ajudam no precesso de automatização em programa e sistemas

#### Condicionais (IF, ELSE, ELSEIF)

- **Forma de Uso**: 

- Uso do `if` apenas:
Exemplo: aplicar uma desconto do 10% em comprar acima de 100 reais;

```mermaid

graph LR
    A[comando] --> B[condição] --> C[Tomada de Decisão]

```

```php
if ($valorCompra > 100) {
    $valorCompra = $valorCompra * 0.1
}
```

- Uso do `if` seguido do `else`
Exemplo: aplicar um desconto de 10% para compras de acima de 100 reais e 5% para as demais compras

```mermaid

graph LR
    A[Comando] --> B{Condição}
    B --> |true| C[Ação 1]
    B --> |false| D[Ação 2]

```

```php
 if($valorCompra > 100) {
    $valorFinal = $valorCompra*0.1;
 } else{
    $valorFinal = $valorCompra*0.05;
 }

 ```

- Uso do `elseif` (Encadeado)
Exemplo: Compras acima de 200 reais tem 15% de desconto, acima de 100 reais 10% de desconto e qualquer outra compra vai ter 5% de desconto

```mermaid

graph LR
    A[Comando] --> B{Condição}
    B --> |true| C[Ação 1]
    B --> |false| D{Condição 2}
    D --> |true| E[Ação 2]
    D --> |false| F[Ação 3]

```

```php
if($valorCompra > 200){
    $valorFinal = $valorCompra*0.85;
} elseif($valorCompra > 100) {
    $valorFinal - $valorCompra*0.9;
} else {
    $valorFinal = $valorCompra*0.95;
}

```

*Obs*: sempre usar `elseif` para situações que precisam de mais de uma condição, ou seja, fazer encadeamento das condições.

- Uso **ERRADO** do if

Não fazer o encadeamento de condicionais

```php
if($valorCompra > 200) {
    $valorFinal = $valorCompra*o.85;
}
if($valorCompra > 100) {
    $valorFinal = $valorCompra*0,90;
}
if($valorCompra < 100) {
    $valorFinal = $valorCompra*0.95;
}

```

#### Operadores Ternários
Um atalho para a estrutura condicional `if/else`, normalmente escrito em uma única linha de código

` condição ? verdadeira : falso`

Perfeito para decisões curtas de uma linha de comando
Exemplo: Verificar se a pessoa é maior de idade (18)

```php

$idade = 20;
//O formato é : (Condição) ? Verdadeiro : Falso;

$status = ($idade >= 18) ? "Maior de Idade" : "Menor de Idade;
$status2 =($idade<18) ? "Criança" : ($idade<60) ? "Adulto" : "Idoso";

```

#### Expressão Condicional `match` (PHP 8)

No mercado de PHP atual não se usa mais uma de zena de `if/elseif` para checar valores fixos, e o antgo `switch/case` caiu em desuso. Agora usamos o `match`. Ele retorna diretamente o resultado.

```mermaid

graph LR
    A[Valor] --> B{ondicional}
    B --> C[Ação 1]
    B --> D[Ação 2]
    B --> E[Ação 3]
    B --> F[Ação 4]
    B --> G[...]
    B --> H[Ação default]
```

```php
$diaSemana = date("Week"); //Pega o dia da semana em formato numérico

//Transformar dia da semana em formato texto (Domingo,Segunda,...)

$nomeDiaSemana = match($diaSemana){
    "0" => "Domingo",
    "1" => "Segunda",
    "2" => "Terça",
    "3" => "Quarta",
    "4" => "Quinta",
    "5" => "Sexta",
    "6" => "Sábado",
    "defaut" => "Dia Inválido
};

```

---

##### Laços de Repetição

Um laço de repetição faz com que um bloco de códigos rode várias vezes, até que uma condição mande parar.

- o laço `while` (Enquanto)

Ele verifica se a cndição é verdadeira ANTES de entras no laço. Ideal quando você não sabe quantas vezes vai rodar o laço.

```mermaid 

flowchart LR
    A[Início] --> B{Condição}
    B --true--> C[Executa o Laço]
    C --> B
    B --false--> D[Interrompe o Laço]

```

Exemplo (While): Jogo de Adivinhação de um nº Secreto   

```php

$numeroSecreto = 7;

$tentativas = 0;

while($tentativa != $numeroSecreto){
    echo "Tente Novamente"
    //vou pegar um nº aleatório entre 1 e 10
    $tentativa = rand(1,10); 
}

echo "Acertou! o nº secreto é $numeroSecreto";

```

- O laço `do-while` (Faça Enquanto)

A diferença é que ele executa o bloco pelo menos uma vez, mesmo que a condição seja falsa desde o início, pois ele só pergunta no final

```mermaid

flowchart LR

A([Início]) --> B[Execuar Ação]
B --> C[Condição]
C --true--> B
C --false-->D([Fim])

```

Exemplo: Jogo de Adivinhação

```php
$numeroSecreto = rand(1,10)

do {
    $tentativa = rand(1,10); //Simular um palpite aleatório

    if($tentativa == $numeroSecreto){
        echo"Parabéns, Acertou!";
    }
} while ($tentativa != $numeroSecreto);

```

obs: uso ideal do `do-while`, menus de sistema ou solicitações de dados, sistemas interativos; 

---

#### O Freio de Emergência: `break` e `continue`

Às vezes precisamos interferir no laço enquanto ele está rodando

- `break`=> **Para Tudo"** Quebra o laço inteiro e vai embora
- `continue`=> **Pula a rodada** Ele ignora código daquela rodada especifica e pula logo par a próxima repetição.

Exemplo de Aplicação do Código: Sistema de Controle do Elevador

```php 

for($andar = 1 ; $andar<=10; $andar++){
    if($andar ==4){
        echo "Andar $andar está em obras. Passando direto!";
        continue;
    }

    echo "Elevador parou no andar $andar"
}

```
---

##### Laço de Repetição `for`

Use o `for`quando você sabe qunatas vezes precisa repetir uma ação ou quando precisa controlar um contador. Ele possui 3 partes:

- inicialização;
- condição;
- incremento;

Sintaxe:

for(inicialização; condição; incremento;){
    Ação
}

```mermaid 
flowchart LR
A[Início: i=0] --> B{i<10?}
B --true--> C[aAção]
C --> D[i++]
B --false--> E[FIM]
```

Exemplode aplicação: Exibir todos os meses do ano

```php
for($mes=1;$mes<=12;$mes++){
    echo "Mês $mes";
}
```
Nesse exemplo, `$mes` o laço continua enquanto o `$mes` for menor ou igual a 12 e, ao final de cada repetição, `$mes` aumenta o contador em 1

#### Laço de Repetição `foreach`

Use o `foreach` quando precisar percorrer cada item de um **array**. Ele acessa os elemntos diretamente sem que você precise controlar diretamente o contador.

Exemplo: Imprimir todos os itens de um vetor.

```php
$frutas = ["Maça","Banana","Uva","Laranja"];

foreach($frutas as $fruta){
    echo "Fruta:" $fruta;
}
```

Outro Exemplo: Acessar a chave e o valor de cada intem:

```php
$preços = [
    "Caderno" => 25.00,
    "Caneta" => 5.50,
    "Mochila" => 99.00
]; // Vetor não ordenado do tipo chave(Key) => Valor(value) ===> Coleção/Dicionário

//Percorrer o vetor usando o laço foreach
foreach($preços as $produto=>$preço){
    echo "$produto; R$" . number_format($preço,2);
}
// Acessa a chave e o valor de cada item do vetor

```

---
---

#### Desafio : Simuladr de cobrança (FINANSENAI)

#### Desafio Final

---
---

### Semana 4 - Modularização com Funções

#### Principio do DRY (Don't Repeat Yourself)

Se uma lógica foi escrita duas ou mais vezes dentro de um código, essa lógica deve virar uma função.

#### Funções Nativas do PHP

O PHP tem milhares de funções prontas, essa função já criada é chamada de função nativa.

- **O que é uma função?**

Uma função é como uma máquina: você coloca a matéria-prima (Parâmetro), ela processa e devolve um produto final (Retorno)

Exemplo de Função Nativa

```php
$texto = "senai americana";

// usar uma função nativapara substituição de parte do texto ==> str_replace
$textoNovo = str_replace("americana", "são paulo", $texto);
// "senai são paulo"

// usar uma função nativa para substituição das letras minúsculas por letras maiúsculas => strtoupper
echo strtoupper($textonovo); // SENAI SÃO PAULO
```

#### Principais Funções Nativas (Mais Utilizadas)

As funções abaixo já fazem parte do PHP e podem ser chamadas diretamente no código. Observe os parâmetros que cada uma recebe e o tipo de informação que ela retorna.

| Função | Categoria | O que faz | Como usar |
|---|---|---|---|
| `strlen()` | Strings | Retorna a quantidade de caracteres de um texto. | `$tamanho = strlen($texto);` |
| `strtoupper()` | Strings | Converte o texto para letras maiúsculas. | `$resultado = strtoupper($texto);` |
| `strtolower()` | Strings | Converte o texto para letras minúsculas. | `$resultado = strtolower($texto);` |
| `ucfirst()` | Strings | Converte a primeira letra do texto para maiúscula. | `$resultado = ucfirst($texto);` |
| `trim()` | Strings | Remove espaços e quebras de linha no início e no fim do texto. | `$limpo = trim($texto);` |
| `str_replace()` | Strings | Substitui uma parte do texto por outra. | `$novo = str_replace("-", "", $cpf);` |
| `substr()` | Strings | Extrai uma parte do texto a partir de uma posição. | `$inicio = substr($texto, 0, 3);` |
| `explode()` | Strings | Divide um texto e cria um array usando um separador. | `$palavras = explode(" ", $nome);` |
| `implode()` | Arrays | Junta os itens de um array em um único texto. | `$lista = implode(", ", $nomes);` |
| `count()` | Arrays | Conta a quantidade de itens de um array. | `$total = count($produtos);` |
| `in_array()` | Arrays | Verifica se um valor existe dentro de um array. | `$existe = in_array("SP", $estados, true);` |
| `array_push()` | Arrays | Adiciona um ou mais itens ao final de um array. | `array_push($nomes, "Ana");` |
| `array_pop()` | Arrays | Remove e retorna o último item de um array. | `$ultimo = array_pop($nomes);` |
| `sort()` | Arrays | Ordena um array em ordem crescente e reorganiza suas chaves. | `sort($notas);` |
| `array_keys()` | Arrays | Retorna um array contendo as chaves de outro array. | `$chaves = array_keys($produtos);` |
| `number_format()` | Números | Formata um número com casas decimais e separadores definidos. | `$preco = number_format($valor, 2, ',', '.');` |
| `round()` | Números | Arredonda um número para a quantidade de casas informada. | `$media = round($nota, 2);` |
| `max()` | Números | Retorna o maior valor de uma lista ou array. | `$maior = max($notas);` |
| `min()` | Números | Retorna o menor valor de uma lista ou array. | `$menor = min($notas);` |
| `is_numeric()` | Validação | Verifica se o valor é um número ou uma string numérica. | `if (is_numeric($entrada)) { ... }` |
| `isset()` | Validação | Verifica se uma variável existe e não possui valor `null`. | `if (isset($usuario)) { ... }` |
| `empty()` | Validação | Verifica se uma variável está vazia. | `if (empty($pedido)) { ... }` |
| `date()` | Data e hora | Formata uma data ou hora conforme uma máscara. | `$hoje = date('d/m/Y');` |
| `file_exists()` | Arquivos | Verifica se um arquivo ou diretório existe. | `if (file_exists('dados.txt')) { ... }` |
| `file_get_contents()` | Arquivos | Lê todo o conteúdo de um arquivo ou endereço. | `$conteudo = file_get_contents('dados.txt');` |
| `file_put_contents()` | Arquivos | Grava conteúdo em um arquivo, criando-o se necessário. | `file_put_contents('log.txt', $mensagem);` |

**Atenção:** algumas funções modificam o array original, como `sort()`, `array_push()` e `array_pop()`. Já outras retornam um novo valor, como `count()`, `explode()` e `str_replace()`. Em caso de dúvida, consulte a documentação oficial do PHP e verifique o retorno da função.

#### Documentação do PHP

[Acesse a documentação oficial do PHP em português](https://www.php.net/manual/pt_BR/)

Conculte também a [referência de funções do PHP em] (https://www.php.net/manual/pt_BR/funcref.php) para pesquisar a sintaxe, os parâmetros e os valores para cada função

#### Funções Customizadas (Criando suas próprias máquinas)

Quando o PHP não tem a função que queremos, nós a criamos!

**A Regra de Ouro**: Uma função deve focar em `return` (retornar um valor), e não imprimir (`echo`)

Veja a Diferença nesse exemplo:

```php
function calcularTotal($preco, quantidade){
    // a função calcula e retorna o resultado, mas não imprimi nada
    return $preco * quantidade;
}

$total = calcularTotal(25.00, 3);

// imprimir é feito fora da função
echo "Total da compra: R$ " .round($total,2);
//Total da compra: R$ 75.00
```

A função `calcularTotal()` pode ser reutilizada em uma página, relatório ou teste. O `echo` aparece somente fora da função, no momento de apresentar o resultado para o usuário.

##### Padrão de uso corporativo (PHP 8 Strict Types)

No mercado de trabalho, exigimos que a função avise exatamente o **TIPO** de dado que ela espera receber e o **TIPO** de dado que ela vai devolver.

Isso é chamado de **tipagem de funções**. Ao declarar os tipos, o códigos fica mais fácil de entender e o PHP consegue identificar alguns erros antes que eles causem problemas maiores no sistema.

Os tipos mais usados:

* `int`: número inteiro, `10` ou `1024`;
* `float`: número decimal ou ponto flutuante, `10.90`;
* `string`: texto, como: `"Maria"`;
* `bool`: valor lógico, `true` ou `false`;
* `void`: identifica que a função não devolve nenhum valor;


O tipo deve ser escrito antes do nome de cada parâmetro e o tipo da função deve ser escrito após os parênteses, precedido do ":", informando o que a finção vai devolver

Exemplo de uso de função e parâmentros tipados:

```php
function apresentarProduto(string $nome, float $preço): string{
    return "$nome custa R$ $preco";
}

$mensagem = apresentarProduto("Caderno",25.00);
echo $mensagem;
// Caderno custa R$ 25.90
```

> **Resumo**: os tipos dos parâmetros documentam as entradas da função, o tipo após `:` documenta a saida da função.

##### O Tipo Mágico: `VOID`

se uma função faz um trabalho interno e **não retorna NADA**, dizemos que o retorno dela é "vazio" (`void`).

Exemplo de função sem retorno:

```php
function registraLog(string $mensagem): void{
    //apenas salvar em um arquivo de texto, não devolver nenhuma variável
    file_put_contents("erro.log", $mensagem);
}
```

#### escopo e referência (O Segredo da Memória)

##### O que é Escopo? (A Regra de Las Vegas)

*O que acontece dentro da função, fica dentro da função*. Uma variável criada fora não existe la dentro, e uma criada lá dentro morre quando a função acaba.

**Escopo** é o local do programa onde a variável pode ser armazenada/acessada. em PHP, uma variável criada fora de uma função pertence ao *escopo global*, uma variável criada dentro de uma função pertence ao *escopo local*.

Exemplo de Escopo de variável:

```php
$nomeSistema = "CRM SENAI"; //variável global

function criarMensagem(string $nome): string{
    $mensagem = "Bem-Vindo!!!";
    return $mensagem . $nome;
}

echo $nomeSistema; // Correto: está no escopo global
// echo $mensagem //Errado: $mensagem só existe dentro da função, não é acessada fora
echo criarMensagem("Nome do Fulano"); // Correto: A função devolve sua variável local
// CSM SENAI
// Bem-Vindo! Nome do Fulano
```

* *Como Enviar Dados Para Uma Função?*

A forma mais segura e organizada é enviar os dados por **Parâmetros. Assim, a função não precisa acessar diretamente variáveis globais:

```php

function saudar(string $nome):string{
    return "Olá, $nome!";
}

$nomeCliente = "João";
echo saudar($nomeCliente); // Olá João!
```

Nesse Caso, `$nomeCliente` continua no escopo global, mas seu valor é enviado para o parâmentro local `$nome`. A função recebe uma informação, processa e retorna o resultado.

**Exemplo Incorreto**

```php
$nome = "João"; //variável global

function saudar() :string{
    return "Olá, $nome": // Errado: a função não reconhece a variável global
}
```

A função `saudar()`não conhece a variável global `$nome`. Ocasionando um erro no sistema.

> **Resumo**: variáveis protegem os dados internos da função; parâmetros são o caminho recomendado para ecitar Erros e enviar Informações, e `return` é usado para devolver um resultado ao código que chamou a função