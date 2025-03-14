<?php
    include_once ("../utils/autoload.php");
    session_start();
    $status = $_GET["status"];
    $id = $_GET["id"];
    $idusu = $_GET["idusu"];
    
    if($status == "backlog") {
        $pro = new Projeto($id, "", "", "", "", "", "", "backlog");
        $pro->status();
        header("Location:../../view/usuario/programador.php?idusu=".$idusu."");
    } elseif($status == "pending") {
        $pro = new Projeto($id, "", "", "", "", "", "", "pending");
        $pro->status();
        header("Location:../../view/usuario/programador.php?idusu=".$idusu."");
    } elseif($status == "inprogress") {
        $pro = new Projeto($id, "", "", "", "", "", "", "inprogress");
        $pro->status();
        header("Location:../../view/usuario/programador.php?idusu=".$idusu."");
    } elseif($status == "completed") {
        $pro = new Projeto($id, "", "", "", "", "", "", "completed");
        $pro->status();
        header("Location:../../view/usuario/programador.php?idusu=".$idusu."");
    }
?>