<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meubanco";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Prepara a consulta SQL para criar a tabela
$sql = "CREATE TABLE IF NOT EXISTS prontuario (
    cpf_paciente INT(11) PRIMARY KEY,
    cod_especialidade INT(10),
    cod_profissional INT(10),
    cod_procedimento INT(10),
    data_procedimento INT(8),
    descr_procedimento VARCHAR(200)
)";

// Executa a consulta SQL
if ($conn->query($sql) === TRUE) {
    echo "Tabela 'prontuario' criada ou já existente.<br>";
} else {
    echo "Erro ao criar a tabela: " . $conn->error . "<br>";
}

// Adiciona informações à tabela
$sql_insert = "INSERT INTO prontuario (cpf_paciente, cod_especialidade, cod_profissional, cod_procedimento, data_procedimento, descr_procedimento) 
               VALUES (12345678901, 1, 2, 3, 20230101, 'Procedimento de Exemplo')";

if ($conn->query($sql_insert) === TRUE) {
    echo "Informações adicionadas com sucesso.<br>";
} else {
    echo "Erro ao adicionar informações: " . $conn->error . "<br>";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
