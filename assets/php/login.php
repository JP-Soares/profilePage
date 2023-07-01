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
            $nome = $dadosUsuario["nome"];
            $dtNasc = $dadosUsuario["dtNasc"];
            $email = $dadosUsuario["email"];
            $descricao = $dadosUsuario["descricao"];
            $tecnologias = $dadosUsuario["tecnologias"];
            $foto = $dadosUsuario["foto"];
            $senha = $dadosUsuario["senha"];
        }
        session_start();
        $_SESSION["idUsuario"] = $idUsuario;
        $_SESSION["nome"] = $nome;
        $_SESSION["dtNasc"] = $dtNasc;
        $_SESSION["email"] = $email;
        $_SESSION["descricao"] = $descricao;
        $_SESSION["tecnologias"] = $tecnologias;
        $_SESSION["foto"] = $foto;
        $_SESSION["senha"] = $senha;

        header('Location: ../../profilePage.php');
    }
?>