<?php
    include_once ("../utils/autoload.php");
    session_start();
    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    if($acao == "ativar") {
        $usu = new Usuario($id, "", "", "", "", "", "", "", "ativado");
        $usu->ativar();
        header("Location:../../view/usuario/usuarios.php");
    } else if($acao == "desativar") {
        $usu = new Usuario($id, "", "", "", "", "", "", "", "desativado");
        $usu->ativar();
        header("Location:../../view/usuario/usuarios.php");
    }else{
        $pdo = Database::iniciaConexao();   
        $consulta = $pdo->query("SELECT * FROM usuario WHERE id = ".$_SESSION['id']."");
        foreach ($consulta as $linha) {  
            if($acao == "editar") { 
                if(strlen($_POST['novasenha']) >= 6) {
                    $usu = new Usuario($_SESSION['id'], $linha['nome'], $linha['email'], $_POST['novasenha'], $linha['tipo'], $linha['cpf'], $linha['telefone'], $linha['curriculo'], $_SESSION['status']);
                    $usu->editar();
                } else {
                    $usu = new Usuario($_SESSION['id'], $_POST['nome'], $_POST['email'], $linha['senha'], $_SESSION['tipo'], $_POST['cpf'], $_POST['telefone'], $_POST['curriculo'], $_SESSION['status']);
                    $usu->editar();
                }
                header("Location:../../view/usuario/perfil.php?msg=Usuário alterado com sucesso!");
            } else if($acao == "excluir") {
                $usu = new Usuario($_SESSION['id'], "", "", "", "", "", "", "", "desativado");
                $usu->excluir();
                header("Location:../../view/usuario/login.php");
            }
        }
    }
?>