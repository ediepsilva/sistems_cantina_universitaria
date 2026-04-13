# Sistema Cantina Universitaria

Projeto em PHP puro com cadastro de alunos integrado ao MySQL.

## O que ja esta pronto

- Interface de cadastro em `index.php`
- Envio assíncrono com `fetch()`, sem recarregar a pagina
- API em `api/cadastros.php`
- Conexao MySQL em `config/database.php`
- Script SQL em `database/schema.sql`
- Lista de alunos atualizada em tempo real

## Como executar

1. Inicie `Apache` e `MySQL` no XAMPP.
2. Crie o banco executando o arquivo `database/schema.sql` no phpMyAdmin ou no MySQL.
3. Confira se as credenciais em `config/database.php` batem com o seu ambiente.
4. Abra no navegador:
   `http://localhost/sistems_cantina_universitaria/`

## Estrutura

- `index.php`: interface do formulario, listagem e JavaScript com `fetch()`
- `api/cadastros.php`: endpoint para listar e salvar alunos
- `config/database.php`: configuracao da conexao MySQL
- `database/schema.sql`: criacao do banco `cantina_universitaria` e da tabela `alunos`

## Observacoes

- A matricula e unica no banco.
- O backend retorna JSON para `GET` e `POST`.
- Se o MySQL estiver desligado ou o banco nao existir, a API retorna erro de conexao.
