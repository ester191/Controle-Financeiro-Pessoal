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
    <title>Definir Orçamento - PoupaMais</title>
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
            <div class="header-acao orcamento-cor">
                <div>
                <h1><i class="fa-solid fa-calculator"></i> Definir Orçamento Mensal</h1>
                </div>
                <a href="<?php echo $caminho_base; ?>painel.php" class="btn-voltar"><i class="fa-solid fa-arrow-right-to-bracket "></i> Voltar</a>
            </div>

            <form action="processar_orcamento.php" method="POST" class="form-acao">
                <div class="input-grupo">
                    <label for="mes-orcamento">Mês/Ano do Orçamento</label>
                    <input type="month" id="mes-orcamento" name="mes_ano" required value="<?php echo date('Y-m'); ?>">
                </div>

                <h3 class="limites-titulo">
                    <i class="fa-solid fa-plus-circle"></i> Definir Limites por Categoria
                </h3>
                
                <div class="input-grupo">
                    <label for="limite-alimentacao">Alimentação (R$)</label>
                    <input type="number" id="limite-alimentacao" name="limite_alimentacao" step="0.01" placeholder="Ex: 800.00">
                </div>

                <div class="input-grupo">
                    <label for="limite-transporte">Transporte (R$)</label>
                    <input type="number" id="limite-transporte" name="limite_transporte" step="0.01" placeholder="Ex: 1500.00">
                </div>
                
                <div class="input-grupo">
                    <label for="limite-lazer">Lazer (R$)</label>
                    <input type="number" id="limite-lazer" name="limite_lazer" step="0.01" placeholder="Ex: 300.00">
                </div>

                <div class="input-grupo">
                    <label for="limite-educacao">Educação (R$)</label>
                    <input type="number" id="limite-educacao" name="limite_educacao" step="0.01" placeholder="Ex: 300.00">
                </div>
                
                <button type="submit" class="btn-submit orcamento-bg">Salvar Orçamento</button>
            </form>
        </section>
    </main>
    <footer></footer>
</body>
</html>