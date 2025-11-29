<?php
require_once 'crud/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $primeiro_nome = filter_input(INPUT_POST, 'primeiro_nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $ultimo_nome = filter_input(INPUT_POST, 'ultimo_nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); 
    $senha_pura = $_POST['senha']; 
    $confirmar_senha = $_POST['confirmar_senha'];
    $nascimento = $_POST['nascimento'];
    $genero = $_POST['genero'] ?? null;

    if (!$email || $senha_pura !== $confirmar_senha || strlen($senha_pura) < 6) {
        die("Erro de validação: Verifique o e-mail e se as senhas coincidem (mínimo 6 caracteres).");
    }
    
    $senha_hash = password_hash($senha_pura, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO usuarios (primeiro_nome, ultimo_nome, email, senha_hash, data_nascimento, genero) 
                VALUES (:p_nome, :u_nome, :email, :senha, :nasc, :genero)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':p_nome', $primeiro_nome);
        $stmt->bindParam(':u_nome', $ultimo_nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha_hash);
        $stmt->bindParam(':nasc', $nascimento);
        $stmt->bindParam(':genero', $genero);
        
        $stmt->execute();
        
        header('Location: index.php?sucesso=cadastro');
        exit;
        
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            die("Erro: O e-mail '$email' já está cadastrado. Tente fazer login.");
        } else {
            die("Erro no servidor: " . $e->getMessage());
        }
    }

} else {
    header('Location: index.php');
    exit;
}
?>