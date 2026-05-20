<?php

   // print_r($_REQUEST);

   if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']))
    {
        //Acessa
        include_once('usuario.php');
    }
    else
    {
        //Não acessa
        header('Location: login.php');
    }

?>