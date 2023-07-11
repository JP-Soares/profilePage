<?php
    include_once('conexao.php');

    $email = mysqli_real_escape_string($con, trim($_POST['txtEmail']));
    $senha = mysqli_real_escape_string($con, trim($_POST['txtSenha']));
    
    $sqlVerify = mysqli_query($con,"SELECT * FROM usuario_dados WHERE email='$email' AND senha='$senha'");

    if(mysqli_num_rows($sqlVerify) == 0){
        echo"ERROR (NÃO CADASTRADO)";
    }else{
        echo"EXISTE";

        while($dadosUsuario = mysqli_fetch_assoc($sqlVerify)){
            $idUsuario = $dadosUsuario["id_usuario"];
        }
        session_start();
        $_SESSION["id_usuario"] = $idUsuario;
        
        header('Location: ../../profilePage.php');
    }
?>