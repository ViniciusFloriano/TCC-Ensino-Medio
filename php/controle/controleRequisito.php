<?php
    include_once ("../utils/autoload.php");
    session_start();
    $status = $_GET["status"];
    $id = $_GET["id"];
    $idpro = $_GET["idpro"];

    if($status == "backlog") {
        $req = new Requisito($id, "", "", "", "", "backlog");
        $req->status();
        header("Location:../../view/usuario/requisitoProg.php?idpro=".$idpro."");
    } elseif($status == "pending") {
        $req = new Requisito($id, "", "", "", "", "pending");
        echo $req->status();
        header("Location:../../view/usuario/requisitoProg.php?idpro=".$idpro."");
    } elseif($status == "inprogress") {
        $req = new Requisito($id, "", "", "", "", "inprogress");
        $req->status();
        header("Location:../../view/usuario/requisitoProg.php?idpro=".$idpro."");
    } elseif($status == "completed") {
        $req = new Requisito($id, "", "", "", "", "completed");
        $req->status();
        header("Location:../../view/usuario/requisitoProg.php?idpro=".$idpro."");
    }
?>