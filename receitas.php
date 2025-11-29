<?php
session_start();
require_once 'crud/conexao.php'; 

$caminho_base = '/PoupaMais/'; 

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== TRUE) {
    header('Location: ' . $caminho_base . 'index.php?alerta=acesso_restrito');
    exit;
}

$user_id = $_SESSION['user_id'];
$mensagem = ''; 
$data_padrao = date('Y-m-d'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    $valor = filter_input(INPUT_POST, 'valor', FILTER_VALIDATE_FLOAT);
    $data_transacao = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING); 
    
    if ($categoria  && $valor && $data_transacao && $valor > 0) {
        
        try {
            $sql = "INSERT INTO transacoes (user_id, tipo, categoria, descricao, valor, data_transacao) 
                    VALUES (:user_id, 'receita', :categoria, :descricao, :valor, :data_transacao)";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':data_transacao', $data_transacao);
            
            if ($stmt->execute()) {
                $mensagem = '<p class="msg-sucesso">Receita registrada com sucesso!</p>';
            } else {
                $mensagem = '<p class="msg-erro"> Erro ao registrar receita no banco de dados.</p>';
            }
            
        } catch (PDOException $e) {
            $mensagem = '<p class="msg-erro"> Erro de conexão/SQL: ' . $e->getMessage() . '</p>';
        }
        
    } else {
        $mensagem = '<p class="msg-erro"> Por favor, preencha todos os campos corretamente.</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Receita - PoupaMais</title>
    <link rel="stylesheet" href="<?php echo $caminho_base; ?>css/inicial.css">
    <link rel="stylesheet" href="<?php echo $caminho_base; ?>css/acoes.css">
    <link href="https://fonts.googleapis.com/css2?family=NomeDaSuaFonte:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .msg-sucesso, .msg-erro { padding: 10px; margin: 15px 0; border-radius: 4px; text-align: center; font-weight: bold; }
        .msg-sucesso { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .msg-erro { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <header class="header">
        <h1>PoupaMais</h1>
    </header>

    <main class="page-container">
        <section class="form-section">
            <div class="header-acao receita-cor">
                <div>
                <h1><i class="fa-solid fa-plus-circle"></i> Adicionar Nova Receita</h1>
                </div>
                <a href="<?php echo $caminho_base; ?>painel.php" class="btn-voltar"><i class="fa-solid fa-arrow-right-to-bracket "></i> Voltar</a>
            </div>

            <?php echo $mensagem;  ?>

            <form action="receitas.php" method="POST" class="form-acao">
                <div class="input-grupo">
                    <label for="categoria-receita">Categoria</label>
                    <select id="categoria-receita" name="categoria" required>
                        <option value="" disabled selected>Selecione uma categoria</option>
                        <option value="salario">Salário</option>
                        <option value="freelance">Freelance</option>
                        <option value="investimento">Investimento</option>
                        <option value="outros">Outros</option>
                    </select>
                </div>
                
                <div class="input-grupo">
                    <label for="descricao-receita">Descrição</label>
                    <input type="text" id="descricao-receita" name="descricao" placeholder="Ex: Salário Mensal">
                </div>

                <div class="input-grupo">
                    <label for="valor-receita">Valor (R$)</label>
                    <input type="text" id="valor-receita" name="valor" step="0.01" placeholder="Ex: 1200.00" required>
                </div>

                <div class="input-grupo">
                    <label for="data-receita">Data de Recebimento</label>
                    <input type="date" id="data-receita" name="data" required value="<?php echo $data_padrao; ?>">
                </div>
                
                <button type="submit" class="btn-submit receita-bg">Salvar Receita</button>
            </form>
        </section>
    </main>

    <footer></footer>
</body>
</html>