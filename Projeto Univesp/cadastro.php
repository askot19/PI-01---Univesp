<?php

if(isset($_POST['submit']))
{
    include_once('config.php');

    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    
    $senha = $_POST['senha'];

    $stmt = $conexao->prepare(
    "INSERT INTO usuarios(cpf,nome,email,senha)
    VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param("ssss", $cpf, $nome, $email, $senha);

    $stmt->execute();

    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Viva Café & Restaurante</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        .box{
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 20%;
        }
        fieldset{
            border: 3px solid dodgerblue;
        }
        legend{
            border: 1px solid dodgerblue;
            padding: 10px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 8px;
        }
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 12px;
            color: dodgerblue;
        }
        #data_nascimento{
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }
        #submit{
            background-image: linear-gradient(to right,rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover{
            background-image: linear-gradient(to right,rgb(0, 80, 172), rgb(80, 19, 195));
        }
    </style>
</head>
<body>
    <a href="home.php">Voltar</a>
    <div class="box">
<form action="" method="POST">

    <div class="inputBox">
        <input type="text" name="cpf" class="inputUser" required>
        <label class="labelInput">CPF</label>
    </div>

    <br><br>

    <div class="inputBox">
        <input type="text" name="nome" class="inputUser" required>
        <label class="labelInput">Nome completo</label>
    </div>

    <br><br>

    <div class="inputBox">
        <input type="email" name="email" class="inputUser" required>
        <label class="labelInput">Email</label>
    </div>

    <br><br>

    <div class="inputBox">
        <input type="password" name="senha" class="inputUser" required>
        <label class="labelInput">Senha</label>
    </div>

    <br><br>

    <input type="submit" name="submit" id="submit">

</form>
    </div>
</body>
</html>