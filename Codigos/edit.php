<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "avaliacao_nutricional";
$cpfPaciente = "";

if (isset($_GET['cpfPaciente'])) {
    $cpfPaciente = $_GET['cpfPaciente'];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM avaliacao_nutricional WHERE CPF_Paciente = '$cpfPaciente'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $conn->close();
} else {
    die("CPF do Paciente não fornecido.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProfissional = $_POST['idProfissional'];
    $codProcedimento = $_POST['codProcedimento'];
    $avNutriPac = $_POST['avNutriPac'];
    $dataAvaliacao = $_POST['dataAvaliacao'];
    $historicoClinico = $_POST['historicoClinico'];
    $exames = $_POST['exames'];
    $avAntropometrica = $_POST['avAntropometrica'];
    $circunCefalica = $_POST['circunCefalica'];
    $circunBraco = $_POST['circunBraco'];
    $circunPunho = $_POST['circunPunho'];
    $circunCintura = $_POST['circunCintura'];
    $circunQuadril = $_POST['circunQuadril'];
    $circunPanturrilha = $_POST['circunPanturrilha'];
    $circunDobraCutanea = $_POST['circunDobraCutanea'];
    $circunDobraSubescapular = $_POST['circunDobraSubescapular'];
    $circunDobraBicipal = $_POST['circunDobraBicipal'];
    $circunDobraAbdominal = $_POST['circunDobraAbdominal'];
    $circunDobraSuprailiaca = $_POST['circunDobraSuprailiaca'];
    $circunDobraPanturrilha = $_POST['circunDobraPanturrilha'];
    $circunDobraCoxa = $_POST['circunDobraCoxa'];
    $planoAlimentar = $_POST['planoAlimentar'];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE avaliacao_nutricional SET 
            ID_Profissional='$idProfissional', 
            COD_Procedimento='$codProcedimento', 
            Av_Nutri_pac='$avNutriPac', 
            Data_Avaliacao='$dataAvaliacao', 
            Historico_Clinico='$historicoClinico', 
            Exames='$exames', 
            Av_Antropometrica='$avAntropometrica', 
            Circun_cefalica='$circunCefalica', 
            Circun_braco='$circunBraco', 
            Circun_punho='$circunPunho', 
            Circun_cintura='$circunCintura', 
            Circun_quadril='$circunQuadril', 
            Circun_panturrilha='$circunPanturrilha', 
            Circun_dobra_cutanea='$circunDobraCutanea', 
            Circun_dobra_cutanea_subescapular='$circunDobraSubescapular', 
            Circun_dobra_cutanea_bicipal='$circunDobraBicipal', 
            Circun_dobra_cutanea_abdominal='$circunDobraAbdominal', 
            Circun_dobra_cutanea_suprailiaca='$circunDobraSuprailiaca', 
            Circun_dobra_cutanea_panturrilha='$circunDobraPanturrilha', 
            Circun_dobra_cutanea_coxa='$circunDobraCoxa', 
            Plano_Alimentar='$planoAlimentar'
            WHERE CPF_Paciente='$cpfPaciente'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Dados atualizados com sucesso!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Avaliação Nutricional</title>
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
        .form-container .button-container {
            display: flex;
            justify-content: space-between;
        }
        .form-container .button-container a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-container .button-container a:hover {
            background-color: #0056b3;
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
    <script>
        function validateNumberInput(event) {
            const value = event.target.value;
            const isValid = /^\d*\.?\d*$/.test(value);
            if (!isValid) {
                event.target.value = value.slice(0, -1);
            }
        }
        
        function validateProfissionalID(event) {
            const value = event.target.value;
            if (value.length > 5) {
                event.target.value = value.slice(0, 5);
            }
        }

        window.onload = function() {
            document.querySelectorAll('input[type="number"]').forEach(function(input) {
                input.addEventListener('input', validateNumberInput);
            });
            document.getElementById('cpfPaciente').addEventListener('input', function(event) {
                const value = event.target.value;
                event.target.value = value.replace(/\D/g, '');
            });
            document.getElementById('idProfissional').addEventListener('input', validateProfissionalID);
        }
    </script>
</head>
<body>
    <div class="sidebar">
        <h1>Nutrição<span style="color: #2ecc71;"></span></h1>
        <ul>
            <li><a href="index.php"><span>🏠</span><span>Início</span></a></li>
        </ul>
    </div>
    <div class="container">
        <div class="main-content">
            <div class="form-container">
                <h2>Editar Avaliação Nutricional</h2>
                <form action="" method="post">
                    <input type="hidden" id="cpfPaciente" name="cpfPaciente" value="<?php echo htmlspecialchars($cpfPaciente); ?>" required>

                    <label for="idProfissional">ID do Profissional:</label>
                    <input type="number" id="idProfissional" name="idProfissional" value="<?php echo htmlspecialchars($row['ID_Profissional']); ?>" maxlength="5" required>

                    <label for="codProcedimento">Código do Procedimento:</label>
                    <input type="number" id="codProcedimento" name="codProcedimento" value="<?php echo htmlspecialchars($row['COD_Procedimento']); ?>" required>

                    <label for="avNutriPac">Avaliação Nutricional do Paciente:</label>
                    <textarea id="avNutriPac" name="avNutriPac" rows="4" required><?php echo htmlspecialchars($row['Av_Nutri_pac']); ?></textarea>

                    <label for="dataAvaliacao">Data da Avaliação:</label>
                    <input type="datetime-local" id="dataAvaliacao" name="dataAvaliacao" value="<?php echo htmlspecialchars($row['Data_Avaliacao']); ?>" required>

                    <label for="historicoClinico">Histórico Clínico:</label>
                    <textarea id="historicoClinico" name="historicoClinico" rows="4" required><?php echo htmlspecialchars($row['Historico_Clinico']); ?></textarea>

                    <label for="exames">Exames Realizados:</label>
                    <textarea id="exames" name="exames" rows="4" required><?php echo htmlspecialchars($row['Exames']); ?></textarea>

                    <label for="avAntropometrica">Avaliação Antropométrica:</label>
                    <input type="text" id="avAntropometrica" name="avAntropometrica" value="<?php echo htmlspecialchars($row['Av_Antropometrica']); ?>" required>

                    <label for="circunCefalica">Circunferência Cefálica:</label>
                    <input type="number" id="circunCefalica" name="circunCefalica" step="0.01" value="<?php echo htmlspecialchars($row['Circun_cefalica']); ?>" required>

                    <label for="circunBraco">Circunferência do Braço:</label>
                    <input type="number" id="circunBraco" name="circunBraco" step="0.01" value="<?php echo htmlspecialchars($row['Circun_braco']); ?>" required>

                    <label for="circunPunho">Circunferência do Punho:</label>
                    <input type="number" id="circunPunho" name="circunPunho" step="0.01" value="<?php echo htmlspecialchars($row['Circun_punho']); ?>" required>

                    <label for="circunCintura">Circunferência da Cintura:</label>
                    <input type="number" id="circunCintura" name="circunCintura" step="0.01" value="<?php echo htmlspecialchars($row['Circun_cintura']); ?>" required>

                    <label for="circunQuadril">Circunferência do Quadril:</label>
                    <input type="number" id="circunQuadril" name="circunQuadril" step="0.01" value="<?php echo htmlspecialchars($row['Circun_quadril']); ?>" required>

                    <label for="circunPanturrilha">Circunferência da Panturrilha:</label>
                    <input type="number" id="circunPanturrilha" name="circunPanturrilha" step="0.01" value="<?php echo htmlspecialchars($row['Circun_panturrilha']); ?>" required>

                    <label for="circunDobraCutanea">Circunferência das Dobras Cutâneas:</label>
                    <input type="number" id="circunDobraCutanea" name="circunDobraCutanea" step="0.01" value="<?php echo htmlspecialchars($row['Circun_dobra_cutanea']); ?>" required>

                    <label for="circunDobraSubescapular">Circunferência das Dobras Subescapulares:</label>
                    <input type="number" id="circunDobraSubescapular" name="circunDobraSubescapular" step="0.01" value="<?php echo htmlspecialchars($row['Circun_dobra_cutanea_subescapular']); ?>" required>

                    <label for="circunDobraBicipal">Circunferência das Dobras Bicipais:</label>
                    <input type="number" id="circunDobraBicipal" name="circunDobraBicipal" step="0.01" value="<?php echo htmlspecialchars($row['Circun_dobra_cutanea_bicipal']); ?>" required>

                    <label for="circunDobraAbdominal">Circunferência das Dobras Abdominais:</label>
                    <input type="number" id="circunDobraAbdominal" name="circunDobraAbdominal" step="0.01" value="<?php echo htmlspecialchars($row['Circun_dobra_cutanea_abdominal']); ?>" required>

                    <label for="circunDobraSuprailiaca">Circunferência das Dobras Suprailíacas:</label>
                    <input type="number" id="circunDobraSuprailiaca" name="circunDobraSuprailiaca" step="0.01" value="<?php echo htmlspecialchars($row['Circun_dobra_cutanea_suprailiaca']); ?>" required>

                    <label for="circunDobraPanturrilha">Circunferência das Dobras da Panturrilha:</label>
                    <input type="number" id="circunDobraPanturrilha" name="circunDobraPanturrilha" step="0.01" value="<?php echo htmlspecialchars($row['Circun_dobra_cutanea_panturrilha']); ?>" required>

                    <label for="circunDobraCoxa">Circunferência das Dobras da Coxa:</label>
                    <input type="number" id="circunDobraCoxa" name="circunDobraCoxa" step="0.01" value="<?php echo htmlspecialchars($row['Circun_dobra_cutanea_coxa']); ?>" required>

                    <label for="planoAlimentar">Plano Alimentar:</label>
                    <textarea id="planoAlimentar" name="planoAlimentar" rows="4" required><?php echo htmlspecialchars($row['Plano_Alimentar']); ?></textarea>

                    <div class="button-container">
                        <input type="submit" value="Salvar Alterações">
                        <a href="pagina_consulta.html">Voltar para Consulta</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
