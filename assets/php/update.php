<?php
    
    include_once("conexao.php");
    session_start();

    $nome = mysqli_real_escape_string($con, trim($_POST['txtNome']));
    $dtNasc = mysqli_real_escape_string($con, trim($_POST['txtDtNasc']));
    $email = mysqli_real_escape_string($con, trim($_POST['txtEmail']));
    $descricao = mysqli_real_escape_string($con, trim($_POST['txtDescricao']));
    $tecnologias = $_POST['tecnologias'];

    $senha = mysqli_real_escape_string($con, trim($_POST['txtSenha']));
    $senhaConfirma = mysqli_real_escape_string($con, trim($_POST['txtConfirmaSenha']));

    $verificar = mysqli_query($con, "SELECT * from usuario_dados where email='$email'");

    if(mysqli_num_rows($verificar) == 1){
        if($senha == $senhaConfirma){
            $tecnologiasString = implode(', ',$tecnologias);
            if(isset($_FILES['fotoPerfil'])){
                $nomeArquivo = $_FILES['fotoPerfil']['name'];
                $caminhoAtualArquivo = $_FILES['fotoPerfil']['tmp_name'];
                $caminhoSalvar = '../img/'.$nomeArquivo;
                move_uploaded_file($caminhoAtualArquivo, $caminhoSalvar);
                $pasta = "../img";
                $diretorio = dir($pasta);

                $sql = mysqli_query($con, "UPDATE usuario_dados SET nome= '$nome', dtNasc= '$dtNasc', email= '$email', descricao= '$descricao', tecnologias= '$tecnologiasString', foto= '$caminhoSalvar', senha= '$senhaConfirma' WHERE id_usuario= ".$_SESSION["idUsuario"]);
                
                $_SESSION["nome"] = $nome;
                $_SESSION["dtNasc"] = $dtNasc;
                $_SESSION["email"] = $email;
                $_SESSION["descricao"] = $descricao;
                $_SESSION["tecnologias"] = $tecnologias;
                $_SESSION["foto"] = $foto;
                $_SESSION["senha"] = $senha;

                echo"Teste";
                $_SESSION["msgErroPage"] = "update";
                $_SESSION["msgErro"] = "DADOS ALTERADOS COM SUCESSO!";
                header('Location: ../../updateProfile.php');
            }else{
                $sql = mysqli_query($con, "UPDATE usuario_dados SET nome= '$nome', dtNasc= '$dtNasc', email= '$email', descricao= '$descricao', tecnologias= '$tecnologiasString', senha= '$senhaConfirma' WHERE id_usuario= ".$_SESSION['idUsuario']);
                
                $_SESSION["nome"] = $nome;
                $_SESSION["dtNasc"] = $dtNasc;
                $_SESSION["email"] = $email;
                $_SESSION["descricao"] = $descricao;
                $_SESSION["tecnologias"] = $tecnologias;
                $_SESSION["foto"] = $foto;
                $_SESSION["senha"] = $senha;

                echo"Teste";
                $_SESSION["msgErroPage"] = "update";
                $_SESSION["msgErro"] = "DADOS ALTERADOS COM SUCESSO!";
                header('Location: ../../updateProfile.php');
            
            }
            
        }
    }
?>