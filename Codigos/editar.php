<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "avaliacao_nutricional";

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
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro ao atualizar registro: " . $conn->error;
    }

    $conn->close();
}
?>
