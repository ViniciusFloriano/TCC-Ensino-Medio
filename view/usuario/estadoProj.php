<!DOCTYPE html>
<?php
    include_once "../../php/utils/autoload.php";
    include_once "../../php/utils/utilidades.php";
    $analista = $_GET["analista"];
    $dia = date('d');
    $mes = date('m');
    $ano = date('Y');
?> 
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Estado dos Projetos</title>
</head>
<body>
    <header>
        <?php include_once "menu.php"; ?>
    </header>    
    <a role='button' href='../../view/usuario/projetos.php?analista=<?php echo $analista?>'><img src='../../img/arrow.svg' style='width: 2.5%;'></a>
    <center><h3 style="color: white;">Dashboard dos Projetos</h3></center><br>
    <div class="board-group">   
        <div class="board-column">
            <h3>Análise</h3>
            <scroll-container>
            <?php
                $pdo = Database::iniciaConexao();   
                $consulta = $pdo->query("SELECT * FROM projeto WHERE analista = ".$analista." AND status = 'backlog'");
                foreach ($consulta as $linha) { echo "<scroll-page>
                    <span class='board'>
                    Nome: ".$linha['nome']."<br>
                    Prazo de Inicio: ".date('d/m/Y',strtotime($linha['prazoinicio']))."<br>
                    Prazo de Fim: ".date('d/m/Y',strtotime($linha['prazofim']))."<br>
                    Programador(es): | ";foreach(prog($linha['id']) as $key => $value){echo $value." | ";}
                    echo "
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
                $consulta = $pdo->query("SELECT * FROM projeto WHERE analista = ".$analista." AND status = 'pending'");
                foreach ($consulta as $linha) { 
                    if($ano > date('Y',strtotime($linha['prazofim']))){
                        echo "<scroll-page>
                        <span class='board' style='background-color:red;'>
                        Nome: ".$linha['nome']."<br>
                        Prazo de Inicio: ".date('d/m/Y',strtotime($linha['prazoinicio']))."<br>
                        Prazo de Fim: ".date('d/m/Y',strtotime($linha['prazofim']))."<br>
                        Programador: | ";foreach(prog($linha['id']) as $key => $value){echo $value." | ";}
                        echo "
                        </span>
                        </scroll-page>";
                    } elseif($mes > date('m',strtotime($linha['prazofim']))){
                        echo "<scroll-page>
                        <span class='board' style='background-color:red;'>
                        Nome: ".$linha['nome']."<br>
                        Prazo de Inicio: ".date('d/m/Y',strtotime($linha['prazoinicio']))."<br>
                        Prazo de Fim: ".date('d/m/Y',strtotime($linha['prazofim']))."<br>
                        Programador: | ";foreach(prog($linha['id']) as $key => $value){echo $value." | ";}
                        echo "
                        </span>
                        </scroll-page>";
                    } elseif($dia > date('d',strtotime($linha['prazofim'])) && $mes < date('m',strtotime($linha['prazofim']))){
                        echo "<scroll-page>
                        <span class='board' style='background-color:green;'>
                        Nome: ".$linha['nome']."<br>
                        Prazo de Inicio: ".date('d/m/Y',strtotime($linha['prazoinicio']))."<br>
                        Prazo de Fim: ".date('d/m/Y',strtotime($linha['prazofim']))."<br>
                        Programador: | ";foreach(prog($linha['id']) as $key => $value){echo $value." | ";}
                        echo "
                        </span>
                        </scroll-page>";
                    } elseif($dia > date('d',strtotime($linha['prazofim']))  && $mes >= date('m',strtotime($linha['prazofim']))){
                        echo "<scroll-page>
                        <span class='board' style='background-color:red;'>
                        Nome: ".$linha['nome']."<br>
                        Prazo de Inicio: ".date('d/m/Y',strtotime($linha['prazoinicio']))."<br>
                        Prazo de Fim: ".date('d/m/Y',strtotime($linha['prazofim']))."<br>
                        Programador: | ";foreach(prog($linha['id']) as $key => $value){echo $value." | ";}
                        echo "
                        </span>
                        </scroll-page>";
                    } elseif($dia <= date('d',strtotime($linha['prazofim']))){
                        echo "<scroll-page>
                        <span class='board' style='background-color:green;'>
                        Nome: ".$linha['nome']."<br>
                        Prazo de Inicio: ".date('d/m/Y',strtotime($linha['prazoinicio']))."<br>
                        Prazo de Fim: ".date('d/m/Y',strtotime($linha['prazofim']))."<br>
                        Programador: | ";foreach(prog($linha['id']) as $key => $value){echo $value." | ";}
                        echo "
                        </span>
                        </scroll-page>";
                    }
                }
            ?>
            </scroll-container>
        </div>

        <div class="board-column-meio-2">
            <h3>Realizando</h3>
            <scroll-container>
            <?php
                $pdo = Database::iniciaConexao();
                $consulta = $pdo->query("SELECT * FROM projeto WHERE analista = ".$analista." AND status = 'inprogress'");
                foreach ($consulta as $linha) { 
                    if($ano > date('Y',strtotime($linha['prazofim']))){
                        echo "<scroll-page>
                        <span class='board' style='background-color:red;'>
                        Nome: ".$linha['nome']."<br>
                        Prazo de Inicio: ".date('d/m/Y',strtotime($linha['prazoinicio']))."<br>
                        Prazo de Fim: ".date('d/m/Y',strtotime($linha['prazofim']))."<br>
                        Programador: | ";foreach(prog($linha['id']) as $key => $value){echo $value." | ";}
                        echo "
                        </span>
                        </scroll-page>";
                    } elseif($mes > date('m',strtotime($linha['prazofim']))){
                        echo "<scroll-page>
                        <span class='board' style='background-color:red;'>
                        Nome: ".$linha['nome']."<br>
                        Prazo de Inicio: ".date('d/m/Y',strtotime($linha['prazoinicio']))."<br>
                        Prazo de Fim: ".date('d/m/Y',strtotime($linha['prazofim']))."<br>
                        Programador: | ";foreach(prog($linha['id']) as $key => $value){echo $value." | ";}
                        echo "
                        </span>
                        </scroll-page>";
                    } elseif($dia > date('d',strtotime($linha['prazofim'])) && $mes < date('m',strtotime($linha['prazofim']))){
                        echo "<scroll-page>
                        <span class='board' style='background-color:green;'>
                        Nome: ".$linha['nome']."<br>
                        Prazo de Inicio: ".date('d/m/Y',strtotime($linha['prazoinicio']))."<br>
                        Prazo de Fim: ".date('d/m/Y',strtotime($linha['prazofim']))."<br>
                        Programador: | ";foreach(prog($linha['id']) as $key => $value){echo $value." | ";}
                        echo "
                        </span>
                        </scroll-page>";
                    } elseif($dia > date('d',strtotime($linha['prazofim']))  && $mes >= date('m',strtotime($linha['prazofim']))){
                        echo "<scroll-page>
                        <span class='board' style='background-color:red;'>
                        Nome: ".$linha['nome']."<br>
                        Prazo de Inicio: ".date('d/m/Y',strtotime($linha['prazoinicio']))."<br>
                        Prazo de Fim: ".date('d/m/Y',strtotime($linha['prazofim']))."<br>
                        Programador: | ";foreach(prog($linha['id']) as $key => $value){echo $value." | ";}
                        echo "
                        </span>
                        </scroll-page>";
                    } elseif($dia <= date('d',strtotime($linha['prazofim']))){
                        echo "<scroll-page>
                        <span class='board' style='background-color:green;'>
                        Nome: ".$linha['nome']."<br>
                        Prazo de Inicio: ".date('d/m/Y',strtotime($linha['prazoinicio']))."<br>
                        Prazo de Fim: ".date('d/m/Y',strtotime($linha['prazofim']))."<br>
                        Programador: | ";foreach(prog($linha['id']) as $key => $value){echo $value." | ";}
                        echo "
                        </span>
                        </scroll-page>";
                    }
                }
            ?>
            </scroll-container>
        </div>
        <div class="board-column-final">
            <h3>Completo</h3>
            <scroll-container>
            <?php
                $pdo = Database::iniciaConexao();
                $consulta = $pdo->query("SELECT * FROM projeto WHERE analista = ".$analista." AND status = 'completed'");
                foreach ($consulta as $linha) { 
                    if($ano > date('Y',strtotime($linha['prazofim']))){
                        echo "<scroll-page>
                        <span class='board' style='background-color:red;'>
                        Nome: ".$linha['nome']."<br>
                        Prazo de Inicio: ".date('d/m/Y',strtotime($linha['prazoinicio']))."<br>
                        Prazo de Fim: ".date('d/m/Y',strtotime($linha['prazofim']))."<br>
                        Programador: | ";foreach(prog($linha['id']) as $key => $value){echo $value." | ";}
                        echo "
                        </span>
                        </scroll-page>";
                    } elseif($mes > date('m',strtotime($linha['prazofim']))){
                        echo "<scroll-page>
                        <span class='board' style='background-color:red;'>
                        Nome: ".$linha['nome']."<br>
                        Prazo de Inicio: ".date('d/m/Y',strtotime($linha['prazoinicio']))."<br>
                        Prazo de Fim: ".date('d/m/Y',strtotime($linha['prazofim']))."<br>
                        Programador: | ";foreach(prog($linha['id']) as $key => $value){echo $value." | ";}
                        echo "
                        </span>
                        </scroll-page>";
                    } elseif($dia > date('d',strtotime($linha['prazofim'])) && $mes < date('m',strtotime($linha['prazofim']))){
                        echo "<scroll-page>
                        <span class='board' style='background-color:green;'>
                        Nome: ".$linha['nome']."<br>
                        Prazo de Inicio: ".date('d/m/Y',strtotime($linha['prazoinicio']))."<br>
                        Prazo de Fim: ".date('d/m/Y',strtotime($linha['prazofim']))."<br>
                        Programador: | ";foreach(prog($linha['id']) as $key => $value){echo $value." | ";}
                        echo "
                        </span>
                        </scroll-page>";
                    } elseif($dia > date('d',strtotime($linha['prazofim']))  && $mes >= date('m',strtotime($linha['prazofim']))){
                        echo "<scroll-page>
                        <span class='board' style='background-color:red;'>
                        Nome: ".$linha['nome']."<br>
                        Prazo de Inicio: ".date('d/m/Y',strtotime($linha['prazoinicio']))."<br>
                        Prazo de Fim: ".date('d/m/Y',strtotime($linha['prazofim']))."<br>
                        Programador: | ";foreach(prog($linha['id']) as $key => $value){echo $value." | ";}
                        echo "
                        </span>
                        </scroll-page>";
                    } elseif($dia <= date('d',strtotime($linha['prazofim']))){
                        echo "<scroll-page>
                        <span class='board' style='background-color:green;'>
                        Nome: ".$linha['nome']."<br>
                        Prazo de Inicio: ".date('d/m/Y',strtotime($linha['prazoinicio']))."<br>
                        Prazo de Fim: ".date('d/m/Y',strtotime($linha['prazofim']))."<br>
                        Programador: | ";foreach(prog($linha['id']) as $key => $value){echo $value." | ";}
                        echo "
                        </span>
                        </scroll-page>";
                    }
                }
            ?>
            </scroll-container>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>