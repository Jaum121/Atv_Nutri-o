<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meubanco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf_paciente = $_POST["cpf_paciente"];
    $nome_paciente = $_POST["nome_paciente"];
    $idade_paciente = $_POST["idade_paciente"];
    $refeicao = $_POST["refeicao"];
    $alimento = $_POST["alimento"];
    $quantidade = $_POST["quantidade"];
    $calorias = $_POST["calorias"];
    $data_hora_visita = $_POST["data_hora_visita"];

    $sql = "INSERT INTO ficha_nutricional (cpf_paciente, nome_paciente, idade_paciente, refeicao, alimento, quantidade, calorias, data_avaliacao) 
            VALUES ('$cpf_paciente', '$nome_paciente', '$idade_paciente', '$refeicao', '$alimento', '$quantidade', '$calorias', '$data_hora_visita')";

    if ($conn->query($sql) === TRUE) {
        echo "Dados adicionados com sucesso.";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
