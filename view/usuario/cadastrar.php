<!DOCTYPE html>
<?php
    include_once "../../php/utils/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $usu = new Usuario('','','','','','','','','');
        $lista = $usu->select('*', "id = $id");
    }

    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $email2 = isset($_POST["email2"]) ? $_POST["email2"] : "";
    $senha = isset($_POST["senha"]) ? $_POST["senha"] : "";
    $senha2 = isset($_POST["senha2"]) ? $_POST["senha2"] : "";
    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : "";
    $cpf = isset($_POST["cpf"]) ? $_POST["cpf"] : "";
    $telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : "";
    $curriculo = isset($_POST["curriculo"]) ? $_POST["curriculo"] : "";
    $status = "ativado";
    $table = "usuario";

    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "insert") {
        try{
            $usu = new Usuario("", $nome, $email, $senha, $tipo, $cpf, $telefone, $curriculo, $status);
            $usu->inserir();
            header("location:cadsucesso.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    }
?>
<html>
<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script type="text/javascript" src="../../js/ajaxCadastro.js"></script>
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Cadastrar</title>
</head>
<body>
    <section id="cadastrar">
        <form action="cadastrar.php?acao=insert" method="POST" class="card">
            <div class="card-header-cadastrar">
                <h2>Cadastrar</h2>
            </div>
            <div class="card-content">
                <input readonly type="hidden" name="id" id="id">
                <div class="card-content-area">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" autocomplete="off" autofocus required onblur="validarDados('nome', document.getElementById('nome').value);">
                    <div id="campo_nome" style="color: white; opacity: 50%;"></div>
                </div>
                <div class="card-content-area">
                    <label for="email">Email</label>
                    <input onkeyup='confirmacao();' type="email" id="email" name="email" autocomplete="off" required onblur="validarDados('email', document.getElementById('email').value);">
                    <div id="campo_email" style="color: white; opacity: 50%;"></div>
                </div>
                <div class="card-content-area">
                    <label for="email2">Confirmar Email</label>
                    <input onkeyup='confirmacao();' type="email" id="email2" name="email2" autocomplete="off" required onblur="validarDados('email2', document.getElementById('email2').value);">
                    <div id="campo_email2" style="color: white; opacity: 50%;"></div>
                </div>
                <div class="card-content-area">
                    <label for="password">Senha</label>
                    <input onkeyup='confirmacao();' type="password" id="senha" name="senha" autocomplete="off" minlength="6" maxlength="20" required onblur="validarDados('senha', document.getElementById('senha').value);">
                    <div id="campo_senha" style="color: white; opacity: 50%;"></div>
                </div>
                <div class="card-content-area">
                    <label for="password2">Confirmar Senha</label>
                    <input onkeyup='confirmacao();' type="password" id="senha2" name="senha2" autocomplete="off" minlength="6" maxlength="20" required onblur="validarDados('senha2', document.getElementById('senha2').value);">
                    <div id="campo_senha2" style="color: white; opacity: 50%;"></div>
                </div>
                <div class="card-content-area">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" autocomplete="off" required onkeypress="$(this).mask('000.000.000-00');" onblur="validarDados('cpf', document.getElementById('cpf').value);">
                    <div id="campo_cpf" style="color: white; opacity: 50%;"></div>
                </div>
                <div class="card-content-area">
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="telefone" autocomplete="off" required onkeypress="$(this).mask('(00) 00000-0000');" onblur="validarDados('telefone', document.getElementById('telefone').value);">
                    <div id="campo_telefone" style="color: white; opacity: 50%;"></div>
                </div>
                <div class="card-content-area">
                    <label for="curriculo">Curriculo</label>
                    <input type="url" id="curriculo" name="curriculo" autocomplete="off">
                </div>
                <div class="card-content-area">
                    <label for="">Tipo de conta</label><br>
                    <select name="tipo" id="tipo">
                        <option  id="analista" name="analista" value="analista">Analista</option>
                        <option id="programador" name="programador" value="programador">Programador</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" value="cadastrar" class="submit" name="enviar" id="enviar" disabled>Cadastrar</button>
                <p class="a">Já tem conta? <a href="login.php">Logar</a></p>
            </div>
        </form>
    </section>
    <script src="../../js/cadastro.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
</body>
</html>