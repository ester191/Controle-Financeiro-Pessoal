<?php
$host = 'localhost'; 
$dbname = 'poupamais'; 
$user = 'root'; 
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Erro ao conectar com o banco de dados 'poupamais'. Verifique se o MySQL/MariaDB está rodando no XAMPP/WAMP: " . $e->getMessage());
}
?>