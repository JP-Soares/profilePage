<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Register</title>

        <link rel="stylesheet" href="assets/css/styleIndex.css" />

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

            $_SESSION["idUsuario"] = $idUsuario;
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
        <h1>Olá!</h1>
        <h3>Atualize seus dados como prefierir!</h3>

        <div id="container">
            <form method="POST" action="assets/php/update.php" name="" enctype="multipart/form-data">

                <?php 
                    $tecnologias = explode(", ",$_SESSION["tecnologias"]);
                ?>

                <label for="txtNome">Nome:</label><br>
                <input type="text" name="txtNome" id="txtNome" value="<?php echo $_SESSION["nome"]; ?>" required/><br><br>
                
                <label for="txtDtNasc">Data de Nascimento:</label><br>
                <input type="date" name="txtDtNasc" value="<?php echo $_SESSION["dtNasc"]; ?>" required/><br><br>
                
                <label for="txtEmail">Email:</label><br>
                <input type="email" name="txtEmail" id="txtEmail" value="<?php echo $_SESSION["email"]; ?>" required/><br><br>
                
                <label for="txtDescricao">Descrição Pessoal (Opicional):</label><br>
                <textarea name="txtDescricao" id="txtDescricao"><?php echo $_SESSION["descricao"]; ?></textarea><br><br>

                <label>Tecnologias domninantes:</label><br>
                <table cellspacing="20px">
                    <tr>
                        <td><input type="checkbox" name="tecnologias[]" value="html" <?php for($indice=0; $indice < count($tecnologias); $indice++){
                        if($tecnologias[$indice] == "html"){
                        ?> checked <?php }
                    } ?>/><label>HTML</label></td>
                        <td><input type="checkbox" name="tecnologias[]" value="css" <?php for($indice=0; $indice < count($tecnologias); $indice++){
                        if($tecnologias[$indice] == "css"){
                        ?> checked <?php }
                    } ?> /><label>CSS</label></td>
                    </tr>
                    
                    <tr>
                        <td><input type="checkbox" name="tecnologias[]" value="javascript" <?php for($indice=0; $indice < count($tecnologias); $indice++){
                        if($tecnologias[$indice] == "javascript"){
                        ?> checked <?php }
                    } ?> /><label>JavaScript</label></td>
                        <td><input type="checkbox" name="tecnologias[]" value="php"  <?php for($indice=0; $indice < count($tecnologias); $indice++){
                        if($tecnologias[$indice] == "php"){
                        ?> checked <?php }
                    } ?> /><label>PHP</label></td>
                    </tr>

                    <tr>
                        <td><input type="checkbox" name="tecnologias[]" value="sql" <?php for($indice=0; $indice < count($tecnologias); $indice++){
                        if($tecnologias[$indice] == "sql"){
                        ?> checked <?php }
                    } ?> /><label>SQL</label></td>
                        <td><input type="checkbox" name="tecnologias[]" value="java" <?php for($indice=0; $indice < count($tecnologias); $indice++){
                        if($tecnologias[$indice] == "java"){
                        ?> checked <?php }
                    } ?> /><label>Java</label></td>
                    </tr>
                </table><br><br>

                <label for="foto">Sua foto de perfil (Opicional):</label><br>
                <label class="file-input-wrapper">
                    <input type="file" name="fotoPerfil" id="foto" />
                    <img id="imagemPreview" name="imgPrev" src="<?php echo $_SESSION["foto"]; ?>" alt="Clique aqui!" style="max-width: 100%;">
                </label><br><br>
                
                <label for="txtSenha">Senha:</label><br>
                <input type="password" name="txtSenha" id="txtSenha" value="<?php echo $_SESSION["senha"]; ?>" required/><br><br>
                
                <label for="txtConfirmaSenha">Confirme a senha:</label><br>
                <input type="password" name="txtConfirmaSenha" id="txtConfirmaSenha" required/><br><br>

                <input type="submit" value="Atualizar!" />

                <p id="msgLogin"><a id="msgLink" href="profilePage.php">Cancelar</a></p>

                <p id="msgErro"><?php echo $_SESSION["msgErro"]; ?></p>
            </form>
        </div>

        <?php
            if($_SESSION["msgErroPage"] == "update"){
                echo "
                    <script>
                        document.getElementById('msgErro').style.display='block';
                    </script>
                ";

                $_SESSION["msgErroPage"] = "";
            }
        ?>

        <style>
            #msgLogin a:hover{
                color: red;
            }
        </style>

        <script type="text/javascript" src="assets/js/foto.js"></script>

    </body>
</html>