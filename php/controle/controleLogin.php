<?php
    include_once "../utils/autoload.php";
    //Login do usuário com sucesso, Login do usuário sem sucesso, Logout do usuário
    if(Usuario::efetuarLogin($_POST['email'], $_POST['senha'])) {
        if($_SESSION['tipo'] == 'analista'){
            header("Location:../../view/usuario/projetos.php?analista=".$_SESSION['id']."");
        }else if($_SESSION['tipo'] == 'programador'){
            header("Location:../../view/usuario/programador.php?idusu=".$_SESSION['id']."");
        }
    } else if(isset($_POST['email']) && isset($_POST['senha'])) {
        header("Location:../../view/usuario/login.php?alert=1");
    } else {
        header("Location:../../view/usuario/login.php");
    }
?>