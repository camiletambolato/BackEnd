# Lista de Exercícios: Funções em PHP

### Parte A: Exercícios Teóricos

#### 1. Conceito e função:
Uma **função** é um bloco reutilizável de código que executa uma tarefa específica. Suas principais vantagens são a **reutilização do código** (evita repetições) e a **facilidade de manutenção** (ajustes são feitos em um só lugar).

#### 2. Princípio DRY:
Repetir o mesmo bloco de código **pode deixar o código maior que o necessário e com mais chances de erro também**. Uma função pode facilitar ao deixar o código mais compacto limpo e seguro, e caso seja necessário mudar um valor você só terá que altera-lo uma única vez.

#### 3. Parâmetros e retorno
Os parâmetros são os valores que uma função recebe para realizar seu trabalho. O valor retornado é o resultado produzido pela função.

Na função:

```php
function calcularTotal(float $preco, int $quantidade): float {
    return $preco * $quantidade;
}
```

`$preco` e `$quantidade` são os parâmetros.
O resultado de `$preco * $quantidade` é o valor retornado pela função, que será do tipo float.

#### 4. Tipagem

Na declaração:

```php
function cadastrar(string $nome, int $idade): bool
```
- cadastrar → nome da função.

- string → tipo do parâmetro $nome.

- $nome → parâmetro que recebe o nome.

- int → tipo do parâmetro $idade.

- $idade → parâmetro que recebe a idade.

- bool → tipo do valor que a função deve retornar.


#### 5. void e return

Uma função que retorna string produz e devolve um texto para quem chamou a função.

Exemplo:

```php
function saudacao(): string {
    return "Olá!";
}
```

Uma função void não retorna um valor. Ela pode, por exemplo, realizar uma ação.

```php
function mostrarMensagem(): void {
    echo "Olá!";
}
```


#### 6. Escopo

A função não consegue acessar `$cliente` diretamente porque essa variável foi **criada fora da função**. Ela pertence ao **escopo global**, enquanto a função possui seu próprio escopo.

Uma forma recomendada é passar a variável como parâmetro:

```php
$cliente = "Mariana";

function exibirCliente(string $cliente): string {
    return $cliente;
}

echo exibirCliente($cliente);
```

Outra forma seria usar global:

```php
$cliente = "Mariana";

function exibirCliente(): string {
    global $cliente;
    return $cliente;
}
```

A forma mais recomendada é passar a variável como parâmetro, pois deixa a função mais independente e fácil de reutilizar.

#### 7. Referência

Quando usamos:

`float &$valor`

o parâmetro é passado por referência. Isso significa que a função pode alterar diretamente a variável original.

Sem referência:

```php
function alterar(float $valor): void {
    $valor = 50;
}
```

somente uma cópia é alterada.

Com referência:

```php
function alterar(float &$valor): void {
    $valor = 50;
}
```

a variável original também passa a valer 50.

#### 8. Funções nativas

Função	Categoria	Finalidade	Parâmetros principais	Retorno
strlen()	Strings	Obtém o tamanho de uma string	Uma string	int
strtolower()	Strings	Converte texto para minúsculas	Uma string	string
trim()	Strings	Remove espaços do início e do fim	Uma string	string
count()	Arrays	Conta elementos	Array ou objeto Countable	int
max()	Arrays/Números	Encontra o maior valor	Valores ou array	Valor encontrado

#### 9. Previsão de saída

O resultado será:

- 90
- 100

A função recebe `$valor`, que vale 100, e calcula `100 * 0.90`, retornando 90.

A variável `$valor` continua valendo 100, porque o parâmetro não foi passado por referência. Portanto, a função não altera a variável original.

#### 10. Documentação - **strlen()**

Segundo a documentação oficial do PHP, a sintaxe é:

```php
strlen(string $string): int
```
**Parâmetro** : `$string`, do tipo string.
**Retorno**: `int`, correspondente ao tamanho da string em bytes.

Documentação oficial do PHP — strlen()
