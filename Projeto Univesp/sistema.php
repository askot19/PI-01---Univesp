<?php
    session_start();
    //print_r($_SESSION);    
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }
    else
    {
        $logado = $_SESSION['email'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Siste | Restaurante Viva</title>
    <style>

    .table-bg
    {
        background: rgba(0, 0, 0, 0.3);
        border-radius: 15px 15px 0 0;
    }
    .box-search
    {
        display: flex;
        justify-content: center;
        gap: .1%;
    }
    body{
        font-family: Arial, Helvetica, sans-serif;
        background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        text-align: center;
        color: white;
    }
    .box{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.6);
        padding: 30px;
        border-radius: 15px;
    }
    a{
        text-decoration: none;
        color: white;
        border: 3px solid dodgerblue;
        border-radius: 10px;
        padding: 10px;
    }
    a:hover{
        background-color: dodgerblue;
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SISTEMA DO RESTAURANTE VIVA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="d-flex">
            <a href="sair.php" class="btn btn-danger me-5">Sair</a>
        </div>
    </nav>
    <br>
    <?php
        echo "<h1>Bem-vindo(a) <u>$logado</u></h1>";
    ?>

    <div class="box">
        <a href="formulario.php">Cadastrar Clientes</a>
        <a href="lista.php">Lista de Clientes</a>
    </div>
</body>
</html>