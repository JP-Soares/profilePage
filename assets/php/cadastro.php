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
    $tecnologias = $_POST['tecnologias'];

    $senha = mysqli_real_escape_string($con, trim($_POST['txtSenha']));
    $senhaConfirma = mysqli_real_escape_string($con, trim($_POST['txtConfirmaSenha']));

    $verificar = mysqli_query($con, "SELECT * from usuario_dados where email='$email'");

    if(mysqli_num_rows($verificar) == 0){
        if($senha == $senhaConfirma){
            
            if(isset($_FILES['fotoPerfil'])){
                echo"aqui";
                $nomeArquivo = $_FILES['fotoPerfil']['name'];
                $caminhoAtualArquivo = $_FILES['fotoPerfil']['tmp_name'];
                $caminhoSalvar = '../img/'.$nomeArquivo;
                move_uploaded_file($caminhoAtualArquivo, $caminhoSalvar);
                $pasta = "../img";
                $diretorio = dir($pasta);

                $tecnologiasString = implode(', ',$tecnologias);
                
                echo"AQUI";
                $sql = "INSERT INTO usuario_dados (nome, dtNasc, email, descricao, tecnologias, foto, senha) VALUES ('$nome', '$dtNasc', '$email', '$descricao', '$tecnologiasString', '$caminhoSalvar', '$senhaConfirma')";
            }else{
                $tecnologiasString = implode(', ',$tecnologias);
                echo"AQUI2";
                $sql = "INSERT INTO usuario_dados (nome, dtNasc, email, descricao, tecnologias, senha) VALUES ('$nome', '$dtNasc', '$email', '$descricao', '$tecnologiasString', '$senhaConfirma')";
            }

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