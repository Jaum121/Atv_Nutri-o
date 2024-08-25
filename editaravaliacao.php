<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Avaliação Nutricional</title>
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
            top: 0;
            left: 0;
            overflow-y: auto;
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
            width: 100%;
            max-width: 800px;
            margin: auto;
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
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Nutrição</h2>
        <a href="index.php">Início</a>
        <a href="fichanutri.php">Voltar</a>
       
    </div>

    <div class="content">
        <h2>Editar Avaliação Nutricional</h2>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "meubanco";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        $row = null; // Inicializa a variável $row

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $id = $_GET["id"];
            $sql = "SELECT * FROM ficha_nutricional WHERE id=$id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $nome_paciente = $_POST["nome_paciente"];
            $idade_paciente = $_POST["idade_paciente"];
            $refeicao = $_POST["refeicao"];
            $alimento = $_POST["alimento"];
            $quantidade = $_POST["quantidade"];
            $calorias = $_POST["calorias"];
            $cpf_paciente = $_POST["cpf_paciente"];
            $data_avaliacao = $_POST["data_avaliacao"];

            $sql = "UPDATE ficha_nutricional SET 
                        nome_paciente='$nome_paciente', 
                        idade_paciente='$idade_paciente', 
                        refeicao='$refeicao', 
                        alimento='$alimento', 
                        quantidade='$quantidade', 
                        calorias='$calorias', 
                        cpf_paciente='$cpf_paciente',
                        data_avaliacao='$data_avaliacao'
                    WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                echo "Avaliação nutricional atualizada com sucesso!";
            } else {
                echo "Erro ao atualizar a avaliação: " . $conn->error;
            }

            $sql = "SELECT * FROM ficha_nutricional WHERE id=$id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        }

        $conn->close();
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            Nome do Paciente: <input type="text" name="nome_paciente" value="<?php echo $row['nome_paciente']; ?>" required><br>
            Idade do Paciente: <input type="number" name="idade_paciente" value="<?php echo $row['idade_paciente']; ?>" required><br>
            Refeição: <input type="text" name="refeicao" value="<?php echo $row['refeicao']; ?>" required><br>
            Alimento: <input type="text" name="alimento" value="<?php echo $row['alimento']; ?>" required><br>
            Quantidade: <input type="number" name="quantidade" step="0.01" value="<?php echo $row['quantidade']; ?>" required><br>
            Calorias: <input type="number" name="calorias" step="0.01" value="<?php echo $row['calorias']; ?>" required><br>
            CPF do Paciente: <input type="text" name="cpf_paciente" value="<?php echo $row['cpf_paciente']; ?>" maxlength="11" pattern="\d{11}" title="Digite exatamente 11 números" required><br>
            Data de Avaliação: <input type="datetime-local" name="data_avaliacao" value="<?php echo $row['data_avaliacao']; ?>" required><br>
            <input type="submit" value="Salvar">
        </form>
    </div>
</body>
</html>
