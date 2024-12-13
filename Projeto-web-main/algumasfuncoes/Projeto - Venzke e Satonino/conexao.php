<?php
   $servidor = "localhost";
   $usuario = "root";
   $senha = "";
   $banco = "bd_suag";

   try {
      
       $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
       $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       echo "Conexão bem-sucedida";
   } catch (PDOException $e) { 
       echo "Conexão falhou: " . $e->getMessage();
   }

?>