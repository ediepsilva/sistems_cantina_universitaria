<?php

declare(strict_types=1);

function criarConexao(): mysqli
{
    $host = '127.0.0.1';
    $usuario = 'root';
    $senha = '';
    $banco = 'cantina_universitaria';
    $porta = 3306;

    $conexao = new mysqli($host, $usuario, $senha, $banco, $porta);

    if ($conexao->connect_error) {
        throw new RuntimeException('Nao foi possivel conectar ao banco de dados MySQL.');
    }

    $conexao->set_charset('utf8mb4');

    return $conexao;
}
