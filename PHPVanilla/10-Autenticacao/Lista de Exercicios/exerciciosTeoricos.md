# LISTA DE EXERCÍCIOS DE FIXAÇÃO E PRÁTICA - SESSÕES, COOKIES e AUTENTICAÇÃO DE USUÁRIOS


## Parte A: Exercícios Teóricos de Fixação

#### 1. `Protocolo Stateless:` O que significa afirmar que o protocolo HTTP é "stateless" e por que o mecanismo de cookies/sessões é necessário para aplicações modernas?

* **Resposta:**  HTTP é *stateless* porque não guarda memória entre requisições; cada acesso é isolado. Cookies e sessões são necessários para criar a "memória" da aplicação, identificando o usuário ao longo da navegação.

---

#### 2. `Cookies vs. Sessões:` Qual é a diferença entre os dados armazenados em um cookie e os dados mantidos no array superglobal $_SESSION? Qual dos dois apresenta maior segurança para informações confidenciais?

* **Resposta:** Cookies ficam no navegador do usuário e guardam dados simples. Sessões (`$_SESSION`) ficam gravadas no servidor. **Sessões são mais seguras** para dados confidenciais, pois o usuário não pode alterar o conteúdo salvo no servidor.

---

#### 3. `A Flag HttpOnly:` Explique detalhadamente como a configuração httponly => true impede o sequestro de sessão (Session Hijacking) mesmo se a aplicação possuir uma vulnerabilidade de Cross-Site Scripting (XSS).

* **Resposta:** Com `HttpOnly => true`, o navegador bloqueia o acesso aos cookies via JavaScript (`document.cookie`). Se houver uma falha de XSS, o script malicioso não consegue ler o ID de sessão, impedindo o *Session Hijacking*.

---

#### 4. `A Flag SameSite:` Qual é a finalidade do atributo SameSite=Lax em cookies e contra qual tipo de ataque corporativo ele atua?

* **Resposta:** A flag `SameSite=Lax` impede o envio automático de cookies em requisições vindas de outros sites (como formulários externos). Ela protege contra ataques de **CSRF (Cross-Site Request Forgery)**.

---

#### 5. `Ataque de Fixação de Sessão:` O que é o ataque de Session Fixation e por que é mandatório executar session_regenerate_id(true) imediatamente após o login do usuário?

* **Resposta:** No *Session Fixation*, o atacante força um ID de sessão conhecido antes do login. Usar `session_regenerate_id(true)` cria um novo ID imediatamente após a autenticação e apaga o antigo, invalidando o acesso do atacante.

---

#### 6. `MD5 e Rainbow Tables:` Por que é considerado negligência técnica armazenar senhas com algoritmos rápidos como MD5 ou SHA256? Como as Rainbow Tables operam contra esses hashes?

* **Resposta:** MD5 e SHA256 são rápidos demais, permitindo bilhões de tentativas por segundo em GPUs. *Rainbow Tables* são listas pré-calculadas de hashes; se o hash vazado estiver na lista, a senha é descoberta instantaneamente.

---

#### 7. `O Papel do Salt:` O que é o Salt criptográfico e por que ele garante que dois usuários com a mesma senha possuam hashes completamente distintos no banco de dados?

* **Resposta:** *Salt* é uma string aleatória única adicionada à senha antes do hash. Ele garante que duas senhas iguais gerem hashes totalmente diferentes e inviabiliza o uso de *Rainbow Tables*.

---

#### 8. `Argon2id vs Bcrypt:` Por que o algoritmo Argon2id é considerado superior ao Bcrypt na proteção contra ataques de força bruta realizados por placas de vídeo (GPUs) e circuitos ASIC?

* **Resposta:** O Argon2id exige muita **memória RAM** para calcular o hash (*memory-hard*). Isso anula o poder de GPUs e ASICs, que possuem pouca memória por núcleo, tornando ataques de força bruta inviáveis.

---

#### 9. `Timing Attacks:` Por que a verificação de senhas deve ser feita com password_verify() em vez do operador de comparação comum ===?

* **Resposta:** O operador `===` para a comparação no primeiro caractere diferente, gerando variações de tempo legíveis por atacantes. A função `password_verify()` usa **tempo constante**, levando sempre o mesmo tempo para responder.

---
