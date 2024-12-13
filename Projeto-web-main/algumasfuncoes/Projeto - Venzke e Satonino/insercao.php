<?php
include_once 'conexao.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome']) && isset($_POST['preco'])  && isset($_POST['descricao'] && isset($_POST['data_producao']) && isset($_POST['fabricante'])&& isset($_POST['quantidade'])) {
        if (empty($_POST['nome']) && empty($_POST['preco']) && empty($_POST['quant']) && empty($_POST['descr'])) {
            $msg = "Erro: Os campos não podem ser vazios";
            header("Location: index.php?msg=" . urldecode($msg));
        } else {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $preco = $_POST['preco'];
            $quantidade = $_POST['quant'];
            $descricao = $_POST['descr'];
   
            try {
                $sql = "INSERT INTO itens ( nome, preco, descricao, data_producao, fabricante, quantidade ) VALUES (:nome, :preco, :descricao, :data_producao, :fabricante :quantidade)";
                $query = $conexao->prepare($sql);
                $query->bindValue(':nome', $nome);
                $query->bindValue(':preco', $preco);
                $query->bindValue(':descricao', $descricao);
                $query->bindValue(':data_producao', $data_producao);
                $query->bindValue(':fabricante', $fabricante);
                $query->bindValue(':quantidade', $quantidade);

                $query->execute();


                $msg = "Produto Adicionado";
                header("Location: ../home/index.html?msg=" . urldecode($msg));

            } catch (PDOException $e) {
                $msg = "Erro ao inserir o produto: " . $e->getMessage();
                header("Location: ../home/index.html?msg=" . urldecode($msg));
            }
        }
    } else {
        $msg = "Erro: Os campos não existem ou foram definidos como nulos.";
        header("Location: indexsite.php?msg=" . urldecode($msg));




    }
} else {
    $msg = "Erro : Metódo de requisição inválido.";
    header("Location: indexsite.php?msg=" . urldecode($msg));


}






?>