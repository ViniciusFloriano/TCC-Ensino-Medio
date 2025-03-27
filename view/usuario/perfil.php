<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Perfil</title>
</head>
<body>
    <header>
        <?php include_once "menuprog.php"; ?>
    </header>
    <?php
        if($_SESSION['tipo'] == "analista"){
            echo "<a role='button' href='../../view/usuario/projetos.php?analista=".$_SESSION['id']."'><img src='../../img/arrow.svg' style='width: 2.5%;'></a>";
        }else if($_SESSION['tipo'] == "programador"){
            echo "<a role='button' href='../../view/usuario/programador.php?idusu=".$_SESSION['id']."'><img src='../../img/arrow.svg' style='width: 2.5%;'></a>";
        }
    ?>
    <section id="perfil">            
        <form action="editPerfil.php?update=true" method="post" style="color: #fff;" class="card-perfil">
            <div><h2>Informações do perfil</h2></div><br>
            <div class="col-auto">
                <div class="input-group">    
                    <label class="input-group-text border border-dark rounded-start" for="nome">Nome completo</label>
                    <input required type="text" id="nome" name="nome" style="background-color:#fff; width: 65%;" value="<?php echo $data['nome'];?>" disabled class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="email">E-mail</label>
                    <input required type="email" id="email" name="email" style="background-color:#fff; width: 81%;" value="<?php echo $data['email'];?>" disabled class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="senha">Senha</label>
                    <input required type="password" id="senha" name="senha" minlength="6" style="background-color:#fff; width: 82%;" value="<?php echo $data['senha'];?>" disabled class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="cpf">CPF</label>
                    <input required type="text" id="cpf" name="cpf" style="background-color:#fff; width: 86%;" value="<?php echo $data['cpf'];?>" disabled class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="telefone">Telefone</label>
                    <input required type="tel" id="telefone" name="telefone" style="background-color:#fff; width: 78%;" value="<?php echo $data['telefone'];?>" disabled class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="curriculo">Currículo</label>  
                    <input type="url" id="curriculo" name="curriculo" style="background-color:#fff; width: 77%;" value="<?php echo $data['curriculo'];?>" disabled class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div><a><button style="width: 49%;height: 41px;background-color: #be2444;border:none;color:#fff;margin: 10px 0;font-weight: bold;" type="submit" id="enviar">Editar Perfil</button></a>
            <a href="editSenha.php"><button style="width: 49%;height: 41px;background-color: #be2444;border:none;color:#fff;margin: 10px 0;font-weight: bold;" type="button">Editar Senha</button></a>
            <a onclick="return confirm('Deseja mesmo desativar?')" href="../../php/controle/controlePerfil.php?acao=excluir"><button style="width: 100%;height: 41px;background-color: #a13854;border:none;color:#fff;" type="button" value="excluir">Desativar a conta</button></a></div>
        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>