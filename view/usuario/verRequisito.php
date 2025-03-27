<!DOCTYPE html>
<?php
    include_once "../../php/utils/autoload.php";
    $id = $_GET["id"];
    $idpro = $_GET["idpro"];
    $dados = Requisito::consultarData($idpro)[0];
    $arquivo = Arquivo_req::consultarData($id);
    $table = "requisito";
    error_reporting(0);
    $nomezip = "../arquivoRequisito/arquivos-do-requisito-".$dados['nome'].".zip";
    $zip = new ZipArchive;
    $zip->open($nomezip, ZipArchive::CREATE);
    for($i = 0; $i < count($arquivo); $i++){
        $zip->addFile("../arquivoRequisito/".$arquivo[$i][0], $arquivo[$i][0]);
    }
    $zip->close();
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Requisito</title>
</head>
<body>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <a role='button' href='../../view/usuario/requisitos.php?idpro=<?php echo $idpro?>'><img src='../../img/arrow.svg' style='width: 2.5%;'></a>
    <section id="requisito-ver">
        <form style="color: #fff;" class="card-projeto" enctype="multipart/form-data">
            <div><h2>Requisito</h2></div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="nome">Nome do Requisto</label>
                    <input type="text" id="nome" name="nome" required style="width: 62.4%; background-color:#fff;" class="form-control-sm border border-dark rounded-end" value="<?php echo $dados['nome'];?>" disabled>
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="prazo">Prazo</label>
                    <input type="date" id="prazo" name="prazo" required style="width: 84.3%; background-color:#fff;" class="form-control-sm border border-dark rounded-end" value="<?php echo $dados['prazo'];?>" disabled>
                </div>
            </div><br>
            <div class="mb-3">
                <label class="form-label" for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" rows="3" required style="background-color:#fff;" class="form-control" placeholder="<?php echo $dados['descricao'];?>" disabled></textarea>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                <label class="input-group-text border border-dark rounded-start" for="documento">Baixar arquivo do requisito</label>
                    <a href='<?php echo $nomezip;?>' download style="width: 47.5%;background-color:#c93854;color:#ffffff;" class="border border-dark btn btn-danger rounded-end" role="button">Download</a>
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="programador">Programador(es)</label>
                    <select name="idusu" id="idusu" style="width: 64.9%; text-align: center;" class="form-select-sm border border-dark rounded-end" multiple aria-label="Floating label select example" disabled>
                        <?php
                            $pdo = Database::iniciaConexao();
                            $consulta = $pdo->query("SELECT usuario.nome FROM usuario_requisito LEFT JOIN usuario ON (usuario_requisito.idusu = usuario.id) AND $id = usuario_requisito.idreq AND usuario.status = 'ativado';");
                            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <option><?php echo $linha['nome'];?></option>
                        <?php } ?>
                    </select>                
                </div>
            </div><br>
        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>