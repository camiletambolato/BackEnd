# **LISTA DE EXERCÍCIOS DE FIXAÇÃO E PRÁTICA** - CONEXÃO BANCO DE DADOS PDO

## Parte A: Exercícios Teóricos de Fixação

1. **`Abstração de Dados:` O que é o PDO no PHP e por que ele é preferível em relação a extensões especializadas procedurais como o antigo pgsql em projetos corporativos?**

Resposta: 
---

2. **`Ciclo do DSN:` Explique o que é a string DSN e detalhe a finalidade de cada um dos parâmetros configurados para o PostgreSQL (host, port, dbname).**

Resposta:
---

3. **`Padrão de Portas:` Qual é a porta padrão de escuta do SGBD PostgreSQL (5432) e como ela é referenciada dentro da string de conexão?**

Resposta:
---

4. **`Flags de Integridade:` O que acontece quando definimos o atributo PDO::ATTR_ERRMODE com o valor PDO::ERRMODE_EXCEPTION? Qual seria o comportamento padrão caso essa flag não fosse definida?**

Resposta:
---

5. **`Fetch Mode:` Qual é a vantagem de utilizar PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC para o consumo de memória RAM do servidor?**

Resposta:
---


## 1. Definição de CRUD

**CRUD** representa as quatro operações básicas de persistência: **C**reate (inserir dados com `INSERT`), **R**ead (consultar dados com `SELECT`), **U**pdate (atualizar dados com `UPDATE`) e **D**elete (remover dados com `DELETE`).

---

## 2. Anatomia do SQL Injection

A falha ocorre ao concatenar variáveis diretamente na instrução SQL. Um atacante pode inserir caracteres de controle (como aspas e comandos lógicos como `' OR '1'='1`), alterando a estrutura da consulta para burlar a autenticação ou expor dados não autorizados.

---

## 3. Mecanismo das Prepared Statements

Nas **Prepared Statements**, o banco compila o esqueleto da consulta na etapa de *prepare* e recebe os dados separadamente na etapa de *execute*. Isso impede que o texto enviado pelo usuário seja interpretado como código executável, tratando-o estritamente como um valor literal.

---

## 4. Marcadores Nomeados

Marcadores nomeados (`:sku`, `:preco`) melhoram a clareza e a manutenção do código. Ao contrário do marcador posicional (`?`), eles eliminam a necessidade de alinhar variáveis por ordem numérica e permitem reutilizar o mesmo parâmetro em múltiplos pontos da consulta SQL.

---

## 5. Diferença entre Bindings

O método `bindValue()` associa o **valor** atual da variável ao marcador no momento em que é chamado. Já o `bindParam()` vincula a **referência** da variável, avaliando o seu conteúdo final apenas no instante de execução do comando (`$stmt->execute()`).

---

## 6. Tipagem no PDO

Sem especificar o tipo (ex: `PDO::PARAM_INT`), o PDO trata o parâmetro como texto (`PDO::PARAM_STR`). No PostgreSQL, passar um número entre aspas em cláusulas estritas como `LIMIT` pode disparar erros de incompatibilidade de tipos (`invalid input syntax for integer`).

---

## 7. Padrão DAO

O padrão **Data Access Object (DAO)** isola toda a manipulação do banco de dados das regras de negócio. Isso atende ao Princípio de Responsabilidade Única (SRP) do SOLID e facilita alterações na estrutura das tabelas sem impactar o restante da aplicação.

---

## 8. Operações de Update

Sem a cláusula `WHERE`, o comando `UPDATE` altera o valor especificado em **todas as linhas da tabela**. Em ambientes de produção, isso causa a corrupção irreparável ou a perda em massa de dados críticos do sistema.

---

## 9. Impacto da LGPD

O vazamento por SQL Injection evidencia falta de segurança preventiva. Sob a LGPD, a organização pode sofrer multas de até 2% do faturamento (limitadas a R$ 50 milhões por infração), ter o banco de dados bloqueado, sofrer sanções de imagem e responder civilmente por danos aos titulares.



