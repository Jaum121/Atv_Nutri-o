<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "avaliacao_nutricional";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpfPaciente = $_POST["cpfPaciente"];
    $idProfissional = $_POST["idProfissional"];
    $codProcedimento = $_POST["codProcedimento"];
    $avNutriPac = $_POST["avNutriPac"];
    $dataAvaliacao = $_POST["dataAvaliacao"];
    $historicoClinico = $_POST["historicoClinico"];
    $exames = $_POST["exames"];
    $avAntropometrica = $_POST["avAntropometrica"];
    $circunCefalica = $_POST["circunCefalica"];
    $circunBraco = $_POST["circunBraco"];
    $circunPunho = $_POST["circunPunho"];
    $circunCintura = $_POST["circunCintura"];
    $circunQuadril = $_POST["circunQuadril"];
    $circunPanturrilha = $_POST["circunPanturrilha"];
    $circunDobraCutanea = $_POST["circunDobraCutanea"];
    $circunDobraSubescapular = $_POST["circunDobraSubescapular"];
    $circunDobraBicipal = $_POST["circunDobraBicipal"];
    $circunDobraAbdominal = $_POST["circunDobraAbdominal"];
    $circunDobraSuprailiaca = $_POST["circunDobraSuprailiaca"];
    $circunDobraPanturrilha = $_POST["circunDobraPanturrilha"];
    $circunDobraCoxa = $_POST["circunDobraCoxa"];
    $planoAlimentar = $_POST["planoAlimentar"];

    $sql = "INSERT INTO avaliacao_nutricional (
        CPF_Paciente, ID_Profissional, COD_Procedimento, Av_Nutri_pac, Data_Avaliacao, 
        Historico_Clinico, Exames, Av_Antropometrica, Circun_cefalica, Circun_braco, 
        Circun_punho, Circun_cintura, Circun_quadril, Circun_panturrilha, Circun_dobra_cutanea, 
        Circun_dobra_cutanea_subescapular, Circun_dobra_cutanea_bicipal, Circun_dobra_cutanea_abdominal, 
        Circun_dobra_cutanea_suprailiaca, Circun_dobra_cutanea_panturrilha, Circun_dobra_cutanea_coxa, 
        Plano_Alimentar
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    )";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sissssssssssssssssssss", 
        $cpfPaciente, $idProfissional, $codProcedimento, $avNutriPac, $dataAvaliacao, 
        $historicoClinico, $exames, $avAntropometrica, $circunCefalica, $circunBraco, 
        $circunPunho, $circunCintura, $circunQuadril, $circunPanturrilha, $circunDobraCutanea, 
        $circunDobraSubescapular, $circunDobraBicipal, $circunDobraAbdominal, 
        $circunDobraSuprailiaca, $circunDobraPanturrilha, $circunDobraCoxa, $planoAlimentar
    );

    if ($stmt->execute()) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
