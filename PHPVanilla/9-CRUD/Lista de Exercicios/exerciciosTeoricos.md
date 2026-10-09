# Lista de Exercicios

## Parte A: Exercícios Teóricos de Fixação

#### 1. **Definição de CRUD:** O que significa o acrônimo CRUD e qual é a correspondência direta de cada uma de suas letras com as instruções SQL no PostgreSQL?

O acrônimo **CRUD** resume as quatro operações básicas do banco de dados: **C**reate (inserir com `INSERT`), **R**ead (consultar com `SELECT`), **U**pdate (atualizar com `UPDATE`), e **D**elete (remover com `DELETE`).

---

#### 2. **Anatomia do SQL Injection:** Explique com suas próprias palavras como um atacante consegue alterar a lógica de uma consulta quando o código utiliza concatenação de strings com `$_GET` ou `$_POST`.

Ao concatenar `$_GET` ou `$_POST` diretamente na string SQL, a entrada do usuário vira parte do próprio código. Um atacante pode digitar caracteres do controle (`'` ou `OR 1=1`) para fechar a consulta original e injetar novos comandos executáveis no banco.

---

#### 3. **Mecanismo das Prepared Statements:** Por que o envio de uma consulta em duas etapas (`prepare` e depois `execute`) impede que um texto digitado pelo usuário seja executado como instrução SQL pelo banco?]

O envio em duas etapas separa o código dos dados. Na etapa `prepare`, o banco analisa e fixa o plano de execução da instrução. Quando o `execute` envia os dados do usuário, o banco os trata exclusivamente como valores literias, sem reinterpretar o texto como código SQL>

---

#### 4. **Marcadores Nomeados:** Qual é a vantagem de utilizar marcadores nomeados como `:sku` e `:preco` em vez de pontos de interrogação posicionais (`?`) em instruções SQL complexas?

Marcadores nomeados (`:sku`, `:preco`) indicam explicitamente o papel de cada parâmetro na instrução. Isso melhora a leitura, evita erros de contagem em consultas longas com muitos pontos de interrogação (`?`) e facilita alterações futuras na ordem das colunas.

---

#### 5. **Diferença entre Bindings:** Explique a diferença de comportamento entre os métodos `$stmt->bindValue()` e `$stmt->bindParam()`.

O `$stmt->bindValue()` associa o **valor** atual da variável imediatamente no momento da chamada. Já o `$stmt->bindParam()` vincula a **referência** da variável, o que significa que o valor enviado ao banco será aquele mantido pela variável no instante exato do `$stmt->execute()`.

---

#### 6. **Tipagem no PDO:** Qual é o risco de omitir o tipo de dado (ex: `PDO::PARAM_INT`) ao vincular uma variável que deveria ser estritamente numérica em uma cláusula `LIMIT`?

Sem `PDO::PARAM_INT`, o PDO envia o parâmetro como string (`PDO::PARAM_STR`), o que coloca o valor entre aspas. No PostgreSQL, a cláusula `LIMIT` exige um inteiro estrito, e o envio como texto gera erro de sintaxe ou de compatibilidade de tipo (`invalid input syntax for integer`).

---

#### 7. **Padrão DAO:** Qual é o benefício do padrão *Data Access Object* (DAO) em termos de manutenibilidade de software e do princípio de responsabilidade única (SOLID)?

O padrão **Data Access Object (DAO)** isola todo o código de banco de dados em uma camada própria. Isso atende ao Princípio da Responsabilidade Única (SRP) do SOLID, permitindo alterar a estrutura de tabelas ou o SGBD sem impactar as regras de negócio ou a interface da aplicação.

---

#### 8. **Operações de Update:** Por que a ausência de uma cláusula `WHERE` em um comando `UPDATE` é considerada um incidente gravíssimo em ambientes de produção?

Sem a cláusula `WHERE`, a instrução `UPDATE` altera os valores de **todas as linhas** da tabela indiscriminadamente. Em produção, isso sobrescreve dados consolidados do sistema, resultando na perda irreversível de integridade da informação.

---

#### 9. **Impacto da LGPD:** De acordo com a Lei Geral de Proteção de Dados (LGPD), quais são as penalidades e impactos que uma organização pode sofrer caso ocorra vazamento de dados de clientes por falha de SQL Injection?

Vazamentos por SQL Injection evidenciam falta de segurança preventiva. Sob a LGPD (Lei nº 13.709/2018), a empresa pode sofrer advertências, multas de até 2% do faturamento (limitadas a R$ 50 milhões por infração), bloqueio/eliminação do banco de dados, sanções de imagem e ter que indenizar os titulares atingidos.

---