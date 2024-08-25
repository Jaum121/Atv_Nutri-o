<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meubanco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Ficha Nutricional</title>
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
            background-color: #fff; /* Branco */
            color: #333; /* Cinza escuro */
            padding: 20px;
            height: 100vh;
            position: fixed;
        }

        .sidebar h2 {
            color: #4CAF50; /* Verde */
            text-align: center;
        }

        .sidebar a {
            display: block;
            color: #333; /* Cinza escuro */
            padding: 10px;
            text-decoration: none;
            margin: 10px 0;
        }

        .sidebar a:hover {
            background-color: #f0f0f0; /* Cinza claro */
        }

        .content {
            margin-left: 270px; /* Largura da barra lateral + margem */
            padding: 20px;
            flex: 1;
        }

        h2 {
            color: #4CAF50; /* Verde */
            margin-bottom: 20px;
            text-align: center; /* Centraliza o texto */
        }

        form {
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff; /* Branco */
            margin-bottom: 20px;
            width: 80%;
            max-width: 600px; /* Largura máxima de 600px */
            margin: auto; /* Centraliza o formulário na tela */
        }

        input, select, textarea {
            margin-bottom: 10px;
            padding: 10px;
            width: calc(100% - 20px); /* Largura de 100%, subtraindo o padding */
            box-sizing: border-box;
            border: 1px solid #ccc; /* Cinza claro */
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50; /* Verde */
            color: #fff; /* Branco */
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049; /* Verde mais escuro (tom mais escuro) ao passar o mouse */
        }

        table {
            border-collapse: collapse;
            width: 100%; /* Largura de 100% */
            max-width: 800px; /* Largura máxima de 800px */
            margin: auto; /* Centraliza a tabela na tela */
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50; /* Verde */
            color: white;
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

        function validateDateTime(input) {
            const value = input.value;
            const year = value.split('-')[0];
            if (year.length > 4) {
                input.value = value.slice(0, 4) + value.slice(4 + year.length - 4);
            }
        }

        function validateAge(input) {
            if (input.value.length > 3) {
                input.value = input.value.slice(0, 3);
            }
        }

        function submitForm(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById('message').textContent = 'Dados adicionados com sucesso!';
                    form.reset();
                } else {
                    document.getElementById('message').textContent = 'Erro ao adicionar dados.';
                }
            };
            xhr.send(formData);
        }
    </script>
</head>
<body>
    <div class="sidebar">
        <h2>Nutrição</h2>
        <a href="index.php">Início</a>
        <a href="relatorio.php">Relatório</a>
    </div>

    <div class="content">
        <h2>Formulário de Avaliação Nutricional</h2>
        <form action="processar_ficha.php" method="post" onsubmit="submitForm(event)">
            CPF do Paciente: <input type="text" name="cpf_paciente" maxlength="11" pattern="\d{11}" required oninput="validateCPF(this)"><br>
            Nome do Paciente: <input type="text" name="nome_paciente" required><br>
            Idade do Paciente: <input type="number" name="idade_paciente" maxlength="3" oninput="validateAge(this)" required><br>
            Refeição: <input type="text" name="refeicao" required><br>
            Alimento: <input type="text" name="alimento" required><br>
            Quantidade: <input type="number" name="quantidade" step="0.01" required><br>
            Calorias: <input type="number" name="calorias" step="0.01" required><br>
            Data e Hora da Visita: <input type="datetime-local" name="data_hora_visita" required oninput="validateDateTime(this)"><br>
            <input type="submit" value="Enviar">
        </form>
        <div id="message" class="message"></div>

        <h2>Informações da Ficha Nutricional</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Paciente</th>
                    <th>Idade do Paciente</th>
                    <th>Refeição</th>
                    <th>Alimento</th>
                    <th>Quantidade</th>
                    <th>Calorias</th>
                    <th>CPF do Paciente</th>
                    <th>Data de Avaliação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                setlocale(LC_TIME, 'pt_BR.UTF-8', 'portuguese_brazil.1252'); // Define a localidade para português do Brasil
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "meubanco";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM ficha_nutricional";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $data_formatada = strftime('%d de %B de %Y', strtotime($row['data_avaliacao']));
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nome_paciente']}</td>
                                <td>{$row['idade_paciente']}</td>
                                <td>{$row['refeicao']}</td>
                                <td>{$row['alimento']}</td>
                                <td>{$row['quantidade']}</td>
                                <td>{$row['calorias']}</td>
                                <td>{$row['cpf_paciente']}</td>
                                <td>{$data_formatada}</td>
                                <td class='button-group'>
                                    <a class='edit-button' href='editaravaliacao.php?id={$row['id']}'>Editar</a>
                                    <form action='deletar_ficha.php' method='post' style='display:inline;'>
                                        <input type='hidden' name='id' value='{$row['id']}'>
                                        <input type='submit' value='Excluir' class='delete-button'>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>Nenhum registro encontrado</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
