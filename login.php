<?php
session_start();
require_once 'crud/conexao.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email_fornecido = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha_fornecida = $_POST['senha']; 

    if (!$email_fornecido || empty($senha_fornecida)) {
        header('Location: index.php?erro=campos_vazios'); 
        exit;
    }

    $sql = "SELECT id, primeiro_nome, senha_hash FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email_fornecido);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        if (password_verify($senha_fornecida, $usuario['senha_hash'])) {
            
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_nome'] = $usuario['primeiro_nome'];
            $_SESSION['logged_in'] = TRUE;
            
            header('Location: painel.php');
            exit;
            
        } else {
            header('Location: index.php?erro=login_invalido'); 
            exit;
        }
    } else {
        header('Location: index.php?erro=login_invalido'); 
        exit;
    }

} else {
    header('Location: index.php');
    exit;
}
?>