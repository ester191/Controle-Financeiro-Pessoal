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
    
    if ($categoria && $valor && $data_transacao && $valor > 0) {
        
        try {
            $sql = "INSERT INTO transacoes (user_id, tipo, categoria, descricao, valor, data_transacao) 
                    VALUES (:user_id, 'despesa', :categoria, :descricao, :valor, :data_transacao)";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':data_transacao', $data_transacao);
            
            if ($stmt->execute()) {
                $mensagem = '<p class="msg-sucesso"> Despesa registrada com sucesso!</p>';
            } else {
                $mensagem = '<p class="msg-erro"> Erro ao registrar despesa no banco de dados.</p>';
            }
            
        } catch (PDOException $e) {
            $mensagem = '<p class="msg-erro">Erro de conexão/SQL: ' . $e->getMessage() . '</p>';
        }
        
    } else {
        $mensagem = '<p class="msg-erro">Por favor, preencha todos os campos corretamente.</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Despesa - PoupaMais</title>
    <link rel="stylesheet" href="<?php echo $caminho_base; ?>css/inicial.css">
    <link rel="stylesheet" href="<?php echo $caminho_base; ?>css/acoes.css">
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
            <div class="header-acao despesa-cor">
                <div>
                <h1><i class="fa-solid fa-minus-circle"></i> Adicionar Nova Despesa</h1>
                </div>
                <a href="<?php echo $caminho_base; ?>painel.php" class="btn-voltar"><i class="fa-solid fa-arrow-right-to-bracket "></i>Voltar</a>
            </div>

            <?php echo $mensagem; ?>

            <form action="despesas.php" method="POST" class="form-acao">
                
                <div class="input-grupo">
                    <label for="categoria-despesa">Categoria</label>
                    <select id="categoria-despesa" name="categoria" required>
                        <option value="" disabled selected>Selecione uma categoria</option>
                        <option value="aluguel">Aluguel</option>
                        <option value="alimentacao">Alimentação</option>
                        <option value="transporte">Transporte</option>
                        <option value="lazer">Lazer</option>
                        <option value="outros">Outros</option>
                    </select>
                </div>
                
                <div class="input-grupo">
                    <label for="descricao-despesa">Descrição</label>
                    <input type="text" id="descricao-despesa" name="descricao" placeholder="Ex: Conta de Luz" >
                </div>
                
                <div class="input-grupo">
                    <label for="valor-despesa">Valor (R$)</label>
                    <input type="text" id="valor-despesa" name="valor" step="0.01" placeholder="Ex: 150.50" required>
                </div>

                <div class="input-grupo">
                    <label for="data-despesa">Data</label>
                    <input type="date" id="data-despesa" name="data" required value="<?php echo $data_padrao; ?>">
                </div>
                
                <button type="submit" class="btn-submit despesa-bg">Salvar Despesa</button>
            </form>
        </section>
    </main>

    <footer></footer>
</body>
</html>