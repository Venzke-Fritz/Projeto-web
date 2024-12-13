<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $pais = $_POST['pais'];
    $senha = $_POST['senha'];

    
    $sql_verificaemail = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
    $stmt_verificaemail = $conexao->prepare($sql_verificaemail);
    $stmt_verificaemail->bindParam(':email', $email);
    $stmt_verificaemail->execute();
    $email_existe = $stmt_verificaemail->fetchColumn();

    
    if ($email_existe > 0) {
        echo "Erro: Este email já está cadastrado.";
    } else {

        $sql = "INSERT INTO usuarios (nome, email, telefone, rua, numero, bairro, cidade, pais, senha) 
                VALUES (:nome, :email, :telefone, :rua, :numero, :bairro, :cidade, :pais, :senha)";

   
        try {
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':rua', $rua);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':pais', $pais);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();
            echo "Cadastro realizado com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
        }
    }
} else {
    echo "Formulário não foi enviado corretamente.";
}
?>
