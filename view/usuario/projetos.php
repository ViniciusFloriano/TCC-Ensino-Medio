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
            <h1 style="color:white ;">Pesquisar projetos por nome:</h1><br>
            <div class="col-auto">
                <div class="input-group">    
                    <div class="input-group-text border border-dark rounded-start">Nome:</div>
                    <input type="text" name="procurar" id="procurar" size="25" value="<?php echo $procurar;?>" class="form-control-sm border border-dark rounded-end">
                    <button name="acao" id="acao" type="submit" style="background-color: #a13854;border:none;color:#fff;margin-left: 0.5em;" class="btn btn-dark rounded">Pesquisar</button>
                </div>
            </div>
            <br>
        </form>
        <div style="padding-left: 2em;padding-right: 2em;">
            <table border='1' class="table table-light table-striped">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">Nome do projeto</th>
                        <th scope="col">Detalhes</th>
                        <th scope="col">Andamento</th>
                        <th scope="col">Requisitos</th>
                        <th scope="col">Alterar</th>
                        <th scope="col">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $lista = Projeto::listar2(1, $procurar, $analista);
                    foreach ($lista as $linha) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $linha['nome'];?></th>
                        <td scope="row"><a href="verProjeto.php?id=<?php echo $linha['id'];?>&analista=<?php echo $analista;?>"><img src="../../img/info.svg" alt=""></a></td>
                        <td scope="row"><a href="estadoProj.php?analista=<?php echo $analista?>"><img src="../../img/clock.svg" alt=""></a></td>
                        <td scope="row"><a href="requisitos.php?idpro=<?php echo $linha['id']?>"><img src="../../img/requisito.svg" alt=""></a></td>
                        <td scope="row"><a href="cadProjeto.php?id=<?php echo $linha['id'];?>&analista=<?php echo $analista;?>"><img src="../../img/edit.svg" alt=""></a></td>
                        <td scope="row"><a onclick="return confirm('Deseja mesmo excluir?')" href="cadProjeto.php?id=<?php echo $linha['id'];?>&analista=<?php echo $analista;?>&acao=excluir"><img src="../../img/trash-2.svg" alt=""></a></td>
                    </tr>
                <?php } ?> 
                </tbody>
            </table>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>