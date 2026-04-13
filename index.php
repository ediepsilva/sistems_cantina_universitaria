<?php

declare(strict_types=1);

function consolidarPedidoPorAluno(array $matriculas, array $valores): array
{
    if (count($matriculas) !== count($valores)) {
        throw new InvalidArgumentException('As listas de matriculas e valores devem ter o mesmo tamanho.');
    }

    $totaisPorAluno = [];

    foreach ($matriculas as $indice => $matricula) {
        if (!isset($totaisPorAluno[$matricula])) {
            $totaisPorAluno[$matricula] = 0.0;
        }

        $totaisPorAluno[$matricula] += (float) $valores[$indice];
    }

    ksort($totaisPorAluno);

    return $totaisPorAluno;
}

function calcularTotalGeral(array $totaisPorAluno): float
{
    return array_sum($totaisPorAluno);
}

$matriculas = [101, 102, 101, 103, 102, 101];
$valores = [12.50, 8.00, 5.50, 10.00, 3.00, 7.00];

$totaisPorAluno = consolidarPedidoPorAluno($matriculas, $valores);
$totalGeral = calcularTotalGeral($totaisPorAluno);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema da Cantina Universitaria</title>
    <style>
        :root {
            color-scheme: light;
            --bg: #f4efe6;
            --panel: #fffaf2;
            --ink: #1f2933;
            --muted: #6b7280;
            --accent: #9a3412;
            --accent-soft: #fed7aa;
            --border: #e5d7c5;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background:
                radial-gradient(circle at top, rgba(154, 52, 18, 0.10), transparent 30%),
                linear-gradient(180deg, #f8f1e7 0%, var(--bg) 100%);
            color: var(--ink);
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 48px 20px;
        }

        .hero,
        .card {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 18px 45px rgba(31, 41, 51, 0.08);
        }

        .hero {
            padding: 32px;
            margin-bottom: 24px;
        }

        .eyebrow {
            margin: 0 0 8px;
            color: var(--accent);
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0 0 12px;
            font-size: clamp(2rem, 4vw, 3rem);
        }

        .lead {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }

        .card {
            padding: 24px;
        }

        .summary {
            display: inline-block;
            margin-bottom: 20px;
            padding: 12px 16px;
            border-radius: 14px;
            background: var(--accent-soft);
            color: var(--accent);
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        th {
            font-size: 0.9rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        tbody tr:hover {
            background: rgba(154, 52, 18, 0.04);
        }

        .money {
            font-weight: 700;
            color: var(--accent);
        }

        @media (max-width: 640px) {
            .container {
                padding: 24px 14px;
            }

            .hero,
            .card {
                border-radius: 16px;
            }

            th,
            td {
                padding: 12px 8px;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <section class="hero">
            <p class="eyebrow">Controle de pedidos</p>
            <h1>Resumo financeiro da cantina</h1>
            <p class="lead">
                Consolidacao simples dos valores por aluno para facilitar consultas,
                manutencao e evolucao futura do sistema.
            </p>
        </section>

        <section class="card">
            <div class="summary">
                Total geral arrecadado: R$ <?php echo number_format($totalGeral, 2, ',', '.'); ?>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Matricula</th>
                        <th>Total de pedidos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($totaisPorAluno as $matricula => $total): ?>
                        <tr>
                            <td><?php echo htmlspecialchars((string) $matricula, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="money">R$ <?php echo number_format($total, 2, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
