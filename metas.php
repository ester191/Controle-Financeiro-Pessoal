<?php
session_start();
$caminho_base = '/PoupaMais/';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== TRUE) {
    header('Location: ' . $caminho_base . 'index.php?alerta=acesso_restrito');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Definir Nova Meta - PoupaMais</title>
    <link rel="stylesheet" href="<?php echo $caminho_base; ?>css/inicial.css">
    <link rel="stylesheet" href="<?php echo $caminho_base; ?>css/acoes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <header class="header">
        <h1>PoupaMais</h1>
    </header>

    <main class="page-container">
        <section class="form-section">
            <div class="header-acao meta-cor">
                <div>
                <h1><i class="fa-solid fa-bullseye"></i> Definir Nova Meta Financeira</h1>
                </div>
                <a href="<?php echo $caminho_base; ?>painel.php" class="btn-voltar"><i class="fa-solid fa-arrow-right-to-bracket "></i> Voltar</a>
            </div>

            <form action="processar_meta.php" method="POST" class="form-acao">
                <div class="input-grupo">
                    <label for="titulo-meta">Título da Meta</label>
                    <input type="text" id="titulo-meta" name="titulo" placeholder="Ex: Comprar Carro Novo" required>
                </div>
                
                <div class="input-grupo">
                    <label for="valor-meta">Valor Total Necessário (R$)</label>
                    <input type="number" id="valor-meta" name="valor_total" step="0.01" placeholder="Ex: 25000.00" required>
                </div>

                <div class="input-grupo">
                    <label for="prazo-meta">Prazo Final</label>
                    <input type="date" id="prazo-meta" name="prazo" required>
                </div>
                
                <div class="input-grupo">
                    <label for="valor-atual-meta">Valor já Economizado (R$)</label>
                    <input type="number" id="valor-atual-meta" name="valor_atual" step="0.01" placeholder="Ex: 500.00" value="0">
                </div>

                <div class="input-grupo">
                    <label for="prioridade-meta">Prioridade</label>
                    <select id="prioridade-meta" name="prioridade">
                        <option value="alta">Alta</option>
                        <option value="media" selected>Média</option>
                        <option value="baixa">Baixa</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit meta-bg">Criar Meta</button>
            </form>
        </section>
    </main>

    <footer></footer>
</body>
</html>