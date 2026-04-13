<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/config/database.php';

header('Content-Type: application/json; charset=UTF-8');

function responder(int $statusCode, array $payload): void
{
    http_response_code($statusCode);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

function lerCadastros(mysqli $conexao): array
{
    $sql = 'SELECT nome, email, matricula, curso, criado_em FROM alunos ORDER BY id DESC';
    $resultado = $conexao->query($sql);

    if (!$resultado instanceof mysqli_result) {
        return [];
    }

    $cadastros = [];

    while ($linha = $resultado->fetch_assoc()) {
        $cadastros[] = [
            'nome' => (string) $linha['nome'],
            'email' => (string) $linha['email'],
            'matricula' => (string) $linha['matricula'],
            'curso' => (string) $linha['curso'],
            'criadoEm' => date('d/m/Y H:i:s', strtotime((string) $linha['criado_em'])),
        ];
    }

    return $cadastros;
}

function validarCadastro(array $dados): array
{
    $nome = trim((string) ($dados['nome'] ?? ''));
    $email = trim((string) ($dados['email'] ?? ''));
    $matricula = trim((string) ($dados['matricula'] ?? ''));
    $curso = trim((string) ($dados['curso'] ?? ''));

    if ($nome === '' || $email === '' || $matricula === '' || $curso === '') {
        responder(422, ['mensagem' => 'Preencha todos os campos antes de enviar.']);
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        responder(422, ['mensagem' => 'Informe um e-mail valido.']);
    }

    return [
        'nome' => $nome,
        'email' => $email,
        'matricula' => $matricula,
        'curso' => $curso,
        'criadoEm' => date('d/m/Y H:i:s'),
    ];
}

function matriculaJaExiste(mysqli $conexao, string $matricula): bool
{
    $stmt = $conexao->prepare('SELECT id FROM alunos WHERE matricula = ? LIMIT 1');

    if (!$stmt instanceof mysqli_stmt) {
        responder(500, ['mensagem' => 'Nao foi possivel verificar a matricula.']);
    }

    $stmt->bind_param('s', $matricula);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $existe = $resultado instanceof mysqli_result && $resultado->num_rows > 0;
    $stmt->close();

    return $existe;
}

function salvarCadastro(mysqli $conexao, array $cadastro): void
{
    $stmt = $conexao->prepare(
        'INSERT INTO alunos (nome, email, matricula, curso) VALUES (?, ?, ?, ?)'
    );

    if (!$stmt instanceof mysqli_stmt) {
        responder(500, ['mensagem' => 'Nao foi possivel preparar o cadastro.']);
    }

    $stmt->bind_param(
        'ssss',
        $cadastro['nome'],
        $cadastro['email'],
        $cadastro['matricula'],
        $cadastro['curso']
    );

    if (!$stmt->execute()) {
        $stmt->close();
        responder(500, ['mensagem' => 'Nao foi possivel salvar o cadastro no banco.']);
    }

    $stmt->close();
}

try {
    $conexao = criarConexao();
} catch (RuntimeException $exception) {
    responder(500, [
        'mensagem' => 'Falha na conexao com o banco. Verifique se o MySQL do XAMPP esta ligado e se o banco foi criado.',
    ]);
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'GET') {
    responder(200, ['cadastros' => lerCadastros($conexao)]);
}

if ($method !== 'POST') {
    responder(405, ['mensagem' => 'Metodo nao permitido.']);
}

$rawBody = file_get_contents('php://input');
$payload = json_decode($rawBody ?: '[]', true);

if (!is_array($payload)) {
    responder(400, ['mensagem' => 'JSON invalido.']);
}

$novoCadastro = validarCadastro($payload);

if (matriculaJaExiste($conexao, $novoCadastro['matricula'])) {
    responder(409, ['mensagem' => 'Ja existe um cadastro com essa matricula.']);
}

salvarCadastro($conexao, $novoCadastro);
$cadastros = lerCadastros($conexao);

responder(201, [
    'mensagem' => 'Cadastro realizado com sucesso.',
    'cadastros' => $cadastros,
]);
