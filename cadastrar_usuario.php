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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_password'])) {
        $user_id = $_POST['user_id'];
        $new_password = $_POST['new_password'];
        $sql = "UPDATE usuarios SET password='$new_password' WHERE id='$user_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Senha atualizada com sucesso.";
        } else {
            echo "Erro ao atualizar a senha: " . $conn->error;
        }
    } elseif (isset($_POST['delete_user'])) {
        $user_id = $_POST['user_id'];
        $sql = "DELETE FROM usuarios WHERE id='$user_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Usuário excluído com sucesso.";
        } else {
            echo "Erro ao excluir o usuário: " . $conn->error;
        }
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $is_admin = isset($_POST['is_admin']) ? 1 : 0;
        $sql = "INSERT INTO usuarios (username, password, is_admin) VALUES ('$username', '$password', $is_admin)";
        if ($conn->query($sql) === TRUE) {
            echo "Usuário cadastrado com sucesso.";
        } else {
            echo "Erro ao cadastrar o usuário: " . $conn->error;
        }
    }
}

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
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

        .edit-button, .delete-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }

        .edit-button:hover, .delete-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Nutrição</h2>
        <a href="index.php">Início</a>
        
    </div>

    <div class="content">
        <h2>Cadastrar Usuário</h2>
        <form action="cadastrar_usuario.php" method="post">
            Nome de Usuário: <input type="text" name="username" required><br>
            Senha: <input type="password" name="password" required><br>
            Administrador: <input type="checkbox" name="is_admin"><br>
            <input type="submit" value="Cadastrar">
        </form>

        <h2>Usuários Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome de Usuário</th>
                    <th>Senha</th>
                    <th>Administrador</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['password']}</td>
                                <td>" . ($row['is_admin'] ? 'Sim' : 'Não') . "</td>
                                <td>
                                    <form action='cadastrar_usuario.php' method='post' style='display:inline-block;'>
                                        <input type='hidden' name='user_id' value='{$row['id']}'>
                                        Nova Senha: <input type='password' name='new_password' required>
                                        <input type='submit' name='update_password' value='Atualizar' class='edit-button'>
                                    </form>
                                    <form action='cadastrar_usuario.php' method='post' style='display:inline-block;'>
                                        <input type='hidden' name='user_id' value='{$row['id']}'>
                                        <input type='submit' name='delete_user' value='Excluir' class='delete-button'>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum usuário cadastrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
