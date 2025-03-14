<!DOCTYPE html>
<?php
    include_once "../../php/utils/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $pro = new Projeto('','','','','','','','','');
        $lista = $pro->select('*', "id = $id");
    }

    $analista = isset($_GET["analista"]) ? $_GET["analista"] : 0;
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
    $table = "projeto";

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <title>projetos</title>
</head>
<body>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <section>
        <form method="post" style="padding-left: 2em;">
            <h1 style="color:white ;">Pesquisar usuarios por nome:</h1><br>
            <div class="col-auto">
                <div class="input-group">    
                    <div class="input-group-text border border-dark rounded-start">Nome:</div>
                    <input type="text" name="procurar" id="procurar" size="25" value="<?php echo $procurar;?>" class="form-control-sm border border-dark rounded-end">
                    <button name="acao" id="acao" type="submit" style="background-color: #a13854;border:none;color:#fff;" class="btn btn-dark">Pesquisar</button>
                </div>
            </div>
            <br>
        </form>
        <div style="padding-left: 2em;padding-right: 2em;">
            <table border='1' class="table table-light table-striped">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">Nome do usuário</th>
                        <th scope="col">Detalhes</th>
                        <th scope="col">Ativar / Desativar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $lista = Usuario::listar2(1, $procurar, $_SESSION['id']);
                    foreach ($lista as $linha) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $linha['nome'];?></th>
                        <td scope="row"><a href="verPerfil.php?id=<?php echo $linha['id'];?>"><img src="../../img/info.svg" alt=""></a></td>
                        <td scope='row'><?php if($linha['status'] == "ativado"){ echo "<a href='../../php/controle/controlePerfil.php?id=".$linha['id']."&acao=desativar'><img src='../../img/circle-check.svg' alt=''></a>";}
                        elseif($linha['status'] == "desativado"){ echo "<a href='../../php/controle/controlePerfil.php?id=".$linha['id']."&acao=ativar'><img src='../../img/circle-x.svg' alt=''></a>";}?></td>
                    </tr>
                <?php } ?> 
                </tbody>
            </table>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>