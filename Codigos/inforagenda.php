<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Agendamentos</title>
    <style>
        /* Estilos CSS para a tabela */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            color: #333;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td a {
            text-decoration: none;
            color: #333;
        }

        td a:hover {
            text-decoration: underline;
        }

        .return-link {
            margin-top: 20px;
            text-align: center;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div>
    <h2>Lista de Agendamentos</h2>
    <?php
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "banco"; // Substitua pelo nome do seu banco de dados

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Consulta SQL para listar agendamentos
    $sql_select = "SELECT * FROM agendamento";
    $result = $conn->query($sql_select);

    // Verifica se há resultados
    if ($result && $result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>CPF do Paciente</th><th>Código do Paciente</th><th>ID do Reagendamento</th><th>Data do Agendamento</th><th>Data do Reagendamento</th><th>ID do Profissional</th><th>Ação</th></tr>";

        // Loop pelos resultados e exibe na tabela
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_agendamento"] . "</td>";
            echo "<td>" . $row["cpf_paciente"] . "</td>";
            echo "<td>" . $row["cod_pac"] . "</td>";
            echo "<td>" . $row["id_reagendamento"] . "</td>";
            echo "<td>" . $row["data_agendamento"] . "</td>";
            echo "<td>" . $row["data_reagendamento"] . "</td>";
            echo "<td>" . $row["id_profissional"] . "</td>";
            echo "<td><a href='inforagenda.php?id=" . $row["id_agendamento"] . "'>Ver Detalhes</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Nenhum agendamento cadastrado ainda.</p>";
    }

    // Fecha a conexão
    $conn->close();
    ?>
</div>

<div class="return-link">
    <a href="agendamento.php" class="button">Voltar </a>
</div>

</body>
</html>

