<!DOCTYPE html>
<?php
    include_once "../../php/utils/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $usu = new Usuario('','','','','','','','','');
        $lista = $usu->select('*', "id = $id");
    }

?>
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
        echo "<a role='button' href='../../view/usuario/usuarios.php?analista=".$_SESSION['id']."'><img src='../../img/arrow.svg' style='width: 2.5%;'></a>";
    ?>
    <section id="perfil">            
        <form action="editPerfil.php?update=true" method="post" style="color: #fff;" class="card-perfil">
            <div><h2>Informações do perfil</h2></div><br>
            <?php
                $pdo = Database::iniciaConexao();
                $consulta = $pdo->query("SELECT * FROM usuario WHERE $id = id;");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="col-auto">
                <div class="input-group">    
                    <label class="input-group-text border border-dark rounded-start" for="nome">Nome completo</label>
                    <input required type="text" id="nome" name="nome" style="background-color:#fff; width: 65%;" value="<?php echo $linha['nome'];?>" disabled class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="email">E-mail</label>
                    <input required type="email" id="email" name="email" style="background-color:#fff; width: 81%;" value="<?php echo $linha['email'];?>" disabled class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="cpf">CPF</label>
                    <input required type="text" id="cpf" name="cpf" style="background-color:#fff; width: 86%;" value="<?php echo $linha['cpf'];?>" disabled class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="telefone">Telefone</label>
                    <input required type="tel" id="telefone" name="telefone" style="background-color:#fff; width: 78%;" value="<?php echo $linha['telefone'];?>" disabled class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="curriculo">Currículo</label>  
                    <input type="url" id="curriculo" name="curriculo" style="background-color:#fff; width: 77%;" value="<?php echo $linha['curriculo'];?>" disabled class="form-control-sm border border-dark rounded-end">
                </div>
            </div>
            <?php } ?>
        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>