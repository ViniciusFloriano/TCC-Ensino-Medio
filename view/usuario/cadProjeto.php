<!DOCTYPE html>
<?php
    include_once "../../php/utils/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $pro = new Projeto('','','','','','','','','');
        $lista = $pro->select('*', "id = $id");
    }

    error_reporting(0);
    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $prazoinicio = isset($_POST["prazoinicio"]) ? $_POST["prazoinicio"] : 0;
    $prazofim = isset($_POST["prazofim"]) ? $_POST["prazofim"] : 0;
    $descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : "";
    $edital = isset($_POST["edital"]) ? $_POST["edital"] : "";
    $analista = isset($_GET["analista"]) ? $_GET["analista"] : 0;
    $status = "backlog";
    $table = "projeto";
    $arquivos_permitidos = ['jpg', 'png', 'jpeg', 'docx', 'pdf', 'txt', 'doc', 'bmp', 'xlsx', 'ppt', 'zip', 'mp3', 'mp4', 'psd', 'js', 'php', 'html', 'css', 'tiff', 'AI', 'dll', 'AVI', 'WAV', 'rar', 'gif', ''];
    $nomes = $_FILES['arquivos']['name'];

    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "insert") {
        try{
            $pro = new Projeto("", $nome, $prazoinicio, $prazofim, $descricao, $edital, $analista, $status);
            $pro->inserir();
            if(isset($_POST["idusu"])){   
                foreach ($_POST['idusu'] as $idusu){
                    $usupro = new Usuario_Projeto($idusu,"");
                    $usupro->inserir();
                }
            }
            for($i = 0; $i < count($nomes); $i++){
                $extensao = explode('.', $nomes[$i]);
                $extensao = end($extensao);
                if(in_array($extensao, $arquivos_permitidos)){
                    $arqpro = new Arquivo_pro($nomes[$i], "");
                    $arqpro->inserir();
                    move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], '../arquivoProjeto/' . $nomes[$i]);
                }
            }
            header("location:projetos.php?analista=$analista");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "editar") {
        try{
            if(isset($prazoinicio)){
                $pro = new Projeto($id, $nome, $prazoinicio, $prazofim, $descricao, $edital, $analista, "");
                $pro->editar();
            }elseif(isset($prazofim)){
                $pro = new Projeto($id, $nome, "", $prazofim, $descricao, $edital, $analista, "");
                $pro->editar();
            }else{
                $pro = new Projeto($id, $nome, "", "", $descricao, $edital, $analista, "");
                $pro->editar();
            }
            if(isset($_POST["idusu"])){  
                $usupro = new Usuario_Projeto("", $id);
                $usupro->excluir(); 
                foreach ($_POST['idusu'] as $idusu){
                    $usupro = new Usuario_Projeto($idusu, $id);
                    $usupro->inserir2();
                }
            }
            if(isset($nome)){
                $arqpro = new Arquivo_pro("", $id);
                $arqpro->excluir();
                for($i = 0; $i < count($nomes); $i++){
                    $extensao = explode('.', $nomes[$i]);
                    $extensao = end($extensao);
                    if(in_array($extensao, $arquivos_permitidos)){
                        $arqpro = new Arquivo_pro($nomes[$i], $id);
                        $arqpro->inserir2();
                        move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], '../arquivoProjeto/' . $nomes[$i]);
                    }
                }
            }
            header("location:projetos.php?analista=$analista");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "excluir") {
        try{
            $pro = new Projeto($id, "", "", "", "", "", "", "");
            $pro->excluir();
            header("location:projetos.php?analista=$analista");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    }
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Projeto</title>
</head>
<body>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <a role='button' href='../../view/usuario/projetos.php?analista=<?php echo $analista?>'><img src='../../img/arrow.svg' style='width: 2.5%;'></a>
    <section id="projeto">
        <form action="<?php if(isset($_GET['id'])) { echo "cadProjeto.php?id=$id&analista=$analista&acao=editar";} else {echo "cadProjeto.php?analista=$analista&acao=insert";}?>" method="POST" style="color: #fff;" class="card-projeto" enctype="multipart/form-data">
            <div><h2>Projeto</h2></div><br>
            <input readonly type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $lista[0]['id'];?>">
            <input readonly type="hidden" name="analista" id="analista" value="<?php if (isset($id)) echo $analista;?>">
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="nome">Nome do projeto</label>
                    <input type="text" id="nome" name="nome" style="width: 65.3%;" required value="<?php if (isset($id)) echo $lista[0]['nome'];?>" class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="prazoinicio"> Prazo de Início </label>
                    <input type="date" id="prazoinicio" name="prazoinicio" style="width: 68.5%;" <?php if(!isset($id)) { echo "required";} else { echo "";}?> value="<?php if (isset($id)) echo $lista[0]['prazoinicio'];?>" class="form-control-sm border border-dark rounded-end" min="<?php echo date('Y-m-d');?>">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="prazofim"> Prazo de Fim </label>
                    <input type="date" id="prazofim" name="prazofim" style="width: 71.6%;" <?php if(!isset($id)) { echo "required";} else { echo "";}?> value="<?php if (isset($id)) echo $lista[0]['prazofim'];?>" class="form-control-sm border border-dark rounded-end" min="<?php echo date('Y-m-d');?>">
                </div>
            </div><br>
            <div class="mb-3">
                <label class="form-label" for="descricao">Descrição</label>
                <textarea id="descricao"  name="descricao" rows="3" required maxlength="550" class="form-control"><?php if (isset($id)) echo $lista[0]['descricao'];?></textarea>
            </div><br>
            <div class="col-auto">
                <div class="mb-3">
                    <input type="file" multiple id="arquivos[]" name="arquivos[]" value="<?php if (isset($id)) echo $lista[0]['documento'];?>" class="form-control border border-dark rounded">
                </div> 
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="edital">Edital</label>
                    <input type="text" id="edital" name="edital" style="width: 83.7%;" value="<?php if (isset($id)) echo $lista[0]['edital'];?>" class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="programador">Programador(es)</label>
                    <select name="idusu[]" id="idusu[]" style="width: 64.9%; text-align: center;" <?php if(!isset($id)) { echo "required";} else { echo "";}?> class="form-select-sm border border-dark rounded-end" multiple aria-label="Floating label select example">
                        <?php
                            $pdo = Database::iniciaConexao();
                            $consulta = $pdo->query("SELECT * FROM usuario WHERE tipo = 'programador';");
                            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <option value="<?php echo $linha['id'];?>"><?php echo $linha['nome'];?></option>
                        <?php } ?>
                    </select>
                </div>
            </div><br>
            <div>
                <button style="width: 100%;height: 40px;background-color: #a13854;border:none;color:#fff;margin: 10px 0;" type="submit"><?php if (isset($id)){ echo "Alterar Projeto"; }else echo "Cadastrar Projeto";?></button>
            </div>
        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>