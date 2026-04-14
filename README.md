# Sistema de Cadastro de Alunos

Aplicacao web desenvolvida em PHP puro com integracao ao MySQL para cadastro, consulta, edicao e exclusao de alunos.

O projeto foi construido como exercicio pratico para demonstrar conhecimentos fundamentais de desenvolvimento web, incluindo formulario, validacao, persistencia em banco de dados e atualizacao da interface sem recarregar a pagina.

## Tecnologias utilizadas

- PHP
- MySQL
- JavaScript
- HTML
- CSS
- XAMPP

## Funcionalidades

- Cadastro de alunos com nome, email, matricula e curso
- Validacao dos dados enviados pelo formulario
- Verificacao de matricula duplicada
- Persistencia dos dados no banco MySQL
- Listagem dos alunos cadastrados em tempo real
- Busca por nome, email, matricula ou curso
- Edicao de alunos ja cadastrados
- Exclusao de registros com confirmacao
- Respostas em JSON no backend

## Estrutura do projeto

- `index.php`: interface principal, formulario, listagem e integracao com JavaScript
- `api/cadastros.php`: endpoint responsavel por listar e salvar os cadastros
- `config/database.php`: configuracao de conexao com o banco de dados
- `database/schema.sql`: script SQL para criacao do banco e da tabela

## Como executar localmente

1. Inicie o `Apache` e o `MySQL` no XAMPP.
2. Abra o `phpMyAdmin`.
3. Execute o conteudo do arquivo `database/schema.sql`.
4. Verifique se as credenciais em `config/database.php` estao corretas.
5. Acesse no navegador:
   `http://localhost/sistems_cantina_universitaria/`

## Banco de dados

O projeto utiliza o banco `cantina_universitaria` com a tabela `alunos`.

Campos principais:

- `id`
- `nome`
- `email`
- `matricula`
- `curso`
- `criado_em`

## Regras implementadas

- Todos os campos sao obrigatorios
- O email deve estar em formato valido
- A matricula deve ser unica
- O backend retorna mensagens de erro apropriadas para falhas de validacao e conexao

## Aprendizados demonstrados

- Integracao entre frontend e backend sem framework
- Uso de `fetch()` para comunicacao com API em PHP
- Manipulacao de dados no MySQL com `mysqli`
- Organizacao basica de projeto separando interface, configuracao e endpoint
- Implementacao de operacoes de CRUD com validacao e tratamento de erros

## Proximas melhorias

- Paginacao da lista
- Ordenacao por campos
- Melhorias visuais para responsividade
- Testes automatizados
