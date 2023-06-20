<?php
    include_once('conexao.php');

    $email = mysqli_real_escape_string($con, trim($_POST['txtEmail']));
    $senha = mysqli_real_escape_string($con, trim($_POST['txtSenha']));
    
    $sqlVerify = mysqli_query($con,"SELECT * FROM usuario_dados WHERE email='$email' AND senha='$senha'");

    if(mysqli_num_rows($sqlVerify) == 0){
        echo"ERROR (NÃO CADASTRADO)";
    }else{
        echo"EXISTE";
    }
?>