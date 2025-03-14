<!DOCTYPE html>
<?php
    include_once "../../php/utils/autoload.php";
    $idpro = $_GET["idpro"];
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Programador</title>
</head>
<body>
    <header>
        <?php include_once "menuprog.php"; ?>
    </header>
    <a role='button' href='../../view/usuario/programador.php?idusu=<?php echo $_SESSION['id']?>'><img src='../../img/arrow.svg' style='width: 2.5%;'></a>
    <center><h3 style="color: white;">Dashboard dos requisitos</h3></center><br>
        <div class="board-column">
            <h3>Análise</h3>
            <scroll-container>
                <?php
                    $pdo = Database::iniciaConexao();   
                    $consulta = $pdo->query("SELECT * FROM requisito WHERE idpro = ".$idpro." AND status = 'backlog'");
                    foreach ($consulta as $linha) { echo"<scroll-page>
                        <span class='board'>
                        Nome: ".$linha['nome']."<br>
                        Prazo: ".date('d/m/Y',strtotime($linha['prazo']))."<hr>
                        Mudança de status:<br>|<a style='color: black; text-decoration: none;' href='../../php/controle/controleRequisito.php?id=".$linha['id']."&idpro=".$idpro."&status=pending' class='btn'>Pendente</a>|<a style='color: black; text-decoration: none;' href='../../php/controle/controleRequisito.php?id=".$linha['id']."&idpro=".$idpro."&status=inprogress' class='btn'>Fazendo</a>|<a style='color: black; text-decoration: none;' href='../../php/controle/controleRequisito.php?id=".$linha['id']."&idpro=".$idpro."&status=completed' class='btn'>Completo</a>|<a style='color: black; text-decoration: none;' href='verRequisitoProg.php?id=".$linha['id']."&idpro=".$idpro."' class='btn'>Detalhes</a>|
                        </span>
                        </scroll-page>";
                    }
                ?>
            </scroll-container>
        </div>

        <div class="board-column-meio-1">
            <h3>Pendente</h3>
            <scroll-container>
                <?php
                    $pdo = Database::iniciaConexao();
                    $consulta = $pdo->query("SELECT * FROM requisito WHERE idpro = ".$idpro." AND status = 'pending'");
                    foreach ($consulta as $linha) { echo"<scroll-page>
                        <span class='board'>
                        Nome: ".$linha['nome']."<br>
                        Prazo: ".date('d/m/Y',strtotime($linha['prazo']))."<hr>
                        Mudança de status:<br>|<a style='color: black; text-decoration: none;' href='../../php/controle/controleRequisito.php?id=".$linha['id']."&idpro=".$idpro."&status=backlog' class='btn'>Analise</a>|<a style='color: black; text-decoration: none;' href='../../php/controle/controleRequisito.php?id=".$linha['id']."&idpro=".$idpro."&status=inprogress' class='btn'>Fazendo</a>|<a style='color: black; text-decoration: none;' href='../../php/controle/controleRequisito.php?id=".$linha['id']."&idpro=".$idpro."&status=completed' class='btn'>Completo</a>|<a style='color: black; text-decoration: none;' href='verRequisitoProg.php?id=".$linha['id']."&idpro=".$idpro."' class='btn'>Detalhes</a>|
                        </span>
                        </scroll-page>";
                    } 
                ?>
            </scroll-container>
        </div>

        <div class="board-column-meio-2">
            <h3>Fazendo</h3>
            <scroll-container>
                <?php
                    $pdo = Database::iniciaConexao();
                    $consulta = $pdo->query("SELECT * FROM requisito WHERE idpro = ".$idpro." AND status = 'inprogress'");
                    foreach ($consulta as $linha) { echo"<scroll-page>
                        <span class='board'>
                        Nome: ".$linha['nome']."<br>
                        Prazo: ".date('d/m/Y',strtotime($linha['prazo']))."<hr>
                        Mudança de status:<br>|<a style='color: black; text-decoration: none;' href='../../php/controle/controleRequisito.php?id=".$linha['id']."&idpro=".$idpro."&status=backlog' class='btn'>Analise</a>|<a style='color: black; text-decoration: none;' href='../../php/controle/controleRequisito.php?id=".$linha['id']."&idpro=".$idpro."&status=pending' class='btn'>Pendente</a>|<a style='color: black; text-decoration: none;' href='../../php/controle/controleRequisito.php?id=".$linha['id']."&idpro=".$idpro."&status=completed' class='btn'>Completo</a>|<a style='color: black; text-decoration: none;' href='verRequisitoProg.php?id=".$linha['id']."&idpro=".$idpro."' class='btn'>Detalhes</a>|
                        </span>
                        </scroll-page>";
                    } 
                ?>
            </scroll-container>
        </div>

        <div class="board-column-final">
            <h3>Completo</h3>
            <scroll-container>
                <?php
                    $pdo = Database::iniciaConexao();   
                    $consulta = $pdo->query("SELECT * FROM requisito WHERE idpro = ".$idpro." AND status = 'completed'");
                    foreach ($consulta as $linha) { echo"<scroll-page>
                        <span class='board'>
                        Nome: ".$linha['nome']."<br>
                        Prazo: ".date('d/m/Y',strtotime($linha['prazo']))."<hr>
                        Mudança de status:<br>|<a style='color: black; text-decoration: none;' href='../../php/controle/controleRequisito.php?id=".$linha['id']."&idpro=".$idpro."&status=backlog' class='btn'>Analise</a>|<a style='color: black; text-decoration: none;' href='../../php/controle/controleRequisito.php?id=".$linha['id']."&idpro=".$idpro."&status=pending' class='btn'>Pendente</a>|<a style='color: black; text-decoration: none;' href='../../php/controle/controleRequisito.php?id=".$linha['id']."&idpro=".$idpro."&status=inprogress' class='btn'>Fazendo</a>|<a style='color: black; text-decoration: none;' href='verRequisitoProg.php?id=".$linha['id']."&idpro=".$idpro."' class='btn'>Detalhes</a>|
                        </span>
                        </scroll-page>";
                    }
                ?>
            </scroll-container>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>