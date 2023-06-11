<?php

    // $_SESSION["msgErro"] = "teste";
    // $_SESSION["erro"] = true;

    // header('Location: ../../index.html');

    // echo"<script>
    //     window.location.href='../../index.html';
    // </script>";

    session_start();

    include_once("conexao.php");

    $nome = mysqli_real_escape_string($con, trim($_POST['txtNome']));
    $dtNasc = mysqli_real_escape_string($con, trim($_POST['txtDtNasc']));
    $email = mysqli_real_escape_string($con, trim($_POST['txtEmail']));
    $descricao = mysqli_real_escape_string($con, trim($_POST['txtDescricao']));
    $tecnologias = mysqli_real_escape_string($con, trim($_POST['tecnologias']));

    $senha = mysqli_real_escape_string($con, trim($_POST['txtSenha']));
    $senhaConfirma = mysqli_real_escape_string($con, trim($_POST['txtConfirmaSenha']));

    $verificar = mysqli_query($con, "SELECT * from usuario_dados where email='$email'");


    // $nomeArquivo = $_FILES['foto']['name'];
    // $caminhoAtualArquivo = $_FILES['foto']['tmp_name'];
    // $caminhoSalvar = '../img/'.$nomeArquivo;
    // move_uploaded_file($caminhoAtualArquivo, $caminhoSalvar);
    // $pasta = "../img";
    // $diretorio = dir($pasta);

    if(mysqli_num_rows($verificar) == 0){
        if($senha == $senhaConfirma){
            $sql = "INSERT INTO usuario_dados (nome, dtNasc, email, descricao, tecnologias, senha) VALUES ('$nome', '$dtNasc', '$email', '$descricao', '$tecnologias', '$senhaConfirma')";

            if($con->query($sql) == true){
                header('Location: ../../profilePage.html');
            }

        }else{
            echo"<script>alert('Erro1');</script>";
            $_SESSION['msgErro'] = "Senhas incorretas!";
            //header('Location: ../../index.html');
        }
    }else{
        echo"<script>alert('Erro2');</script>";
        $_SESSION['msgErro'] = "Email já cadastrado!";
        //header('Location: ../../index.html');
    }

?>