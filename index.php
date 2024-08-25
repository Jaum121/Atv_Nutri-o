<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
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
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .sidebar {
            width: 250px;
            background-color: #2e7d32; /* Verde escuro */
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar h2 {
            color: #ffffff; /* Branco */
            text-align: center;
        }

        .sidebar a {
            display: block;
            color: #ffffff; /* Branco */
            padding: 10px;
            text-decoration: none;
            margin: 10px 0;
        }

        .sidebar a:hover {
            background-color: #1b5e20; /* Verde mais escuro */
        }

        .content {
            margin-left: 250px; /* Largura da barra lateral */
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        h1 {
            color: #4CAF50; /* Verde */
            margin-bottom: 20px;
            text-align: center; /* Centraliza o texto */
        }

        .buttons {
            display: flex;
            flex-direction: row; /* Alinha os botões horizontalmente */
            align-items: center;
            justify-content: center;
            flex-wrap: wrap; /* Permite que os botões quebrem linha se necessário */
        }

        .buttons a {
            display: inline-block;
            background-color: #4CAF50; /* Verde */
            color: #fff; /* Branco */
            padding: 15px 25px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            transition: background-color 0.3s;
            font-size: 16px; /* Aumenta o tamanho da fonte */
        }

        .buttons a:hover {
            background-color: #45a049; /* Verde mais escuro (tom mais escuro) ao passar o mouse */
        }

        .logo {
            width: 300px; /* Aumenta o tamanho do logo */
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Nutrição</h2>
        
       
       
        <a href="cadastrar_usuario.php">Cadastrar Usuário</a>
        <a href="logout.php">Sair</a>
    </div>

    <div class="content">
        <img src="LOGO-FASIPE.png" alt="Logo Fasipe" class="logo">
        <h1>Página Inicial</h1>
        <div class="buttons">
            <a href="formulario.html">Atendimento</a>
            <a href="fichanutri.php">Ficha nutricional</a>
            <a href="inicio.php">Histórico</a>
            <a href="agendamento.php">agendamento</a>
             <a href="pagina_consulta.html">Consultar</a>


        </div>
    </div>
</body>
</html>
