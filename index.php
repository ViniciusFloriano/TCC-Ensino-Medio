<?php
    session_set_cookie_params(0);
    session_start();
    if(!isset($_SESSION['id']) || $_SESSION['id'] == ''){
        header("Location:view/usuario/login.php");
    }
?>