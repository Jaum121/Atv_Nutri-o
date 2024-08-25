<?php
include('conexao.php');

if (isset($_POST['nomePaciente'])) {
    $pesquisa = $mysqli->real_escape_string($_POST['nomePaciente']);
    
    $sql_code = "SELECT * 
                 FROM ficha_nutricional
                 WHERE cpf_paciente LIKE '%$pesquisa%'";
    
    $sql_query = $mysqli->query($sql_code) or die("Erro ao consultar: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Evolução do Paciente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            height: 100vh;
            position: fixed;
        }

        .sidebar h1 {
            color: #2ecc71;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 15px 0;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
        }
        .sidebar ul li a:hover {
            background-color: #f0f0f0;
            border-radius: 5px;
        }
        .sidebar ul li a span {
            margin-left: 10px;
        }

        .main-content {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
            display: flex;
            flex-direction: column;
            align-items: center; /* Centraliza conteúdo na horizontal */
            min-height: 100vh; /* Altura mínima da viewport */
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-container label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-container input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            padding: 10px 20px;
        }
        .form-container input[type="submit"]:hover {
            background-color: #218838;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 600px; /* Largura máxima da tabela */
            border: 3px solid #000000; /* Borda preta */
            margin-top: 20px; /* Espaço acima da tabela */
        }
        table th, table td {
            border: 1px solid #000000; /* Linhas das células */
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #28a745; /* Verde */
            color: #ffffff; /* Texto branco */
        }
        h1 {
            color: #000000; /* preto */
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #000000; /* Preto */
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #000000; /* Borda preta */
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            padding: 10px 20px;
        }
        button:hover {
            background-color: #008000; /* Verde mais escuro ao passar o mouse */
        }
        td {
            background-color: #ffffff; /* Fundo branco para células */
        }
        tr:nth-child(even) td {
            background-color: #f2f2f2; /* Fundo cinza claro para linhas pares */
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h1>Nutrição<span style="color: #2ecc71;"></span></h1>
    <ul>
        <li><a href="index.php"><span>🏠</span><span>Início</span></a></li>
        
    </ul>
</div>

<div class="main-content">
    <div class="form-container">
        <h2>Consulta de Evolução do Paciente </h2>
        <form action="" method="post">
            <label for="nomePaciente">CPF do Paciente:</label>
            <input type="text" id="nomePaciente" name="nomePaciente" required>

            <button type="submit">Consultar Evolução</button>
        </form>
    </div>

    <table>
        <tr>
            <th>CPF</th>
            <th>ID</th>
            <th>NOME</th>
            <th>DATA</th>
            <th>REFEIÇÃO </th>
            <th> ALIMENTO</th>
            <th>QUANTIDADE</th>
            <th>CALORIAS</th>
        </tr>

        <?php
        // Aqui deve ser $_POST em vez de $_GET
        if (isset($_POST['nomePaciente'])) {
            if ($sql_query->num_rows == 0) {
        ?>
            <tr>
                <td colspan="8">Nenhum resultado encontrado</td>
            </tr>
        <?php
            } else {
                while ($dados = $sql_query->fetch_assoc()) {
        ?>
                    <tr>
                        <td><?php echo $dados['cpf_paciente']; ?></td>
                        <td><?php echo $dados['id']; ?></td>
                        <td><?php echo $dados['nome_paciente']; ?></td>
                        <td><?php echo $dados['data_avaliacao']; ?></td>
                        <td><?php echo $dados['refeicao']; ?></td>
                        <td><?php echo $dados['alimento']; ?></td>
                        <td><?php echo $dados['quantidade']; ?></td>
                        <td><?php echo $dados['calorias']; ?></td>
                    </tr>
        <?php
                }
            }
        }
        ?>
    </table>
</div>

</body>
</html>
