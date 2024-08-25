<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Listagem de Pacientes</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2; /* Cinza claro */
            color: #333; /* Cinza escuro */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        h2 {
            color: #4CAF50; /* Verde */
            margin-bottom: 20px;
        }

        form {
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff; /* Branco */
            margin-bottom: 20px;
            width: 80%;
        }

        input, textarea {
            margin-bottom: 10px;
            padding: 10px;
            width: 100%;
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
            width: 80%;
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
            background-color: #008CBA; /* Azul */
            color: #fff; /* Branco */
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-outra-pagina:hover {
            background-color: #005F7E; /* Azul mais escuro ao passar o mouse */
        }
    </style>
</head>

<body>

<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meubanco";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $email = $_POST["email"];
    $prognostico = $_POST["prognostico"];

    // Insere os dados na tabela 'informacoes'
    $sql = "INSERT INTO informacoes (nome, idade, email, prognostico) VALUES ('$nome', '$idade', '$email', '$prognostico')";

    if ($conn->query($sql) === TRUE) {
        echo "Paciente cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o paciente: " . $conn->error;
    }
}

// Consulta os dados dos pacientes na tabela 'informacoes'
$sql_select = "SELECT * FROM informacoes";
$result = $conn->query($sql_select);
?>

<div>
    <h2>Cadastro de Paciente</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Nome: <input type="text" name="nome" required><br>
        Idade: <input type="number" name="idade" required><br>
        Email: <input type="email" name="email" required><br>
        Prognóstico: <textarea name="prognostico" rows="4" cols="50" required></textarea><br>
        <input type="submit" value="Cadastrar">
    </form>

    <?php
    // Exibe a tabela de pacientes
    if ($result->num_rows > 0) {
        echo "<h2>Dados dos Pacientes</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Nome</th><th>Idade</th><th>Email</th><th>Prognóstico</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nome"] . "</td><td>" . $row["idade"] . "</td><td>" . $row["email"] . "</td><td>" . $row["prognostico"] . "</td></tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Nenhum paciente cadastrado ainda.</p>";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
    ?>
    
    <a href="edicao.php" class="btn-outra-pagina">Editar</a>
</div>

</body>
</html>
