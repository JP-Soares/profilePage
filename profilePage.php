<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Profile</title>

        <link rel="stylesheet" href="assets/css/styleProfile.css" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300&display=swap" rel="stylesheet">

        <link rel="shortcut icon" href="assets/siteImages/icon.png">

        <?php
            include_once('assets/php/conexao.php');

            session_start();
            $sqlVerify = mysqli_query($con,"SELECT * FROM usuario_dados WHERE id_usuario='".$_SESSION["id_usuario"]."'");
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

            $_SESSION["id_usuario"] = $idUsuario;
            $_SESSION["nome"] = $nome;
            $_SESSION["dtNasc"] = $dtNasc;
            $_SESSION["email"] = $email;
            $_SESSION["descricao"] = $descricao;
            $_SESSION["tecnologias"] = $tecnologias;
            $_SESSION["foto"] = $foto;
            $_SESSION["senha"] = $senha;
        ?>

    </head>
    <body>
        <h1>Seu perfil!</h1>
        <div id="container">
            <table>
                <tr>
                    <td><img src="<?php echo $foto; ?>" /></td>
                    <td><p id="nome">Nome: <?php echo $_SESSION["nome"]; ?></p>
                        <p>E-mail: <?php echo $_SESSION["email"]; ?></p>
                        <p>Data de nascimento: <?php echo date('d/m/y', strtotime($_SESSION["dtNasc"])); ?></p></td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="celDescricao"><h2>Descrição Pessoal:</h2></td>
                    <td class="celTecnologias"><h2>Tecnologias:</h2></td>
                </tr>

                <tr>
                    <td class="celDescricao"><p id="descricao"><?php echo $_SESSION["descricao"]; ?></p></td>
                    <td class="celTecnologias" id="txtTecnologias"><ul>
                        <?php
                            $tecnologias = explode(", ",$_SESSION["tecnologias"]);

                            for($indice=0; $indice < count($tecnologias); $indice++){
                                ?><li><?php echo strtoupper($tecnologias[$indice]); ?></li>
                            <?php }
                        ?>
                    </ul></td>
                </tr>
            </table>

            <p id="msgAtualizar">Gostaria de atualizar seus dados?<a href="updateProfile.php">Clique Aqui!</a></p>

            <p id="msgSair"><a href="assets/php/logOut.php">Sair</a></p>
        </div>
    </body>
</html>