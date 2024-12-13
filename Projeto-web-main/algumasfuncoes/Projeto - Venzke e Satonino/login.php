<?php
session_start();  // Inicia a sessão para armazenar as informações do usuário

require_once 'conexao.php';  // Conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

 
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
       
        if (password_verify($senha, $usuario['senha'])) {
            
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];

        
            header("Location: home.php");
            exit();
        } else {
         
            echo "Erro: Senha incorreta.";
        }
    } else {
    
        echo "Erro: Email não encontrado.";
    }
}
?>
