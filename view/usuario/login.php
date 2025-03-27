<?php
    include_once "../../php/utils/autoload.php";
    $alert = isset($_GET["alert"]) ? $_GET["alert"] : "";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script type="text/javascript" src="../../js/ajaxCadastro.js"></script>
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Login</title>
</head>
<body>
    <section id="login">
        <form action="../../php/controle/controleLogin.php" method="post" id="form" class="card">
            <div class="card-header-login">
                <h2>Login</h2>
            </div>
            <div class="card-content">
                <div class="card-content-area">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" autocomplete="off" autofocus required onblur="validarDados('email', document.getElementById('email').value);">
                    <div id="campo_email" style="color: white; opacity: 50%;"></div>
                </div>
                <div class="card-content-area">
                    <label for="password">Senha</label>
                    <input type="password" id="senha" name="senha" autocomplete="off" required onblur="validarDados('senha', document.getElementById('senha').value);">
                    <div id="campo_senha" style="color: white; opacity: 50%;"></div>
                </div>
                <div style="color: white; opacity: 50%;"><?php if($alert == "1") { echo "Email ou Senha incorretos";}?></div>
            </div>
            <div class="card-footer">
                <input type="submit" value="Login" class="submit">
                <p class="a">Não tem conta? <a href="cadastrar.php">Cadastrar</a></p>
            </div>
        </form>
    </section>
</body>
</html>