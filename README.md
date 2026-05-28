<img width="1918" height="950" alt="Captura1r" src="https://github.com/user-attachments/assets/132d312f-88da-4a64-b3ed-7d6c2a62ebe5" />
<img width="1917" height="950" alt="Capturar2" src="https://github.com/user-attachments/assets/a939bb72-bb0a-48b5-9e6b-969cdfb6d6c9" />



# Poll PHP — Site de Notícias com Sistema de Enquetes

Aplicação web desenvolvida em **PHP puro** com o objetivo de consolidar os fundamentos da linguagem, integração com banco de dados via **PDO**, organização de código em camadas e práticas básicas de segurança em aplicações web.

O projeto simula um portal de notícias com um widget de votação acoplado: o visitante navega pelas matérias, vota na enquete ativa e acompanha os resultados em uma página dedicada. Apesar da simplicidade do escopo, o repositório foi estruturado como um estudo prático de conceitos centrais do desenvolvimento backend.

## Propósito

Este repositório foi concebido como **material de aprendizado**. A escolha por não utilizar frameworks ou bibliotecas adicionais é intencional — o foco é compreender, a baixo nível, como o PHP lida com requisições HTTP, persistência de dados, renderização de views e proteção contra vetores comuns de ataque.

## Funcionalidades

- Listagem de notícias na página inicial.
- Criação de enquetes com pergunta personalizada e até cinco opções de resposta.
- Widget de votação fixo, exibido apenas quando há enquete ativa.
- Página de resultados com cálculo de percentuais e barras de progresso.
- Controle de votação única por enquete através de cookies.

## Requisitos

- PHP 7.4 ou superior
- MySQL / MariaDB
- Servidor web local (XAMPP, WAMP, Laragon ou equivalente)

## Instalação

1. Clone ou copie o projeto para o diretório `htdocs/` do seu servidor local.
2. Crie um banco de dados chamado `poll` e as tabelas a seguir:
   - `settings` — armazena o `current_poll_id` (identificador da enquete ativa).
   - `polls` — colunas `id`, `question`.
   - `poll_options` — colunas `id`, `poll_id`, `label`, `votes`.
3. Insira uma linha inicial em `settings` com `id = 1`.
4. Ajuste as credenciais de acesso ao banco em [config.php](config.php).
5. Acesse a aplicação via `http://localhost/poll-php/`.

## Estrutura do projeto

```
poll-php/
├── config.php          # Constantes de conexão e configuração de cookies
├── lib.php             # Funções utilitárias (conexão PDO, queries e cookies)
├── template.php        # Função render() para composição de views
├── index.php           # Controlador da home
├── criar.php           # Controlador da criação de enquetes
├── resultados.php      # Controlador da página de resultados
├── vote.php            # Endpoint de processamento do voto
├── partials/
│   ├── head.php        # Cabeçalho HTML, navegação e hero
│   ├── footer.php      # Rodapé e inclusão condicional do widget
│   └── poll_widget.php # Widget flutuante de votação
├── views/
│   ├── home.php        # Listagem de notícias
│   ├── create.php      # Formulário de criação de enquete
│   └── results.php     # Apresentação dos resultados
└── assets/             # Imagens das notícias (.webp)
```

A arquitetura segue um modelo **MVC simplificado**: os arquivos na raiz atuam como controladores, `lib.php` concentra a camada de acesso a dados, `partials/` define o layout reutilizável e `views/` contém o conteúdo específico de cada página.

## Conceitos técnicos aplicados

A seguir, os principais tópicos exercitados ao longo do desenvolvimento, com referências diretas aos trechos relevantes do código.

### 1. PDO com Prepared Statements
A conexão é configurada em [lib.php:8-11](lib.php#L8-L11) com `PDO::ERRMODE_EXCEPTION`, garantindo que falhas de banco sejam tratadas como exceções, e `PDO::FETCH_ASSOC` como modo padrão de retorno. Todas as consultas que recebem entrada do usuário utilizam `prepare()` + `execute()` com placeholders, eliminando a superfície de ataque para **SQL Injection**. Ver exemplo em [vote.php:13-14](vote.php#L13-L14).

### 2. Conexão única via variável `static`
A função `pdo()` em [lib.php:3-15](lib.php#L3-L15) implementa um padrão *singleton* funcional: a instância de PDO é armazenada em uma variável `static` interna, reaproveitando a mesma conexão durante toda a requisição.

### 3. Sistema de templates com `extract()`
Em [template.php](template.php), a função `render()` recebe um array associativo de variáveis e as expande no escopo local via `extract()` antes de incluir os parciais. Trata-se de uma abordagem nativa para passagem de dados entre controlador e view, sem dependência de template engines externos.

### 4. Proteção contra XSS
Toda saída renderizada a partir de dados do banco ou de entrada do usuário é tratada com `htmlspecialchars($valor, ENT_QUOTES, 'UTF-8')`. Exemplos em [partials/poll_widget.php:12](partials/poll_widget.php#L12) e [views/home.php:14-20](views/home.php#L14-L20).

### 5. Type casting defensivo
Identificadores recebidos de `$_POST` ou do banco são convertidos explicitamente com `(int)` antes de uso, como em [vote.php:6-7](vote.php#L6-L7). É uma camada adicional de validação que reforça a integridade dos dados manipulados.

### 6. Transações em banco de dados
A criação de uma enquete em [views/create.php:12-35](views/create.php#L12-L35) é executada dentro de uma transação (`beginTransaction`, `commit`, `rollBack`) envolvida por `try/catch`. As operações de inserção da pergunta, das opções e atualização da `settings` são tratadas como uma unidade atômica — se qualquer etapa falhar, o estado anterior é integralmente restaurado.

### 7. Padrão Post/Redirect/Get (PRG)
Após o processamento de um POST, o fluxo é redirecionado com `header('Location: ...')` seguido de `exit`, evitando o reenvio acidental do formulário. Aplicado em [vote.php:21-23](vote.php#L21-L23).

### 8. Controle de votação por cookie
As funções `has_voted()` e `set_voted_cookie()` em [lib.php:40-47](lib.php#L40-L47) gerenciam um cookie único por enquete (`voted_poll_<id>`), permitindo participações independentes em enquetes distintas. A solução é adequada ao escopo didático, ainda que não suficiente para uso em produção.

### 9. Validação de método HTTP
O endpoint de votação em [vote.php:5](vote.php#L5) rejeita explicitamente requisições que não sejam `POST`, impedindo execução acidental via GET (links, prefetch, etc.).

### 10. Composição condicional de layout
O widget de enquete é incluído apenas quando a view sinaliza `withWidget => true` e existe enquete ativa. A lógica está em [partials/footer.php:16-18](partials/footer.php#L16-L18), demonstrando inclusão condicional de parciais.

### 11. Null coalescing operator (`??`)
Utilizado para definir valores padrão de forma concisa quando variáveis podem não estar definidas: `$title ?? 'Meu Site'`, `$withWidget ?? false`. Substitui verificações verbosas baseadas em `isset()`.

### 12. Composição funcional de arrays
Em [views/create.php:7](views/create.php#L7), a expressão `array_values(array_filter(array_map('trim', ...)))` higieniza as opções enviadas no formulário em uma única linha: remove espaços em branco, descarta entradas vazias e reindexa o array.

## Limitações conhecidas

O projeto possui pontos em aberto intencionalmente, úteis como próximas etapas de estudo:

- [views/results.php](views/results.php) realiza um `include_once('resultados.php')` que produz um carregamento circular. O ideal seria que os dados fossem injetados exclusivamente via `render()`.
- Em [lib.php:45](lib.php#L45), `defined("VOTE_COOKIE_DAYS")` retorna um valor booleano em vez do conteúdo da constante. A intenção era utilizar a própria constante diretamente.
- A criação de enquetes não exige autenticação.
- O controle de voto por cookie pode ser contornado trivialmente; um sistema mais robusto demandaria sessões ou registro por IP.
- Não há um arquivo `schema.sql` versionado para automatizar a criação do banco.

## Stack

- **PHP** puro, sem framework
- **MySQL / MariaDB** acessado via **PDO**
- **Bootstrap 5** (via CDN) para estilização
- **XAMPP** como ambiente de desenvolvimento local

---

Projeto desenvolvido com finalidade educacional, sem pretensão de uso em produção.
