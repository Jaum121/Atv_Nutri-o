<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Consultas</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom, #aaffaa, #ffffff); /* Fundo degradê verde claro para branco */
            color: #333; /* Cinza escuro */
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh; /* Mínimo 100% da altura da tela */
            overflow-y: auto; /* Adicionando barra de rolagem vertical */
        }

        .sidebar {
            width: 250px;
            background-color: #ffffff; /* Alterado para branco */
            color: #333; /* Cinza escuro para o texto */
            padding: 20px;
            height: 100vh;
            position: fixed;
            border-right: 1px solid #ccc; /* Adiciona uma borda à direita */
        }

        .sidebar h2 {
            color: #2e7d32; /* Verde escuro */
            text-align: center;
        }

        .sidebar a {
            display: block;
            color: #333; /* Cinza escuro para os links */
            padding: 10px;
            text-decoration: none;
            margin: 10px 0;
        }

        .sidebar a:hover {
            background-color: #f0f0f0; /* Cinza claro ao passar o mouse */
        }

        .content {
            margin-left: 250px; /* Largura da barra lateral */
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            color: #4CAF50; /* Verde */
            margin-bottom: 20px;
            text-align: center; /* Centraliza o texto */
        }

        .form-container, .table-container {
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            margin-bottom: 20px;
            width: 120%;
            max-width: 1500px; /* Largura máxima de 1000px */
            margin: auto; /* Centraliza o formulário na tela */
            overflow-x: auto; /* Adicionando barra de rolagem horizontal */
        }

        form {
            text-align: center;
        }

        input, select {
            margin-bottom: 10px;
            padding: 10px;
            width: calc(100% - 20px);
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50; /* Verde */
            color: #fff; /* Branco */
            cursor: pointer;
            transition: background-color 0.3s;
            border: none;
            padding: 12px 20px;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #45a049; /* Verde mais escuro (tom mais escuro) ao passar o mouse */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed; /* Layout fixo da tabela */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            overflow: hidden; /* Esconde o excesso de conteúdo */
            text-overflow: ellipsis; /* Adiciona reticências no excesso de texto */
            white-space: nowrap; /* Impede a quebra de linha */
        }

        th {
            background-color: #4CAF50; /* Verde */
            color: white;
        }

        th:nth-child(8), td:nth-child(8) {
            width: 100px; /* Define um tamanho fixo para a coluna "Ações" */
        }

        .btn-outra-pagina {
            display: inline-block;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .btn-outra-pagina:hover {
            background-color: #45a049;
        }

        .edit-button, .delete-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            margin: 2px; /* Espaçamento entre os botões */
        }

        .edit-button:hover, .delete-button:hover {
            background-color: #45a049;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            color: #4CAF50;
        }

        .error-message {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            color: #FF0000; /* Vermelho */
        }

        .button-group {
            display: flex;
            justify-content: center;
            flex-wrap: wrap; /* Permite que os botões quebrem linha se necessário */
        }

    </style>
    <script>
        function validateCPF(input) {
            input.value = input.value.replace(/\D/g, '').slice(0, 11); // Remove caracteres não numéricos e limita a 11 dígitos
        }
    </script>
</head>

<body>
    <div class="sidebar">
        <h2>Nutrição</h2>
        <a href="index.php">🏠Início</a>
        <a href="inforagenda.php">Informações da Agenda</a>
    </div>

    <div class="content">
        <div class="form-container">
            <h2>Formulário de Agendamento</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="id_agendamento" placeholder="ID. Agendamento" required><br>
                <input type="text" name="cpf_paciente" placeholder="CPF do Paciente" required maxlength="11" oninput="validateCPF(this)"><br>
                <input type="text" name="cod_pac" placeholder="COD. Paciente" required><br>
                <input type="text" name="id_reagendamento" placeholder="ID. Reagendamento" required><br>
                <input type="date" name="data_agendamento" required><br>
                <input type="date" name="data_reagendamento" required><br>
                <input type="text" name="id_profissional" placeholder="ID. Profissional" required><br>
                <input type="submit" name="submit" value="Agendar Consulta">
            </form>
        </div>

        <div class="table-container">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "banco";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Falha na conexão: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id_agendamento = $_POST['id_agendamento'];
                $cpf_paciente = $_POST['cpf_paciente'];
                $cod_pac = $_POST['cod_pac'];
                $id_reagendamento = $_POST['id_reagendamento'];
                $data_agendamento = $_POST['data_agendamento'];
                $data_reagendamento = $_POST['data_reagendamento'];
                $id_profissional = $_POST['id_profissional'];

                $sql_insert = "INSERT INTO agendamento (id_agendamento, cpf_paciente, cod_pac, id_reagendamento, data_agendamento, data_reagendamento, id_profissional) VALUES (?, ?, ?, ?, ?, ?, ?)";

                if ($stmt = $conn->prepare($sql_insert)) {
                    $stmt->bind_param("issssss", $id_agendamento, $cpf_paciente, $cod_pac, $id_reagendamento, $data_agendamento, $data_reagendamento, $id_profissional);
                    try {
                        $stmt->execute();
                        echo "<p class='message'>Agendamento realizado com sucesso!</p>";
                    } catch (mysqli_sql_exception $e) {
                        if ($e->getCode() == 1062) { // Código de erro para chave duplicada
                            echo "<p class='error-message'>Erro: O ID do agendamento já existe. Por favor, insira um ID diferente.</p>";
                        } else {
                            echo "<p class='error-message'>Erro: " . $e->getMessage() . "</p>";
                        }
                    }
                    $stmt->close();
                } else {
                    echo "<p class='error-message'>Erro na preparação da consulta: " . $conn->error . "</p>";
                }
            }

            if (isset($_GET['excluir']) && $_GET['excluir'] != '') {
                $id_agendamento_excluir = $_GET['excluir'];
                $sql_delete = "DELETE FROM agendamento WHERE id_agendamento = ?";
                if ($stmt = $conn->prepare($sql_delete)) {
                    $stmt->bind_param("i", $id_agendamento_excluir);
                    if ($stmt->execute()) {
                        echo "<p class='message'>Agendamento excluído com sucesso!</p>";
                    } else {
                        echo "<p class='error-message'>Erro ao excluir: " . $stmt->error . "</p>";
                    }
                    $stmt->close();
                } else {
                    echo "<p class='error-message'>Erro na preparação da consulta: " . $conn->error . "</p>";
                }
            }

            $sql_select = "SELECT * FROM agendamento";
            $result = $conn->query($sql_select);

            if ($result && $result->num_rows > 0) {
                echo "<h2>Lista de Agendamentos</h2>";
                echo "<table>";
                echo "<tr><th>ID</th><th>CPF do Paciente</th><th>Código do Paciente</th><th>ID do Reagendamento</th><th>Data do Agendamento</th><th>Data do Reagendamento</th><th>ID do Profissional</th><th>Ações</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_agendamento"] . "</td>";
                    echo "<td>" . $row["cpf_paciente"] . "</td>";
                    echo "<td>" . $row["cod_pac"] . "</td>";
                    echo "<td>" . $row["id_reagendamento"] . "</td>";
                    echo "<td>" . $row["data_agendamento"] . "</td>";
                    echo "<td>" . $row["data_reagendamento"] . "</td>";
                    echo "<td>" . $row["id_profissional"] . "</td>";
                    echo "<td><a href='agendamento.php?excluir=" . $row["id_agendamento"] . "' class='delete-button'>Excluir</a></td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>Nenhum agendamento cadastrado ainda.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>
