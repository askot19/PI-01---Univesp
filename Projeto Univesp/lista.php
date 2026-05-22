<?php
session_start();
include_once('config.php');

// Verifica login
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
    exit;
}

$logado = $_SESSION['email'];
$data = "";

// Pesquisa
if(isset($_GET['search']) && !empty(trim($_GET['search'])))
{
    $data = mysqli_real_escape_string(
        $conexao,
        trim($_GET['search'])
    );

    $sql = "SELECT * FROM clientes
            WHERE cpf LIKE '%$data%'
            OR nome LIKE '%$data%'
            OR email LIKE '%$data%'
            ORDER BY cpf DESC";
}
else
{
    $sql = "SELECT * FROM clientes
            ORDER BY cpf DESC";
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

body{
    background:linear-gradient(
        to right,
        rgb(20,147,220),
        rgb(17,54,71)
    );

    color:white;
    text-align:center;
}

.table-bg{
    background:rgba(0,0,0,0.3);
    border-radius:15px;
    overflow:hidden;
}

.box-search{
    display:flex;
    justify-content:center;
    gap:10px;
    margin-bottom:30px;
}

</style>

</head>

<body>

<!-- Navbar -->

<nav class="navbar navbar-dark bg-primary px-3">

    <a href="sistema.php" class="btn btn-light btn-sm">
        ← Voltar
    </a>

    <span class="navbar-brand mx-auto">
        LISTA DE CLIENTES | RESTAURANTE VIVA
    </span>

    <a href="sair.php" class="btn btn-danger btn-sm">
        Sair
    </a>

</nav>

<br>

<h2>
Bem-vindo
<u><?php echo htmlspecialchars($logado); ?></u>
</h2>

<br>

<!-- Campo pesquisa -->

<div class="box-search">

<input
type="search"
id="pesquisar"
class="form-control w-25"
placeholder="Pesquisar CPF, nome ou e-mail..."
value="<?php echo htmlspecialchars($data); ?>"
>

<button
onclick="searchData()"
class="btn btn-primary">
🔍
</button>

</div>

<!-- Tabela -->

<div class="m-4">

<table class="table table-hover text-white table-bg">

<thead>

<tr>

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

if(mysqli_num_rows($result) > 0)
{
    while($user_data = mysqli_fetch_assoc($result))
    {
        echo "<tr>";

        echo "<td>".$user_data['cpf']."</td>";
        echo "<td>".$user_data['nome']."</td>";
        echo "<td>".$user_data['email']."</td>";
        echo "<td>".$user_data['telefone']."</td>";
        echo "<td>".$user_data['sexo']."</td>";
        echo "<td>".$user_data['data_nasc']."</td>";
        echo "<td>".$user_data['cidade']."</td>";
        echo "<td>".$user_data['estado']."</td>";
        echo "<td>".$user_data['endereco']."</td>";

        echo "<td>

        <a
        class='btn btn-sm btn-primary'
        href='edit.php?cpf=".$user_data['cpf']."'
        title='Editar'>
        ✏️
        </a>

        <a
        class='btn btn-sm btn-danger'
        href='delete.php?cpf=".$user_data['cpf']."'
        title='Excluir'>
        🗑️
        </a>

        </td>";

        echo "</tr>";
    }
}
else
{
    echo "
    <tr>
        <td colspan='10'>
        Nenhum cliente encontrado
        </td>
    </tr>";
}

?>

</tbody>

</table>

</div>

<script>

let search = document.getElementById('pesquisar');


// Enter faz pesquisa
search.addEventListener("keydown", function(event){

    if(event.key === "Enter"){
        searchData();
    }

});


// Detecta alterações no campo
search.addEventListener("input", function(){

    // Se ficou vazio, volta lista completa
    if(search.value.trim() === "")
    {
        window.location.href =
        window.location.pathname;
    }

});


function searchData(){

    let valor = search.value.trim();

    // Se estiver vazio
    if(valor === "")
    {
        window.location.href =
        window.location.pathname;

        return;
    }

    // Pesquisa
    window.location.href =
    window.location.pathname +
    '?search=' +
    encodeURIComponent(valor);

}

</script>

</body>
</html>