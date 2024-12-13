

<?php

require_once 'conexao.php';

$sql = "SELECT * FROM estoque"; 
$stmt = $conexao->prepare($sql);
$stmt->execute();
$itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Estoque - SUAG</title>
    <style>
    
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        thead {
            background-color: #f2f2f2;
        }

        .detalhes {
            display: none;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <header class="menuNav">
        <nav>
            <ul>
                <a href="index.html">
                    <img src="imagem/Logo_do_trabalho__1_-removebg-preview.png" alt="20" height="50" />
                </a>
                <li><a href="index.html">Home</a></li>
                <li><a href="Estoque.php">Estoque</a></li>
                <li><a href="Sobre.html">Sobre</a></li>
                <li><a href="Contato.html">Contato</a></li>
                <a id="Link_login" href="login.html">Login</a>
            </ul>
        </nav>
    </header>

    <h1>Estoque de Produtos</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Data de Produção</th>
                <th>Fabricante</th>
                <th>Detalhar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Exibir os itens do estoque
            if(count($itens) > 0) {
                foreach ($itens as $item) {
                    echo "<tr>";
                    echo "<td>" . $item['id'] . "</td>";
                    echo "<td>" . $item['nome'] . "</td>";
                    echo "<td>R$ " . number_format($item['preco'], 2, ',', '.') . "</td>";
                    echo "<td>" . $item['quantidade'] . "</td>";
                    echo "<td>" . date('d/m/Y', strtotime($item['data_producao'])) . "</td>";
                    echo "<td>" . $item['fabricante'] . "</td>";
                    echo "<td><button class='detalhar-btn' onclick='mostrarDetalhes(" . $item['id'] . ")'>Detalhar</button></td>";
                    echo "</tr>";

                    // Exibir detalhes ocultos para cada item
                    echo "<tr id='detalhes-" . $item['id'] . "' class='detalhes'>";
                    echo "<td colspan='6'>";
                    echo "<strong>Descrição:</strong> " . $item['descricao'] . "<br>";
                    echo "<strong>Fabricante:</strong> " . $item['fabricante'] . "<br>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum item encontrado no estoque.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <footer>
        <p>&copy; 2024 SUAG - Sistema Unificado de Administração Agrícola. Todos os direitos reservados.</p>
    </footer>

    <script>
        // Função para mostrar ou esconder os detalhes do item
        function mostrarDetalhes(id) {
            var detalhesRow = document.getElementById('detalhes-' + id);
            if (detalhesRow.style.display === 'none' || detalhesRow.style.display === '') {
                detalhesRow.style.display = 'table-row';
            } else {
                detalhesRow.style.display = 'none';
            }
        }
    </script>
</body>
</html>
