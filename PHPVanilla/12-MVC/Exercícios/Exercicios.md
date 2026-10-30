# LISTA DE EXERCÍCIOS DE FIXAÇÃO E PRÁTICA - MVC

## Parte A: Questões Teóricas de Fixação

#### `O Colapso do Código Espaguete:` Explique por que manter consultas SQL, regras de validação e marcação HTML no mesmo arquivo inviabiliza a manutenção e a escalabilidade de um sistema corporativo.

Misturar SQL, validação e HTML cria um **forte acoplamento**. Qualquer alteração na tela exige mexer no banco de dados. Isso impede testes automatizados, facilita falhas de segurança e torna o projeto impossível de manter ou expandir.

---

#### `A Tríade MVC:` Qual é a função específica de cada um dos três componentes do padrão MVC (Model, View, Controller)? Qual deles deve conter as regras de negócio?

* **Model:** Cuida dos dados, do banco e das **regras de negócio**.
* **View:** Responsável apenas pela interface gráfica e exibição.
* **Controller:** Recebe a requisição, aciona o Model e chama a View.
* *Regras de negócio ficam exclusivamente no **Model**.*

---

#### `O Papel do Composer:` Diferencie o papel do arquivo composer.json do arquivo composer.lock. Por que a pasta vendor/ nunca deve ser versionada no Git?

O `composer.json` lista as dependências e regras do projeto. O `composer.lock` trava as **versões exatas** instaladas para garantir ambientes idênticos. A pasta `vendor/` não entra no Git por conter arquivos pesados de terceiros, facilmente recriados com `composer install`.

---

#### `A Especificação PSR-4:` Como o Autoloader PSR-4 consegue localizar o arquivo src/Controllers/ProdutoController.php a partir do namespace App\Controllers\ProdutoController?

O PSR-4 mapeia o namespace para a estrutura de pastas (ex: `App\` aponta para `src/`). Ele troca as barras do namespace (`\`) por barras de diretório (`/`) e adiciona `.php`:


$$\text{App}\backslash\text{Controllers}\backslash\text{ProdutoController} \longrightarrow \text{src/Controllers/ProdutoController.php}$$

---

#### `Front Controller:` Qual é a principal vantagem de segurança ao centralizar todas as requisições em public/index.php e isolar os arquivos-fonte do projeto fora da raiz pública da web?

Centralizar o tráfego no `public/index.php` aumenta a segurança. As regras do servidor bloqueiam o acesso direto aos arquivos-fonte (`src/`, `config/`), impedindo a exposição indesejada de lógicas de negócio ou credenciais.

---

#### `Roteador HTTP:` Como o objeto Roteador diferencia uma requisição GET /produtos de uma requisição POST /produtos?

O Roteador avalia dois parâmetros da requisição: o **método HTTP** (`$_SERVER['REQUEST_METHOD']`) e a **URI**. Assim, ele diferencia `GET /produtos` (exibir lista) de `POST /produtos` (cadastrar item) e chama a ação correta.

---

#### `Injeção de Dados na View:` Como a função nativa extract() atua no método renderizar() do Controller para disponibilizar variáveis para as Views?

A função `extract()` converte as chaves de um array associativo em **variáveis locais**. O Controller transforma `['produto' => $dados]` na variável `$produto`, enviando-a diretamente para renderização na View.

---

#### `Segurança contra XSS nas Views:` Por que todas as saídas dinâmicas exibidas em tabelas e formulários devem ser envolvidas com htmlspecialchars()?

O uso de `htmlspecialchars()` com `ENT_QUOTES` converte caracteres especiais (`<`, `>`, `"`) em entidades HTML seguras. Isso impede que scripts maliciosos injetados por usuários sejam executados pelo navegador.

---

#### `Single Responsibility no Controller:` Por que um Controller nunca deve conter comandos SQL com strings concatenadas ou conexões diretas via new PDO()?

Inserir SQL ou `new PDO()` no Controller viola o Princípio da Responsabilidade Única. Essa prática acopla a camada de controle ao banco, impede o reuso de consultas e inviabiliza testes unitários isolados.

---

#### `Transição para o Framework Laravel:` Identifique quais conceitos aprendidos neste MVC artesanal são exatamente os mesmos utilizados pelo Laravel 11.

Os conceitos centrais continuam os mesmos: **roteamento HTTP**, **arquitetura MVC**, **ponto de entrada único** (`public/index.php`), **autoloader PSR-4 via Composer** e **mecanismos de proteção** contra XSS e SQL Injection.