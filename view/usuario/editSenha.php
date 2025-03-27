<?php
    $update = isset($_GET["update"]) ? $_GET["update"] : "";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Editar Perfil</title>
</head>
<body>
    <header>
        <?php include_once "menuprog.php"; ?>
    </header>
    <section id="editar-perfil">            
        <form action="../../php/controle/controlePerfil.php?acao=editar" method="post" style="color: #fff;"  class="card-perfil">
            <div><h2>Editar senha do perfil</h2></div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="senha">Senha</label>
                    <input required onkeyup='confirmarSenha();' type="password" id="senha" name="senha" minlength="6" style="background-color:#fff; width: 82%;" class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="novasenha">Nova senha</label>
                    <input onkeyup='confirmarSenha();' type="password" id="novasenha" name="novasenha" style="width: 73%;" minlength="6" maxlength="20" class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="novasenhaconfirma">Confirmar senha</label>
                    <input onkeyup='confirmarSenha();' type="password" id="novasenhaconfirma" name="novasenhaconfirma" minlength="6" maxlength="20" style="width: 63%;" class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div>
                <a onclick="<?php if(isset($update)){echo "return confirm('Deseja mesmo cancelar?')";}?>" href="<?php if(!isset($update)){echo "perfil.php?update=true";} else {echo "perfil.php";}?>"><button style="width: 49%;height: 41px;background-color: #a13854;border:none;color:#fff;margin: 10px 0;" type="button" id="editarEcancelar" onclick="editarEcancela()"><?php if(!isset($update)) {echo "Editar";} else {echo "Cancelar";}?></button></a>
                <a><button style="width: 49%;height: 41px;background-color: #be2444;border:none;color:#fff;margin: 10px 0;font-weight: bold;" type="submit" id="enviar">Salvar</button></a></div>
        </form>
    </section>
    <script>var senhaAtual = "<?php echo $data["senha"];?>";</script>
    <script src="../../js/perfil.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>