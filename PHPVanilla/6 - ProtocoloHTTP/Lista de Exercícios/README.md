## Parte A: Exercícios Teóricos de Fixação

#### `1. Diferença Estrutural`: Explique a diferença física entre onde os dados são anexados em uma requisição GET e em uma requisição POST.

**GET**: Os dados são anexados diretamente na URL na forma de uma query string. Eles trafegam no cabeçalho (header) da requisição HTTP.

**POST**: Os dados são empacotados e enviados dentro do corpo da requisição HTTP, permanecendo invisíveis na URL do navegador.

---

#### `2. Segurança e Privacidade`: Por que senhas de usuário nunca devem ser enviadas via método GET? Cite pelo menos dois locais onde essa senha ficaria gravada de forma insegura.

Parâmetros passados via GET expõem informações sensíveis na URL. Caso uma senha seja enviada por GET, ela fica gravada de forma desprotegida, por exemplo:

**Histórico do Navegador**: A URL completa com a senha em texto limpo fica armazenada no dispositivo do usuário.

**Logs do Servidor Web**: Servidores como Apache ou Nginx registram todas as URLs requisitadas nos seus arquivos de access.log.

**Cabeçalho Referer**: Ao clicar em qualquer link externo a partir dessa página, a URL inteira (com a senha) pode ser enviada para servidores de terceiros.

---

#### `3. Coalescência Nula`: Por que a instrução $nome = $_POST['nome']; dispara um Warning na primeira vez que a página é carregada no navegador? Como o operador ?? resolve isso?

Na primeira vez que uma página carrega, o formulário ainda não foi submetido. Tentar acessar $_POST['nome'] gera um Warning: Undefined array key "nome" porque essa chave simplesmente não existe no array global $_POST até o envio.

O operador de coalescência nula (??) verifica se a chave existe e não é nula antes de acessá-la, atribuindo um valor padrão caso contrário:

```php
// Retorna o valor de $_POST['nome'] se existir; caso contrário, atribui string vazia
$nome = $_POST['nome'] ?? '';
```

---

#### `4. Idempotência`: O que significa dizer que uma requisição GET é idempotente? Por que atualizar ou deletar dados no banco usando links GET é uma má prática de segurança?

Uma requisição é idempotente quando executá-la uma ou múltiplas vezes produz exatamente o mesmo efeito no servidor. O método GET é projetado para ser idempotente e seguro (apenas leitura de dados).

Usar links GET para deletar ou atualizar dados é uma má prática por causa de:

**Efeitos Colaterais Inesperados**: Web crawlers, indexadores de busca ou mecanismos de pré-carregamento do navegador podem seguir o link automaticamente e deletar registros sem a intervenção do usuário.

**Ataques CSRF**: Torna extremamente fácil induzir um usuário autenticado a clicar em um link malicioso que executa ações destrutivas.

---

#### `5. Validação Client vs Server`: Um desenvolvedor júnior afirma que o formulário dele é 100% seguro porque colocou required e type="email" em todas as tags HTML. Explique por que essa afirmação é falsa.


A afirmação do desenvolvedor é falsa porque a validação no cliente (HTML5/JavaScript) ocorre no ambiente do usuário e pode ser facilmente burlada ou desativada. Qualquer pessoa pode:

Inspecionar o elemento no navegador e remover os atributos required e type="email".

Desativar o JavaScript ou enviar a requisição HTTP diretamente via linha de comando (curl), Postman ou scripts automatizados, ignorando totalmente o HTML.

A validação HTML serve apenas para melhorar a experiência do usuário. A validação no servidor (PHP) é a única camada de segurança real.

---

#### `6. XSS e Sanitização`: Qual é o risco de exibir dados vindos de um $_POST diretamente na tela sem utilizar htmlspecialchars()?

Ao imprimir um dado vindo de $_POST diretamente na tela sem htmlspecialchars(), o sistema fica vulnerável a ataques de XSS Stored ou Reflected.

Se um usuário mal-intencionado enviar um código de ataque o navegador interpretará o texto como código executável. Isso permite que atacantes roubem cookies de sessão, redirecionem usuários para páginas falsas ou alterem o conteúdo visual do site.

---

#### `7. Sticky Forms`: O que é a técnica de Sticky Forms e qual é o seu impacto na experiência do usuário (UX)?

É uma técnica na qual o formulário é reapresentado ao usuário mantendo os dados que ele já preencheu caso ocorra algum erro de validação no servidor.

**Impacto na UX**: Evita a frustração do usuário de ter que preencher novamente todos os campos (como textos longos ou dados cadastrais) do zero caso cometa um erro pontual em um dos inputs.

---

#### `8. DevTools`: Como você utilizaria a aba Network do navegador para comprovar que um formulário foi enviado via POST e não via GET?

Na aba Network do navegador, ao enviar o formulário e clicar na requisição, a aba Headers mostra se o método usado foi `POST` ou `GET`. Se for `POST`, os dados enviados aparecerão na seção Body, separados da URL, comprovando que não estão na Query String. Ou então, se fosse `GET`, os mesmos dados apareceriam diretamente na própria URL da requisição, na seção de Query String Parameters.