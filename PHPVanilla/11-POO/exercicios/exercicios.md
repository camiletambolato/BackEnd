### 1. Procedural vs. OO: Riscos de Arrays Associativos e Scripts Procedurais

Manter regras financeiras críticas em arrays associativos e funções/scripts procedurais traz três riscos técnicos centrais:

1. **Ausência de contrato de estrutura e tipos (falta de esquema rígido):** Chaves de arrays podem ser digitadas incorretamente (`'sldo'` em vez de `'saldo'`), omitidas ou receber tipos inesperados sem erro imediato, gerando bugs silenciosos em cálculos financeiros.
2. **Acoplamento fraco e regras espalhadas:** Regras como limite de saque, taxa de transferência ou saldo mínimo acabam duplicadas em vários pontos do código ou misturadas a controle de fluxo e saída (HTML/JSON), dificultando auditoria e manutenção.
3. **Dificuldade de garantir invariantes e evolução do domínio:** Como qualquer trecho de código pode alterar um array diretamente, torna-se difícil impedir estados inválidos (como saldo negativo indevido) ou introduzir variações de comportamento (como diferentes tipos de conta) sem refatorações arriscadas e `if/else` extensos.

---

### 2. Ciclo de Vida do Objeto: Memória Heap e `__construct()`

Quando `new ContaCorrente(...)` é executado no PHP:

* **Alocação no Heap:** O motor do PHP reserva um espaço na memória **Heap** para armazenar a nova instância do objeto e os valores de suas propriedades (em oposição à pilha de chamadas de função/escopo local). A variável recebe apenas uma referência (identificador/ponteiro) para esse bloco no Heap, e não uma cópia completa do objeto ao ser passada entre funções.
* **Papel do `__construct()`:** Logo após a alocação e inicialização padrão das propriedades, o PHP invoca automaticamente o método mágico `__construct()`. Ele serve para **estabelecer o estado inicial válido** do objeto — recebendo dependências e dados obrigatórios (como titular, número da conta ou saldo inicial) e validando invariantes antes de o objeto ficar disponível para uso.

---

### 3. A Pseudo-Variável `$this` vs. Variável Local `$saldo`

* **`$this->saldo`:** Acessa uma **propriedade (atributo) pertencente à instância específica** que está executando o método no momento. Cada objeto criado com `new` tem seu próprio conjunto de propriedades no Heap; `$this` aponta para essa instância ativa.
* **`$saldo` (variável local):** É uma variável comum restrita ao **escopo daquele método ou função** (como um parâmetro recebido ou uma variável temporária criada dentro do bloco). Ao término da execução do método, ela é descartada e não altera o estado persistido no objeto.

Sem `$this->`, o PHP interpretaria `$saldo` como uma variável local não definida ou de escopo restrito, não como o estado interno da conta.

---

### 4. Encapsulamento e Invariantes: Por que Evitar `setSaldo(float $novoSaldo)`

Um método `setSaldo()` genérico quebra o **encapsulamento** porque expõe a alteração direta do estado interno sem exigir um motivo de negócio válido.

Em um domínio financeiro, o saldo nunca deve ser alterado arbitrariamente — ele deve mudar apenas como consequência de **operações de domínio** (como `depositar()`, `sacar()`, `transferir()` ou `aplicarRendimento()`). Cada operação carrega suas próprias regras e invariantes:

* Verificar se o valor é positivo;
* Validar saldo disponível, limite de cheque especial ou regras de rendimento;
* Registrar histórico/extrato ou disparar eventos de auditoria.

Com `setSaldo()`, qualquer chamador poderia forçar um saldo inválido ou contornar validações e registros contábeis.

---

### 5. Modificadores de Acesso: `private` vs. `protected` com `extends`

Quando uma classe filha estende uma classe pai (`extends`):

* **`private`:** O membro é acessível **apenas dentro da própria classe onde foi declarado**. Subclasses não conseguem acessá-lo diretamente (`$this->propriedadePrivada` na classe filha gera erro de visibilidade). Para manipular esse estado, a subclasse deve usar métodos `public` ou `protected` da classe pai.
* **`protected`:** O membro é acessível **dentro da própria classe e também dentro de qualquer subclasse** que a estenda (mas continua oculto para código externo fora da hierarquia).

Na prática, `protected` facilita a reutilização de estado ou métodos auxiliares entre classes irmãs/filhas, enquanto `private` protege com mais rigor contra alterações diretas nas subclasses.

---

### 6. Constructor Property Promotion (PHP 8+)

A **Constructor Property Promotion** permite declarar a visibilidade (`public`, `protected`, `private`), o modificador `readonly` e o tipo diretamente nos parâmetros do `__construct()`, eliminando a repetição da declaração das propriedades no corpo da classe e das atribuições `$this->prop = $prop;`.

Benefícios práticos:

* **Menos boilerplate:** Reduz linhas repetitivas, tornando classes de entidade e *Value Objects* mais curtas e fáceis de ler.
* **Fonte única da verdade:** Tipo, visibilidade e nome do parâmetro ficam concentrados no construtor, reduzindo o risco de desalinhamento entre propriedades e argumentos.

---

### 7. Propriedades `readonly` em Classes de Valor (`Titular`, `CPF`)

A palavra-chave `readonly` (introduzida no PHP 8.1) garante que uma propriedade tipada só possa ser **inicializada uma única vez** (em geral no construtor) e **não possa ser reatribuída ou modificada** depois disso.

Em classes de valor como `CPF` ou `Titular`:

* Garante **imutabilidade** do valor após a criação: ninguém consegue alterar acidentalmente o número de um CPF no meio de uma requisição.
* Torna o objeto mais previsível e seguro para ser compartilhado entre diferentes partes do sistema ou usado como chave/identificador sem risco de mutação silenciosa.

*(Nota: no PHP, `readonly` impede a reatribuição da propriedade em si; se a propriedade armazenar outro objeto mutável, o estado interno desse objeto interno ainda pode mudar a menos que ele também seja imutável.)*

---

### 8. Classes Abstratas: `ContaBancaria` vs. `ContaCorrente` e `ContaPoupanca`

Declarar `ContaBancaria` como `abstract` faz sentido porque:

1. **Conceito guarda-chuva sem instância concreta direta:** Na regra de negócio, uma conta genérica "abstrata" define o que toda conta tem em comum (como titular, número, saldo, depósito e transferência), mas não existe sozinha como um produto bancário completo sem regras específicas de modalidade.
2. **Obriga especialização e padroniza contratos:** `ContaBancaria` pode concentrar comportamentos comuns e declarar métodos abstratos (como regras específicas de saque ou limites) que `ContaCorrente` e `ContaPoupanca` são obrigadas a implementar conforme suas próprias regras.
3. **Impede instanciação acidental:** Evita que alguém faça `new ContaBancaria(...)` por engano sem escolher o tipo concreto da conta.

---

### 9. Polimorfismo em `transferir(float $valor, ContaBancaria $destino)`

A assinatura `ContaBancaria $destino` utiliza **polimorfismo por subtipo**: o método aceita qualquer objeto cuja classe seja `ContaBancaria` ou estenda `ContaBancaria` (como `ContaCorrente`, `ContaPoupanca`, `ContaSalario`, etc.).

O método `transferir()` não precisa saber qual é a classe concreta de `$destino` porque:

* Depende apenas da **interface pública** definida em `ContaBancaria` (por exemplo, chamar `$destino->depositar($valor)`).
* Em tempo de execução, o PHP faz o despacho dinâmico e executa a implementação correspondente ao tipo real do objeto `$destino`.
* Se um novo tipo de conta for criado no futuro estendendo `ContaBancaria`, `transferir()` continuará funcionando sem precisar ser alterado.

---

### 10. Exceções de Domínio vs. Retornar `false` ou `null`

Retornar `false` ou `null` quando um saque falha por falta de saldo é uma má prática porque:

1. **Falhas podem ser ignoradas silenciosamente:** Se o chamador esquecer de checar o retorno (`if (!$conta->sacar(...))`), o fluxo continua como se o saque tivesse ocorrido, causando inconsistências financeiras graves.
2. **Perda de contexto do motivo da falha:** Um booleano `false` ou `null` não informa *por que* falhou (saldo insuficiente, valor negativo, limite diário excedido ou conta bloqueada).
3. **Mistura fluxo normal com erro de regra de negócio:** Exceções de domínio (como `SaldoInsuficienteException`) interrompem o fluxo imediatamente, carregam informações claras sobre o erro e permitem que camadas superiores tratem ou traduzam a falha de forma explícita e consistente.