# LISTA DE EXERCÍCIOS DE FIXAÇÃO E PRÁTICA - Controllers e Routes no LARAVEL

## Parte A: Questões Teóricas de Fixação

#### ***1. Semântica RESTful:*** Por que uma ação de exclusão de dados nunca deve ser implementada através de uma requisição HTTP do tipo GET? Explique o risco associado a robôs de busca.

Resposta: O `GET` deve ser seguro e idempotente, servindo apenas para leitura. Usá-lo para excluir dados viola o protocolo REST. O risco ocorre com robôs de busca (*crawlers*), que indexam links navegáveis e podem acionar requisições `GET` de exclusão acidentalmente, apagando dados em produção.

---

#### ***2. Idempotência:*** O que significa o conceito de idempotência no protocolo HTTP e por que o método PUT é considerado idempotente enquanto o POST não é?

Resposta: Idempotência significa que múltiplos disparos de uma mesma requisição produzem exatamente o mesmo efeito final. O **`PUT` é idempotente** porque sobrescreve o recurso no ID exato repetidas vezes sem alterar o resultado final. Já o **`POST` não é**, pois cada envio cria um novo registro, gerando duplicidade.

---

#### ***3. Resource Controllers:*** Quais são as 7 ações canônicas geradas pelo comando php artisan make:controller --resource e qual é a responsabilidade de cada uma?

1. **`index()`**: Lista os registros.
2. **`create()`**: Exibe o formulário de cadastro.
3. **`store()`**: Salva o novo registro no banco.
4. **`show($id)`**: Exibe um registro específico.
5. **`edit($id)`**: Exibe o formulário de edição.
6. **`update(...)`**: Atualiza o registro existente.
7. **`destroy($id)`**: Remove o registro.

---

#### ***4. Injeção de Dependências:*** Como o Service Container do Laravel entrega automaticamente uma instância de Request ao método do controller sem que tenhamos que instanciá-la com new Request()?

Resposta: O Laravel usa o **Service Container** e o Reflector do PHP para ler a assinatura dos métodos do controller. Ao detectar uma tipagem como `Request`, o container instancia automaticamente a classe e a injeta na execução, eliminando a necessidade de usar `new Request()`.

---

#### ***5. Method Spoofing:*** Por que os navegadores web não conseguem enviar requisições nativas de PUT e DELETE através de formulários HTML convencionais? Como o Laravel contorna essa limitação?

Navegadores suportam apenas `GET` e `POST` em formulários HTML. Para usar verbos como `PUT` ou `DELETE`, o Laravel utiliza **Method Spoofing**: um campo oculto (`_method` ou diretiva `@method`) envia a intenção real via `POST`, que é interpretada corretamente pelo framework.

---

#### ***6. Ataques CSRF:*** O que é um ataque do tipo Cross-Site Request Forgery e como a diretiva Blade @csrf impede que sites maliciosos forjem requisições em nome do usuário?

O **CSRF** induz um usuário autenticado a executar ações maliciosas sem consentimento em uma aplicação confiável. A diretiva `@csrf` injeta um token criptográfico secreto na sessão e no formulário. Como sites externos não conseguem ler esse token, requisições forjadas são bloqueadas.

---

#### ***7. Constraints de Rota:*** Para que servem métodos de restrição como whereNumber('id') ou whereAlphaNumeric('codigo') e qual código de status HTTP o Laravel retorna quando o formato é violado?

Constraints como `whereNumber('id')` validam o formato dos parâmetros antes de atingirem o controller. Se a regra for violada (ex: passar letras onde se espera número), a rota não é encontrada e o Laravel retorna automaticamente um status HTTP **`404 Not Found`**.

---

#### ***8. Rotas Nomeadas:*** Cite duas vantagens corporativas de utilizar a função auxiliar route('clientes.show', $id) nas views em vez de escrever strings estáticas como "/clientes/{$id}".

Usar `route('clientes.show', $id)` em vez de strings como `"/clientes/{$id}"` traz duas grandes vantagens:

1. **Manutenibilidade:** Se a URL mudar em `web.php`, o sistema se atualiza sozinho sem quebrar views.
2. **Segurança:** Evita erros de digitação comuns em caminhos estáticos.

---
#### ***9. Single Responsibility no Controller:*** Por que a validação de formulários com $request->validate() ou Form Requests deve ser mantida enxuta dentro do controller para respeitar o limite de 20 linhas por função?

Manter o controller enxuto respeita o **Princípio da Responsabilidade Única (SRP)**. Ao delegar validações pesadas para Form Requests e regras de negócio para serviços, o código fica limpo, testável, reutilizável e fácil de manter dentro de um limite saudável de linhas.

---

#### ***10. A Ferramenta route:list:*** Como o comando php artisan route:list auxilia equipes multidisciplinares a documentar e auditar os endpoints disponíveis em uma API ou aplicação web?

O comando `php artisan route:list` exibe uma tabela completa com todos os endpoints, métodos, rotas nomeadas e middlewares da aplicação. Ele é essencial para equipes auditarem rotas, documentarem a API e validarem a segurança dos acessos rapidamente.

---