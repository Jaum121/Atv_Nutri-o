<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meubanco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM agendamento WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Agendamento excluído com sucesso.";
    } else {
        echo "Erro ao excluir o agendamento: " . $conn->error;
    }
}

$conn->close();
header("Location: agendamento.php");
exit;
?>
