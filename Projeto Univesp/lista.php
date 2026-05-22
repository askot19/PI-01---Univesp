<?php
session_start();
include_once('config.php');

if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
    exit;
}

$logado = $_SESSION['email'];

if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM clientes 
            WHERE cpf LIKE '%$data%' 
            OR nome LIKE '%$data%' 
            OR email LIKE '%$data%' 
            ORDER BY cpf DESC";
} else {
    $sql = "SELECT * FROM clientes ORDER BY cpf DESC";
}

$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA | RESTAURANTE VIVA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            color: white;
            text-align: center;
        }

        .table-bg {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px 15px 0 0;
        }

        .box-search {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark bg-primary px-3 d-flex justify-content-between">
    
    <!-- Botão Voltar (lado esquerdo) -->
    <a href="sistema.php" class="btn btn-light btn-sm">
        ← Voltar
    </a>

    <!-- Título central -->
    <span class="navbar-brand mx-auto">
        LISTA DE CLIENTES | RESTAURANTE VIVA
    </span>

    <!-- Botão Sair (lado direito) -->
    <a href="sair.php" class="btn btn-danger btn-sm">
        Sair
    </a>
</nav>

<br>

<h1>Bem-vindo <u><?php echo $logado; ?></u></h1>

<br>

<div class="box-search">
    <input type="search" id="pesquisar" class="form-control w-25" placeholder="Pesquisar...">
    <button onclick="searchData()" class="btn btn-primary">
        🔍
    </button>
</div>

<div class="m-5">
    <table class="table text-white table-bg">
        <thead>
            <tr>
                <th>#</th>
                <th>CPF</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Sexo</th>
                <th>Data Nasc.</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
        <?php
        while ($user_data = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$user_data['cpf']}</td>";
            echo "<td>{$user_data['cpf']}</td>";
            echo "<td>{$user_data['nome']}</td>";
            echo "<td>{$user_data['email']}</td>";
            echo "<td>{$user_data['telefone']}</td>";
            echo "<td>{$user_data['sexo']}</td>";
            echo "<td>{$user_data['data_nasc']}</td>";
            echo "<td>{$user_data['cidade']}</td>";
            echo "<td>{$user_data['estado']}</td>";
            echo "<td>{$user_data['endereco']}</td>";

            echo "<td>
                <a class='btn btn-sm btn-primary' href='edit.php?cpf={$user_data['cpf']}' title='Editar'>
                    ✏️
                </a>

                <a class='btn btn-sm btn-danger' href='delete.php?cpf={$user_data['cpf']}' title='Deletar'>
                    🗑️
                </a>
            </td>";

            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            searchData();
        }
    });

    function searchData() {
        window.location = 'sistema.php?search=' + search.value;
    }
</script>

</body>
</html>