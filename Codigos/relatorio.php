<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Atendimento</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom, #aaffaa, #ffffff); /* Fundo degradê verde claro para branco */
            color: #333; /* Cinza escuro */
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
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

        h2, h3 {
            color: #4CAF50; /* Verde */
            margin-bottom: 20px;
            text-align: center; /* Centraliza o texto */
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            margin-bottom: 20px;
            overflow-x: auto; /* Adicionando barra de rolagem horizontal */
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

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        section {
            margin-bottom: 40px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>NutriçãoQ</h2>
        <a href="index.php">Início</a>
        <a href="pacientes.php">Pacientes</a>
        <a href="profissional.php">Profissional</a>
    </div>

    <div class="content">
        <h2>Relatório de Atendimento</h2>

        <!-- Seção de Informações dos Profissionais -->
        <section>
            <h3>Informações dos Profissionais</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Supervisor</th>
                    <th>Situação</th>
                    <th>Conselho Profissional</th>
                </tr>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "meubanco";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
                }

                $sqlProfissional = "SELECT * FROM profissional";
                $resultProfissional = $conn->query($sqlProfissional);

                if ($resultProfissional->num_rows > 0) {
                    while ($row = $resultProfissional->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['cod_profissional']}</td>
                                <td>{$row['nome_profissional']}</td>
                                <td>{$row['tipo_profissional']}</td>
                                <td>{$row['supervisor_profissional']}</td>
                                <td>{$row['situacao_profissional']}</td>
                                <td>{$row['conselho_profissional']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum profissional encontrado.</td></tr>";
                }
                ?>
            </table>
        </section>

        <!-- Seção de Informações do Procedimento -->
        <section>
            <h3>Informações do Procedimento</h3>
            <table>
                <tr>
                    <th>ID Procedimento</th>
                    <th>Nome do Procedimento</th>
                    <th>Descrição</th>
                    <th>Valor do Procedimento</th>
                </tr>
                <?php
                $sqlProcedimento = "SELECT * FROM procedimento";
                $resultProcedimento = $conn->query($sqlProcedimento);

                if ($resultProcedimento->num_rows > 0) {
                    while ($row = $resultProcedimento->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_procedimento']}</td>
                                <td>{$row['nome_procedimento']}</td>
                                <td>{$row['descricao_procedimento']}</td>
                                <td>{$row['valor_procedimento']}</td>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum procedimento encontrado.</td></tr>";
                }
                ?>
            </table>
        </section>

        <!-- Seção de Avaliação Nutricional -->
        <section>
            <h3>Avaliação Nutricional</h3>
            <?php
            $sqlAvaliacaoNutricional = "SELECT * FROM avaliacao_nutricional";
            $resultAvaliacaoNutricional = $conn->query($sqlAvaliacaoNutricional);

            if ($resultAvaliacaoNutricional->num_rows > 0) {
                while ($row = $resultAvaliacaoNutricional->fetch_assoc()) {
                    echo "<table>";
                    echo "<tr><th>ID Avaliação</th><td>{$row['id']}</td></tr>";
                    echo "<tr><th>Nome do Paciente</th><td>{$row['nome_paciente']}</td></tr>";
                    echo "<tr><th>ID Profissional</th><td>{$row['id_profissional']}</td></tr>";
                    echo "<tr><th>Código Procedimento</th><td>{$row['codigo_procedimento']}</td></tr>";
                    echo "<tr><th>Data Avaliação</th><td>{$row['data_avaliacao']}</td></tr>";
                    echo "<tr><th>Histórico Clínico</th><td>{$row['historico_clinico']}</td></tr>";
                    echo "<tr><th>Exames</th><td>{$row['exames']}</td></tr>";
                    echo "<tr><th>Avaliação Antropométrica</th><td>{$row['avaliacao_antropometrica']}</td></tr>";
                    echo "<tr><th>Circunferência Cefálica</th><td>{$row['circunferencia_cefalica']}</td></tr>";
                    echo "<tr><th>Circunferência Braço</th><td>{$row['circunferencia_braco']}</td></tr>";
                    echo "<tr><th>Circunferência Punho</th><td>{$row['circunferencia_punho']}</td></tr>";
                    echo "<tr><th>Circunferência Cintura</th><td>{$row['circunferencia_cintura']}</td></tr>";
                    echo "<tr><th>Circunferência Quadril</th><td>{$row['circunferencia_quadril']}</td></tr>";
                    echo "<tr><th>Circunferência Panturrilha</th><td>{$row['circunferencia_panturrilha']}</td></tr>";
                    echo "<tr><th>Dobra Cutânea</th><td>{$row['dobra_cutanea']}</td></tr>";
                    echo "<tr><th>Dobra Cutânea Subescapular</th><td>{$row['dobra_cutanea_subescapular']}</td></tr>";
                    echo "<tr><th>Dobra Cutânea Abdominal</th><td>{$row['dobra_cutanea_abdominal']}</td></tr>";
                    echo "<tr><th>Circunferência Suprailíaca</th><td>{$row['circunferencia_suprailiaca']}</td></tr>";
                    echo "<tr><th>Dobra Cutânea Panturrilha</th><td>{$row['dobra_cutanea_panturrilha']}</td></tr>";
                    echo "<tr><th>Dobra Cutânea Coxa</th><td>{$row['dobra_cutanea_coxa']}</td></tr>";
                    echo "<tr><th>Plano Alimentar</th><td>{$row['plano_alimentar']}</td></tr>";
                    echo "</table>";
                }
            } else {
                echo "<p>Nenhuma avaliação nutricional encontrada.</p>";
            }
            ?>
        </section>

        <center><a href="fichanutri.php" class="btn-outra-pagina">Cadastro</a></center>

        <?php
        $conn->close();
        ?>
    </div>
</body>

</html>
