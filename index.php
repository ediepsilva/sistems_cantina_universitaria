<?php

declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Alunos | Cantina Universitaria</title>
    <style>
        :root {
            color-scheme: light;
            --bg: #f5efe6;
            --panel: rgba(255, 251, 245, 0.95);
            --panel-strong: #fff2dd;
            --ink: #1f2933;
            --muted: #667085;
            --accent: #0f766e;
            --accent-strong: #115e59;
            --accent-soft: #ccfbf1;
            --highlight: #b45309;
            --highlight-soft: #ffedd5;
            --danger: #b42318;
            --danger-soft: #fee4e2;
            --border: #e8d8c4;
            --shadow: 0 24px 60px rgba(31, 41, 51, 0.10);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at top left, rgba(15, 118, 110, 0.14), transparent 28%),
                radial-gradient(circle at right 20%, rgba(180, 83, 9, 0.12), transparent 22%),
                linear-gradient(180deg, #fcf7ef 0%, var(--bg) 100%);
        }

        .page {
            max-width: 1180px;
            margin: 0 auto;
            padding: 40px 18px 56px;
        }

        .hero {
            display: grid;
            grid-template-columns: 1.25fr 0.75fr;
            gap: 24px;
            margin-bottom: 20px;
        }

        .panel {
            background: var(--panel);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border);
            border-radius: 24px;
            box-shadow: var(--shadow);
        }

        .hero-copy,
        .hero-side,
        .form-panel,
        .list-panel {
            padding: 28px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 0 0 16px;
            padding: 8px 12px;
            border-radius: 999px;
            background: var(--accent-soft);
            color: var(--accent-strong);
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        h1,
        h2 {
            margin: 0;
        }

        h1 {
            font-size: clamp(2.2rem, 5vw, 4rem);
            line-height: 1.02;
            letter-spacing: -0.04em;
        }

        .lead {
            margin: 16px 0 0;
            max-width: 58ch;
            color: var(--muted);
            font-size: 1.03rem;
            line-height: 1.7;
        }

        .hero-points {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 22px;
        }

        .hero-points span {
            padding: 10px 14px;
            border-radius: 999px;
            background: var(--panel-strong);
            color: #7c2d12;
            font-size: 0.92rem;
            font-weight: 600;
        }

        .hero-side {
            background:
                linear-gradient(160deg, rgba(15, 118, 110, 0.95), rgba(17, 94, 89, 0.88)),
                var(--accent);
            color: #f4fffd;
            display: grid;
            align-content: space-between;
            min-height: 100%;
        }

        .hero-side p {
            margin: 0;
            line-height: 1.6;
        }

        .metric {
            display: grid;
            gap: 8px;
        }

        .metric strong {
            font-size: clamp(2rem, 5vw, 3rem);
            line-height: 1;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            padding: 20px;
        }

        .stat-card p {
            margin: 0;
            color: var(--muted);
        }

        .stat-card strong {
            display: block;
            margin-top: 10px;
            font-size: 1.75rem;
            line-height: 1.1;
        }

        .stat-card.accent {
            background: linear-gradient(180deg, rgba(204, 251, 241, 0.9), rgba(255, 251, 245, 0.95));
        }

        .stat-card.highlight {
            background: linear-gradient(180deg, rgba(255, 237, 213, 0.95), rgba(255, 251, 245, 0.95));
        }

        .content {
            display: grid;
            grid-template-columns: minmax(320px, 420px) minmax(320px, 1fr);
            gap: 24px;
        }

        .section-title {
            margin-bottom: 8px;
            font-size: 1.45rem;
        }

        .section-copy {
            margin: 0 0 24px;
            color: var(--muted);
            line-height: 1.6;
        }

        .field {
            display: grid;
            gap: 8px;
            margin-bottom: 16px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        label {
            font-weight: 600;
            font-size: 0.96rem;
        }

        input,
        select {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #d9c9b1;
            border-radius: 16px;
            font: inherit;
            color: var(--ink);
            background: #fffdf8;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.12);
            transform: translateY(-1px);
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 6px;
        }

        button {
            border: 0;
            border-radius: 999px;
            padding: 14px 22px;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
            color: white;
            background: linear-gradient(135deg, var(--accent), var(--accent-strong));
            box-shadow: 0 12px 24px rgba(15, 118, 110, 0.18);
            transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
        }

        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 28px rgba(15, 118, 110, 0.22);
        }

        button:disabled {
            opacity: 0.65;
            cursor: wait;
            transform: none;
        }

        .hint {
            margin: 0;
            color: var(--muted);
            font-size: 0.92rem;
        }

        .support-note {
            margin-top: 18px;
            padding: 14px 16px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid var(--border);
            color: var(--muted);
            line-height: 1.6;
        }

        .status {
            display: none;
            margin-top: 18px;
            padding: 14px 16px;
            border-radius: 16px;
            line-height: 1.5;
            font-weight: 600;
        }

        .status.is-visible {
            display: block;
        }

        .status.success {
            background: var(--accent-soft);
            color: var(--accent-strong);
        }

        .status.error {
            background: var(--danger-soft);
            color: var(--danger);
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .badge {
            padding: 8px 12px;
            border-radius: 999px;
            background: var(--panel-strong);
            color: var(--accent-strong);
            font-weight: 700;
            font-size: 0.92rem;
        }

        .list-tools {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 18px;
        }

        .search-box {
            flex: 1;
        }

        .empty {
            margin: 0;
            padding: 24px;
            border: 1px dashed var(--border);
            border-radius: 18px;
            color: var(--muted);
            background: rgba(255, 255, 255, 0.55);
        }

        .student-list {
            display: grid;
            gap: 14px;
        }

        .student-card {
            display: grid;
            gap: 12px;
            padding: 18px;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.95), rgba(255, 249, 240, 0.95));
        }

        .student-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
        }

        .student-name {
            margin: 0;
            font-size: 1.08rem;
        }

        .student-email,
        .student-meta {
            margin: 0;
            color: var(--muted);
            line-height: 1.5;
        }

        .course-tag {
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(15, 118, 110, 0.10);
            color: var(--accent-strong);
            font-size: 0.85rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .student-meta strong {
            color: var(--highlight);
        }

        @media (max-width: 860px) {
            .stats-grid,
            .hero,
            .content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
            .page {
                padding: 24px 14px 42px;
            }

            .hero-copy,
            .hero-side,
            .form-panel,
            .list-panel {
                padding: 22px;
            }

            .form-grid,
            .student-head,
            .toolbar,
            .actions,
            .list-tools {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="hero">
            <article class="panel hero-copy">
                <p class="eyebrow">Sistema academico</p>
                <h1>Sistema de cadastro de alunos</h1>
                <p class="lead">
                    Aplicacao desenvolvida em PHP com integracao ao MySQL para cadastro e consulta de alunos.
                    Os dados sao validados no backend e a listagem e atualizada na propria interface.
                </p>
                <div class="hero-points">
                    <span>PHP + MySQL</span>
                    <span>Validacao de dados</span>
                    <span>Consulta de registros</span>
                </div>
            </article>

            <aside class="panel hero-side">
                <p>Projeto demonstrativo com cadastro de alunos, persistencia em banco de dados e exibicao dos registros cadastrados em uma interface simples.</p>
                <div class="metric">
                    <span>Cadastros registrados</span>
                    <strong id="totalCadastros">0</strong>
                </div>
            </aside>
        </section>

        <section class="stats-grid">
            <article class="panel stat-card accent">
                <p>Total de alunos</p>
                <strong id="statTotal">0</strong>
            </article>
            <article class="panel stat-card">
                <p>Ultimo cadastro</p>
                <strong id="statUltimo">Nenhum</strong>
            </article>
            <article class="panel stat-card highlight">
                <p>Cursos com alunos</p>
                <strong id="statCursos">0</strong>
            </article>
        </section>

        <section class="content">
            <article class="panel form-panel">
                <h2 class="section-title">Novo cadastro</h2>
                <p class="section-copy">Formulario objetivo, com campos essenciais para um cadastro academico simples.</p>

                <form id="cadastroForm">
                    <div class="form-grid">
                        <div class="field full">
                            <label for="nome">Nome completo</label>
                            <input id="nome" name="nome" type="text" placeholder="Ex.: Ana Souza" required>
                        </div>

                        <div class="field full">
                            <label for="email">E-mail</label>
                            <input id="email" name="email" type="email" placeholder="ana@universidade.edu.br" required>
                        </div>

                        <div class="field">
                            <label for="matricula">Matricula</label>
                            <input id="matricula" name="matricula" type="text" placeholder="2026001" required>
                        </div>

                        <div class="field">
                            <label for="curso">Curso</label>
                            <select id="curso" name="curso" required>
                                <option value="">Selecione um curso</option>
                                <option value="Administracao">Administracao</option>
                                <option value="Analise e Desenvolvimento de Sistemas">Analise e Desenvolvimento de Sistemas</option>
                                <option value="Direito">Direito</option>
                                <option value="Enfermagem">Enfermagem</option>
                                <option value="Pedagogia">Pedagogia</option>
                            </select>
                        </div>
                    </div>

                    <div class="actions">
                        <button type="submit" id="submitButton">Cadastrar aluno</button>
                        <p class="hint">Os dados sao gravados no banco MySQL da aplicacao.</p>
                    </div>

                    <div id="statusMessage" class="status" role="status" aria-live="polite"></div>
                </form>

                <div class="support-note">
                    Sugestao para apresentacao: destaque que este formulario envia os dados com JavaScript,
                    recebe JSON do PHP e atualiza a interface sem recarregar a pagina.
                </div>
            </article>

            <article class="panel list-panel">
                <div class="toolbar">
                    <div>
                        <h2 class="section-title">Alunos cadastrados</h2>
                        <p class="section-copy">A lista abaixo e atualizada logo depois do retorno do backend.</p>
                    </div>
                    <span class="badge" id="badgeCount">0 registros</span>
                </div>

                <div class="list-tools">
                    <input id="filtroBusca" class="search-box" type="text" placeholder="Buscar por nome, e-mail, matricula ou curso">
                </div>

                <div id="listaCadastros" class="student-list">
                    <p class="empty">Nenhum cadastro realizado ainda.</p>
                </div>
            </article>
        </section>
    </main>

    <script>
        const form = document.getElementById('cadastroForm');
        const submitButton = document.getElementById('submitButton');
        const statusMessage = document.getElementById('statusMessage');
        const listaCadastros = document.getElementById('listaCadastros');
        const totalCadastros = document.getElementById('totalCadastros');
        const badgeCount = document.getElementById('badgeCount');
        const filtroBusca = document.getElementById('filtroBusca');
        const statTotal = document.getElementById('statTotal');
        const statUltimo = document.getElementById('statUltimo');
        const statCursos = document.getElementById('statCursos');
        let cadastrosState = [];

        function escapeHtml(value) {
            return value
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }

        function atualizarContadores(total) {
            totalCadastros.textContent = String(total);
            badgeCount.textContent = `${total} ${total === 1 ? 'registro' : 'registros'}`;
            statTotal.textContent = String(total);
        }

        function atualizarIndicadores(cadastros) {
            if (!cadastros.length) {
                statUltimo.textContent = 'Nenhum';
                statCursos.textContent = '0';
                return;
            }

            statUltimo.textContent = cadastros[0].nome;
            statCursos.textContent = String(new Set(cadastros.map((cadastro) => cadastro.curso)).size);
        }

        function renderizarCadastros(cadastros) {
            atualizarContadores(cadastros.length);
            atualizarIndicadores(cadastrosState);

            if (!cadastros.length) {
                listaCadastros.innerHTML = cadastrosState.length
                    ? '<p class="empty">Nenhum resultado encontrado para a busca informada.</p>'
                    : '<p class="empty">Nenhum cadastro realizado ainda.</p>';
                return;
            }

            listaCadastros.innerHTML = cadastros
                .map((cadastro) => `
                    <article class="student-card">
                        <div class="student-head">
                            <div>
                                <h3 class="student-name">${escapeHtml(cadastro.nome)}</h3>
                                <p class="student-email">${escapeHtml(cadastro.email)}</p>
                            </div>
                            <span class="course-tag">${escapeHtml(cadastro.curso)}</span>
                        </div>
                        <p class="student-meta">Matricula: ${escapeHtml(cadastro.matricula)}</p>
                        <p class="student-meta">Cadastrado em: ${escapeHtml(cadastro.criadoEm)}</p>
                    </article>
                `)
                .join('');
        }

        function aplicarFiltro() {
            const termo = filtroBusca.value.trim().toLowerCase();

            if (!termo) {
                renderizarCadastros(cadastrosState);
                return;
            }

            const filtrados = cadastrosState.filter((cadastro) => {
                const conteudo = [
                    cadastro.nome,
                    cadastro.email,
                    cadastro.matricula,
                    cadastro.curso
                ].join(' ').toLowerCase();

                return conteudo.includes(termo);
            });

            renderizarCadastros(filtrados);
        }

        function mostrarStatus(tipo, mensagem) {
            statusMessage.textContent = mensagem;
            statusMessage.className = `status is-visible ${tipo}`;
        }

        async function carregarCadastros() {
            try {
                const resposta = await fetch('api/cadastros.php');
                const dados = await resposta.json();

                if (!resposta.ok) {
                    throw new Error(dados.mensagem || 'Nao foi possivel carregar os cadastros.');
                }

                cadastrosState = dados.cadastros;
                aplicarFiltro();
            } catch (error) {
                mostrarStatus('error', error.message);
            }
        }

        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            submitButton.disabled = true;
            mostrarStatus('success', 'Enviando cadastro...');

            const payload = {
                nome: form.nome.value.trim(),
                email: form.email.value.trim(),
                matricula: form.matricula.value.trim(),
                curso: form.curso.value
            };

            try {
                const resposta = await fetch('api/cadastros.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const dados = await resposta.json();

                if (!resposta.ok) {
                    throw new Error(dados.mensagem || 'Nao foi possivel concluir o cadastro.');
                }

                cadastrosState = dados.cadastros;
                aplicarFiltro();
                mostrarStatus('success', dados.mensagem);
                form.reset();
                form.nome.focus();
            } catch (error) {
                mostrarStatus('error', error.message);
            } finally {
                submitButton.disabled = false;
            }
        });

        filtroBusca.addEventListener('input', aplicarFiltro);

        carregarCadastros();
    </script>
</body>
</html>
