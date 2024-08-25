<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "avaliacao_nutricional";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpfPaciente = $_POST["cpfPaciente"];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM avaliacao_nutricional WHERE CPF_Paciente = '$cpfPaciente'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Nenhum resultado encontrado para o CPF informado.");
    }

    $conn->close();
} else {
    die("CPF do Paciente não fornecido.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Avaliação Nutricional</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            display: flex;
            flex: 1;
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
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
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
        .form-container input,
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-container input[type="submit"],
        .form-container a.edit-button {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        .form-container input[type="submit"]:hover,
        .form-container a.edit-button:hover {
            background-color: #218838;
        }
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 10px;
            }
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .form-container {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1>Nutrição</h1>
        <ul>
            <li><a href="index.php"><span>🏠</span><span>Início</span></a></li>
        </ul>
    </div>
    <div class="container">
        <div class="main-content">
            <div class="form-container">
                <h2>Dados do Paciente</h2>
                <?php if (isset($row)): ?>
                    <p><strong>CPF:</strong> <?php echo htmlspecialchars($row["CPF_Paciente"]); ?></p>
                    <p><strong>ID Profissional:</strong> <?php echo htmlspecialchars($row["ID_Profissional"]); ?></p>
                    <p><strong>Código do Procedimento:</strong> <?php echo htmlspecialchars($row["COD_Procedimento"]); ?></p>
                    <p><strong>Avaliação Nutricional do Paciente:</strong> <?php echo htmlspecialchars($row["Av_Nutri_pac"]); ?></p>
                    <p><strong>Data da Avaliação:</strong> <?php echo htmlspecialchars($row["Data_Avaliacao"]); ?></p>
                    <p><strong>Histórico Clínico:</strong> <?php echo htmlspecialchars($row["Historico_Clinico"]); ?></p>
                    <p><strong>Exames Realizados:</strong> <?php echo htmlspecialchars($row["Exames"]); ?></p>
                    <p><strong>Avaliação Antropométrica:</strong> <?php echo htmlspecialchars($row["Av_Antropometrica"]); ?></p>
                    <p><strong>Circunferência Cefálica:</strong> <?php echo htmlspecialchars($row["Circun_cefalica"]); ?></p>
                    <p><strong>Circunferência do Braço:</strong> <?php echo htmlspecialchars($row["Circun_braco"]); ?></p>
                    <p><strong>Circunferência do Punho:</strong> <?php echo htmlspecialchars($row["Circun_punho"]); ?></p>
                    <p><strong>Circunferência da Cintura:</strong> <?php echo htmlspecialchars($row["Circun_cintura"]); ?></p>
                    <p><strong>Circunferência do Quadril:</strong> <?php echo htmlspecialchars($row["Circun_quadril"]); ?></p>
                    <p><strong>Circunferência da Panturrilha:</strong> <?php echo htmlspecialchars($row["Circun_panturrilha"]); ?></p>
                    <p><strong>Circunferência das Dobras Cutâneas:</strong> <?php echo htmlspecialchars($row["Circun_dobra_cutanea"]); ?></p>
                    <p><strong>Circunferência das Dobras Subescapulares:</strong> <?php echo htmlspecialchars($row["Circun_dobra_cutanea_subescapular"]); ?></p>
                    <p><strong>Circunferência das Dobras Bicipais:</strong> <?php echo htmlspecialchars($row["Circun_dobra_cutanea_bicipal"]); ?></p>
                    <p><strong>Circunferência das Dobras Abdominais:</strong> <?php echo htmlspecialchars($row["Circun_dobra_cutanea_abdominal"]); ?></p>
                    <p><strong>Circunferência das Dobras Suprailíacas:</strong> <?php echo htmlspecialchars($row["Circun_dobra_cutanea_suprailiaca"]); ?></p>
                    <p><strong>Circunferência das Dobras da Panturrilha:</strong> <?php echo htmlspecialchars($row["Circun_dobra_cutanea_panturrilha"]); ?></p>
                    <p><strong>Circunferência das Dobras da Coxa:</strong> <?php echo htmlspecialchars($row["Circun_dobra_cutanea_coxa"]); ?></p>
                    <p><strong>Plano Alimentar:</strong> <?php echo htmlspecialchars($row["Plano_Alimentar"]); ?></p>
                    <a class="edit-button" href="edit.php?cpfPaciente=<?php echo htmlspecialchars($row['CPF_Paciente']); ?>">Editar Dados</a>
                <?php else: ?>
                    <p>Nenhum resultado encontrado para o CPF informado.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
